<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getProfile(Request $request)
    {
        return $request->user();
    }

    public function getVideos(Request $request)
    {
        return Video::where('user_id', $request->user()->id)->paginate(20);
    }
}
