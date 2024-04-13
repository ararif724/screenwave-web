<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    function saveVideo(Request $request)
    {
        $request->validate([
            'videoId' => 'required|unique:videos,video_id'
        ]);

        Video::create([
            'title' => $request->get('title', 'Untitled'),
            'video_id' => $request->get('videoId'),
            'user_id' => $request->user()->id,
        ]);

        return response([
            'success' => true,
            'data' => [
                'videoUrl' => url('video', ['videoId' => $request->get('videoId')])
            ]
        ]);
    }

    function getVideo($videoId)
    {
        return '<iframe src="https://drive.google.com/file/d/' . $videoId . '/preview" width="640" height="480" allow="autoplay"></iframe>';
    }
}
