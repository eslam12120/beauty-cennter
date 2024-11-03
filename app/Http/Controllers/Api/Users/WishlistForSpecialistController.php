<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Models\FavSpecialist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class WishlistForSpecialistController extends Controller
{
    public function specialist_wishlist(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'specialist_id' => 'required|exists:specialists,id',
        ], [
            'specialist_id.required' => trans('wishlist.specialistRequired'),
            'specialist_id.exists' => trans('wishlist.specialistExists'),
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 422);
        }
        $wishlist = FavSpecialist::where('user_id', Auth::guard('user-api')->user()->id)->where('specialist_id', $request->specialist_id)->count();
        if ($wishlist == 0) {
            Favspecialist::create([
                'specialist_id' => $request->specialist_id,
                'user_id' => Auth::guard('user-api')->user()->id
            ]);

            return response()->json([
                'status' => '200',
                'message' => trans('msg.message'),
            ]);
        } else {
            Favspecialist::where('patient_id', Auth::guard('user-api')->user()->id)->where('user_id', $request->user_id)->delete();
            return Response::json(array(
                'status' => 200,
                'message' => trans('msg.messageRemove'),
            ));
        }
    }
    //
}
