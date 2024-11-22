<?php

namespace App\Http\Controllers\Api;

use Exception;
use Carbon\Carbon;
use App\Models\Time;
use App\Models\Booking;
use App\Models\service;
use App\Models\CartBooking;
use App\Models\TimeService;
use Illuminate\Http\Request;
use App\Models\TimeSpecialist;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BookingsController extends Controller
{
    public function get_available_days_time()
    {
        $times = Time::where('is_opened', '1')->get();

        $result = $times->map(function ($time) {
            $start = Carbon::parse($time->start_time);
            $end = Carbon::parse($time->end_time);

            // Handle cases where `end_time` is past midnight (e.g., "00:00:00")
            if ($end->lt($start)) {
                $end->addDay();
            }

            // Generate the list of times
            $timeSlots = [];
            while ($start->lt($end)) {
                $timeSlots[] = $start->format('H:i:s');
                $start->addHour(); // Increment by one hour
            }

            return [
                'id' => $time->id,
                'day' => $time->day,
                'time_slots' => $timeSlots,
            ];
        });

        return response()->json([
            'data' => $result,
        ], 200);
    }

    public function get_available_services_days_time(Request $request)
    {
        $times = TimeService::with('time')->where('service_id', $request->service_id)->get();

        $result = $times->map(function ($time) use ($request) {
            $start = Carbon::parse($time->start_time);
            $end = Carbon::parse($time->end_time);
            $service_session_time = service::where('id', $request->service_id)->first()->session_time ?? null;
            // Handle cases where `end_time` is past midnight (e.g., "00:00:00")
            if ($end->lt($start)) {
                $end->addDay();
            }

            // Generate the list of times
            $timeSlots = [];
            while ($start->lt($end)) {
                $timeSlots[] = $start->format('H:i:s');
                $start->addMinutes($service_session_time);
            }

            return [
                'id' => $time->id,
                'time_id' => $time->time->id,
                'day' => $time->time->day,
                'time_slots' => $timeSlots,
            ];
        });

        return response()->json([
            'data' => $result,
        ], 200);
    }

    public function get_available_specialist_days_time(Request $request)
    {
        $lang = $request->lang ?? 'en'; // Default to 'en' if no lang is provided

        $times = TimeSpecialist::with([
            'specialist.category' => function ($query) use ($lang) {
                $query->select(
                    'id',
                    $lang === 'en' ? 'name_en as name' : 'name_ar as name'
                );
            },
        ])->where('service_id', $request->service_id)
            ->where('start_time', $request->time)
            ->where('time_id', $request->time_id)
            ->get();

        $result = $times->filter(function ($time) use ($request) {
            return !Booking::where('specialist_id', $time->specialist_id)
                ->where('service_id', $request->service_id)
                ->where('time_id', $request->time_id)
                ->where('time_specialist_id', $time->id)->whereDate('date', $request->date)->where('status', 'upcoming')
                ->exists();
        })->map(function ($time) {
            return [
                'id' => $time->id,
                'specialist' => $time->specialist,
            ];
        });
        return response()->json([
            'data' => $result->values(), // Ensure the response is a sequential array
        ], 200);
    }


    public function get_available_specialist_days_time_by_id(Request $request)
    {
        $lang = $request->lang ?? 'en'; // Default to 'en' if no lang is provided

        // Retrieve times and associated data
        $times = TimeSpecialist::with([
            'specialist.category' => function ($query) use ($lang) {
                $query->select(
                    'id',
                    $lang === 'en' ? 'name_en as name' : 'name_ar as name'
                );
            },
        ])
            ->where('service_id', $request->service_id)
            ->where('specialist_id', $request->specialist_id)
            ->where('time_id', $request->time_id)
            ->get();

        // Filter available times
        $availableTimes = $times->filter(function ($time) use ($request) {
            return !Booking::where('specialist_id', $request->specialist_id)
                ->where('service_id', $request->service_id)
                ->where('time_id', $request->time_id)
                ->where('time_specialist_id', $time->id)
                ->whereDate('date', $request->date)
                ->where('status', 'upcoming')
                ->exists();
        });

        // If no available times, return a 422 status
        if ($availableTimes->isEmpty()) {
            return response()->json([
                'message' => 'The requested time slot is unavailable.',
            ], 422);
        }

        // Map available times to the desired structure
        $result = $availableTimes->map(function ($time) {
            return [
                'id' => $time->id,
                'time_id' => $time->time_id,
                'time' => $time->start_time,
                'service_id' => $time->service_id,
                'specialist_id' => $time->specialist_id,
            ];
        });

        // Return response with available times
        return response()->json([
            'data' => $result->values(), // Ensure the response is a sequential array
        ], 200);
    }




    public function add_cart(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'specialist_id' => 'required',
            'date' => 'required',
        ], [
            'specialist_id.required' => trans('specialist is required'),

            'date.required' => trans('date is required'),


        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 422);
        }

        DB::beginTransaction();
        try {
            if (CartBooking::where([
                'specialist_id' => $request->specialist_id,
                'service_id' => $request->service_id,
                'category_id' => $request->category_id,
                'time_id' => $request->time_id,
                'time_specialist_id' => $request->time_specialist_id,
                'user_id' => Auth::id(),
                'date' => $request->date,
            ])->first()) {
                return response()->json(['message' => ' لا يمكن اضافة نفس الخدمة مرتين لنفس المختص'], 422);
            } else {
                CartBooking::create([
                    'specialist_id' => $request->specialist_id,
                    'service_id' => $request->service_id,
                    'category_id' => $request->category_id,
                    'time_id' => $request->time_id,
                    'time_specialist_id' => $request->time_specialist_id,
                    'user_id' => Auth::id(),
                    'date' => $request->date,
                ]);
                DB::commit();
                return response()->json([
                    'message' => 'success', // Ensure the response is a sequential array
                ], 200);
            }
        } catch (Exception $e) {
            // Rollback all operations if an error occurs
            DB::rollBack();

            return response()->json(['error' => 'Failed to create user: ' . $e->getMessage()], 500);
        }
    }
    public function get_cart(Request $request)
    {
        $lang = $request->lang;
        $cart = CartBooking::with([
            'services' => function ($query) use ($lang) {
                $query->select(
                    'id',
                    $lang === 'en' ? 'service_name_en as name' : 'service_name_ar as name',
                    'price',
                    'session_time',
                    'image'
                );
            },
            'time_specialist',
            'specialist'
        ])->where('user_id', Auth::id())->get();

        // Add the base URL to the `image` field
        $cart->each(function ($item) {
            if ($item->services) {
                // Adjusting for single service relationship, not a collection
                $item->services->image_url = $item->services->image
                    ? asset('services_images/' . $item->services->image) // Assuming images are stored in a folder named `services_images` inside `public`
                    : null; // Handle cases where the image is null
            }
        });

        return response()->json([
            'data' => $cart,
            'message' => 'success', // Ensure the response is a sequential array
        ], 200);
    }
    public function delete_cart(Request $request)
    {
        CartBooking::where('id', $request->cart_id)->delete();
        return response()->json([
            'message' => 'success', // Ensure the response is a sequential array
        ], 200);
    }
    public function cancel_booking(Request $request)
    {

        Booking::where('id', $request->booking_id)->update([
            'status' => 'cancelled'
        ]);
        return response()->json([
            'message' => 'success', // Ensure the response is a sequential array
        ], 200);
    }

    //   public function rebook(Request $request) {



    //  }
    public function add_booking(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'payment_type' => 'required',

        ], [

            'payment_type.required' => trans('Payment Type required'),


        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 422);
        }

        DB::beginTransaction();
        try {
            $cart = CartBooking::where('user_id', Auth::id())->get();
            if (count($cart) > 0) {
                foreach ($cart as $c) {
                    Booking::create([
                        'specialist_id' => $c->specialist_id,
                        'service_id' => $c->service_id,
                        'category_id' => $c->category_id,
                        'time_id' => $c->time_id,
                        'time_specialist_id' => $c->time_specialist_id,
                        'user_id' => Auth::id(),
                        'date' => $c->date,
                        'payment_type' => $request->payment_type,
                        'status' => 'upcoming',
                    ]);
                }
                DB::commit();
                CartBooking::where('user_id', Auth::id())->delete();
                return response()->json([
                    'message' => 'success', // Ensure the response is a sequential array
                ], 200);
            } else {
                return response()->json([
                    'message' => 'حدث خطأ ما ', // Ensure the response is a sequential array
                ], 422);
            }
        } catch (Exception $e) {
            // Rollback all operations if an error occurs
            DB::rollBack();

            return response()->json(['error' => 'Failed to create user: ' . $e->getMessage()], 500);
        }
    }
    public function get_cart_by_id(Request $request)
    {
        $lang = $request->lang;
        $book = CartBooking::with([
            'services' => function ($query) use ($lang) {
                $query->select(
                    'id',
                    $lang === 'en' ? 'service_name_en as name' : 'service_name_ar as name',
                    'price',
                    'session_time',
                );
            },
            'time_specialist',
            'specialist'
        ])->where('user_id', Auth::id())->get();
        return response()->json([
            'data' => $book,
            'message' => 'success', // Ensure the response is a sequential array
        ], 200);
    }
    public function remind_me(Request $request)
    {
        Booking::where('id', $request->booking_id)->update([
            'remind_me' => $request->remind_me
        ]);
        return response()->json([
            'message' => 'success', // Ensure the response is a sequential array
        ], 200);
    }

    public function getBookings(Request $request)
    {
        $lang = $request->lang;
        if ($request->status == 'upcoming') {
            $bookings = Booking::with([
                'services' => function ($query) use ($lang) {
                    $query->select(
                        'id',
                        $lang === 'en' ? 'service_name_en as name' : 'service_name_ar as name',
                        'price',
                        'session_time',
                        'image'
                    );
                },
                'time_specialist'
            ])->where('status', 'upcoming')->where('user_id', Auth::id())->simplePaginate(30);
            $bookings->getCollection()->transform(function ($item) {
                if ($item->services) {
                    // Adjusting for single service relationship, not a collection
                    $item->services->image_url = $item->services->image
                        ? asset('services_images/' . $item->services->image) // Assuming images are stored in a folder named `services_images` inside `public`
                        : null; // Handle cases where the image is null
                }
                return $item; // Make sure to return the modified item
            });
            return response()->json([
                'data' => $bookings,
                'message' => 'success', // Ensure the response is a sequential array
            ], 200);
        } elseif ($request->status == 'completed') {
            $bookings = Booking::with([
                'services' => function ($query) use ($lang) {
                    $query->select(
                        'id',
                        $lang === 'en' ? 'service_name_en as name' : 'service_name_ar as name',
                        'price',
                        'session_time',
                        'image'
                    );
                },
                'time_specialist'
            ])->where('status', 'completed')->where('user_id', Auth::id())->simplePaginate(30);
            $bookings->getCollection()->transform(function ($item) {
                if ($item->services) {
                    // Adjusting for single service relationship, not a collection
                    $item->services->image_url = $item->services->image
                        ? asset('services_images/' . $item->services->image) // Assuming images are stored in a folder named `services_images` inside `public`
                        : null; // Handle cases where the image is null
                }
                return $item; // Make sure to return the modified item
            });
            return response()->json([
                'data' => $bookings,
                'message' => 'success', // Ensure the response is a sequential array
            ], 200);
        } else {
            $bookings = Booking::with([
                'services' => function ($query) use ($lang) {
                    $query->select(
                        'id',
                        $lang === 'en' ? 'service_name_en as name' : 'service_name_ar as name',
                        'price',
                        'session_time',
                        'image'
                    );
                },
                'time_specialist'
            ])->where('status', 'cancelled')->where('user_id', Auth::id())->simplePaginate(30);
            $bookings->getCollection()->transform(function ($item) {
                if ($item->services) {
                    // Adjusting for single service relationship, not a collection
                    $item->services->image_url = $item->services->image
                        ? asset('services_images/' . $item->services->image) // Assuming images are stored in a folder named `services_images` inside `public`
                        : null; // Handle cases where the image is null
                }
                return $item; // Make sure to return the modified item
            });
            return response()->json([
                'data' => $bookings,
                'message' => 'success', // Ensure the response is a sequential array
            ], 200);
        }
    }
}
