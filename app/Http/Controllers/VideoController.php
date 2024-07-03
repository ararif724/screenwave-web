<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    function saveVideo(Request $request)
    {
        $request->validate([
            'googleDriveVideoId' => 'required|unique:videos,google_drive_video_id'
        ]);

        $video = Video::create([
            'title' => $request->get('title', 'Untitled'),
            'google_drive_video_id' => $request->get('googleDriveVideoId'),
            'user_id' => $request->user()->id,
        ]);
        
        $video->refresh();

        return response([
            'success' => true,
            'data' => [
                'videoUrl' => route('video', ['slug' => $video->slug])
            ]
        ]);
    }

    function getVideo($slug)
    {
        $video = Video::where('slug', $slug)->withCount('likes', 'dislikes')->first();

        if ($video) {

            if (!$video->processing_competed) {

                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://www.googleapis.com/drive/v3/files/{$video->google_drive_video_id}/?key=" . getenv('GOOGLE_APP_API_KEY') . "&fields=videoMediaMetadata",
                    CURLOPT_RETURNTRANSFER => true
                ));

                $response = json_decode(curl_exec($curl));
                curl_close($curl);

                if (isset($response->videoMediaMetadata->durationMillis)) {
                    $video->processing_competed = 1;
                }
            }

            $video->views++; //incrementing views
            $video->save();

            if ($video->processing_competed) {
                $video->video_url = "https://drive.google.com/file/d/{$video->google_drive_video_id}/preview";
            } else {
                $video->video_url = "https://www.googleapis.com/drive/v3/files/{$video->google_drive_video_id}?alt=media&key=" . getenv('GOOGLE_APP_API_KEY');
            }

            $video->download_url = "https://drive.google.com/uc?export=download&id={$video->google_drive_video_id}";

            return $video;
        }

        return abort(404, 'Video not found!');
    }
}
