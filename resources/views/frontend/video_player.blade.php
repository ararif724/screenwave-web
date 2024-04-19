@extends('layouts.frontend')
@section('content')
    <script> 
        const video = {
            video: @json($video),
            currentUserLike: @json($currentUserLike),
            currentUserDislike: @json($currentUserDislike),
        };


        console.log(video);
        
    </script>
    <main id="videoPlayer" app-data='@json(['video'=> $video, 'currentUserLike'=> $currentUserLike, 'currentUserDislike'=> $currentUserDislike])'></main>
@endsection