<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserFeedback;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FeedbackController extends Controller
{
    //
    public function add_feedback(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'description' => 'required',
            'rate' => 'required',
        ], [
            'description.required' => trans('description is required'),

            'rate.required' => trans('rate is required'),


        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 422);
        }

        DB::beginTransaction();
        try {

            $feedback = UserFeedback::create([

                'description' => $request->description,
                'user_id' => Auth::guard('user-api')->user()->id,
                'rate' => $request->rate,


            ]);




            DB::commit();

            return response()->json([

                'status' => '200',
                'message' => trans('feedback added'),

            ]);
        } catch (Exception $e) {
            // Rollback all operations if an error occurs
            DB::rollBack();

            return response()->json(['error' => 'Failed to create user: ' . $e->getMessage()], 500);
        }
    }
    public function get_all_feedbacks()
    {
        $feedbacks = UserFeedback::with('user')->get();
        $feedbacks->each(function ($item) {
            if ($item->user) {
                // Adjusting for single service relationship, not a collection
                $item->user->image_url = $item->user->image
                    ? asset('images/users/' . $item->user->image) // Assuming images are stored in a folder named `services_images` inside `public`
                    : null; // Handle cases where the image is null
            }
        });

        return response()->json([
            'status' => '200',
            'data' => $feedbacks,
        ]);
    }
}
