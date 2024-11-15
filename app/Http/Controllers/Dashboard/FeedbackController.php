<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\UserFeedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{

    public function index()
    {
        $feedback = UserFeedback::paginate(18);
        return view('dashboard.feedback.index', compact('feedback'));
    }
    //
}
