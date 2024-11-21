<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use App\Models\Question;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    //
    public function get_contact_us(Request $request)
    {
        $lang = $request->lang; // or 'ar', dynamically set this based on user preference
        $nameColumn = $lang === 'ar' ? 'title_ar' : 'title_en';
        $contacts = ContactUs::select('id', $nameColumn . ' as title', 'link', 'image', 'created_at')->get()
            ->map(function ($contacts) {
                // Map over the services to add additional data
              
                $contacts['img_url'] = asset('contact_us/' . $contacts->image);
               


                return $contacts;
            });
        return response()->json([
            'message' => 'success',
            'data' => $contacts
        ], 200);
    }
    public function get_questions(Request $request)
    {
        $lang = $request->lang; // or 'ar', dynamically set this based on user preference
        $title = $lang === 'ar' ? 'title_ar' : 'title_en';
        $content = $lang === 'ar' ? 'content_ar' : 'content_en';
        $questions = Question::select('id', $title . ' as title', $content . ' as content',  'created_at')->get();
         
        return response()->json([
            'message' => 'success',
            'data' => $questions
        ], 200);
    }

}
