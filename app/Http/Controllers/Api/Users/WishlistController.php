<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Models\FavServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class WishlistController extends Controller
{
    public function wishlist(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'service_id' => 'required|exists:services,id',
        ], [
            'service_id.required' => trans('wishlist.serviceRequired'),
            'service_id.exists' => trans('wishlist.serviceExists'),
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()],422);
        }
        $wishlist = FavServices::where('user_id', Auth::guard('user-api')->user()->id)->where('service_id', $request->service_id)->count();
        if ($wishlist == 0) {
            FavServices::create([
                'service_id' => $request->service_id,
                'user_id' => Auth::guard('user-api')->user()->id
            ]);

            return response()->json([
                'status' => '200',
                'message' => trans('msg.message'),
            ]);
        } else {
            FavServices::where('patient_id', Auth::guard('user-api')->user()->id)->where('user_id', $request->user_id)->delete();
            return Response::json(array(
                'status' => 200,
                'message' => trans('msg.messageRemove'),
            ));
        }
    }
    
}
