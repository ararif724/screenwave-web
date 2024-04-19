
@php
  $videoAcrionUrl = function (string $routeName, $as = 'user.video.') use($video) {
    if(Auth::check()){
      $userId = Auth::user()->id;
      $videoId = $video->id;

      if(Route::has("{$as}{$routeName}")){
        return route("{$as}{$routeName}", compact('userId', 'videoId'));
      } else return "#";

    } else return "#";
  };

@endphp 
 
@extends('layouts.client-layout')
@section('content')

@include('client.components.share_box', ['iframeUrl'=> "https://drive.google.com/file/d/{$video->video_id}/preview"])

<section
  class="w-full object-cover bg-cover min-h-full"
  style="background-image: url('{{ asset('assets/images/bg-texeture.png') }}')"
>
  <header>
    <div class="container">
      <div class="bg-slate-100 rounded-full mt-6 shadow-main flex flex-col md:flex-row gap-4 items-center justify-between group">
        <div class="flex items-center justify-center pt-3.5 md:pt-0">
          <figure class="px-4 flex gap-4 items-center justify-center">
            {{-- <img src="{{ asset('assets/images/screenwave-logo.svg') }}" alt="Logo" class="w-12 h-12"> --}}
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" width="60" height="60" class="fill-primary"><path d="M213.1 64.8L202.7 96H128c-35.3 0-64 28.7-64 64V416c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V160c0-35.3-28.7-64-64-64H437.3L426.9 64.8C420.4 45.2 402.1 32 381.4 32H258.6c-20.7 0-39 13.2-45.5 32.8zM448 256c0 8.8-7.2 16-16 16H355.3c-6.2 0-11.3-5.1-11.3-11.3c0-3 1.2-5.9 3.3-8L371 229c-13.6-13.4-31.9-21-51-21c-19.2 0-37.7 7.6-51.3 21.3L249 249c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l19.7-19.7C257.4 172.7 288 160 320 160c31.8 0 62.4 12.6 85 35l23.7-23.7c2.1-2.1 5-3.3 8-3.3c6.2 0 11.3 5.1 11.3 11.3V256zM192 320c0-8.8 7.2-16 16-16h76.7c6.2 0 11.3 5.1 11.3 11.3c0 3-1.2 5.9-3.3 8L269 347c13.6 13.4 31.9 21 51 21c19.2 0 37.7-7.6 51.3-21.3L391 327c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-19.7 19.7C382.6 403.3 352 416 320 416c-31.8 0-62.4-12.6-85-35l-23.7 23.7c-2.1 2.1-5 3.3-8 3.3c-6.2 0-11.3-5.1-11.3-11.3V320z"/></svg>
            <p class="font-['Orbitron',_sans-serif] text-3xl text-primary font-extrabold tracking-wide">ScreenWave</p>
          </figure>
        </div>
        <div>@include('client.components.profile_bubble')</div>
      </div>
    </div> 
  </header>


  <main class="w-full min-h-screen flex flex-col items-center justify-center">
    <div class="container flex flex-col xl:flex-row gap-6 py-4">
      <article class="w-full xl:w-65/100">
        <div class="w-full">
          <div class="w-full p-4 shadow-main bg-transparent">
            <iframe class='w-full min-h-72 sm:min-h-96 md:min-h-[60vh] rounded-xl border border-solid border-primary' title='YouTube video player' frameborder='0' src='https://drive.google.com/file/d/{{ $video->video_id }}/preview' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share' allowfullscreen='' ></iframe>
          </div>

          <div class="font-primary pt-4 flex gap-2">
            <div class="w-full"> 
              <p class="text-sm font-bold text-secondary">
                <span class="tracking-wide">{{ number_format($video->views) }}</span>
                <span class="text-sm font-light text-slate-600 pl-1">views</span>
              </p>
              <p
                class="break-words tracking-wide leading-6 pb-2 sm:pb-0 text-2xl md:text-3xl text-secondary"
              >
                {{ $video->title }}

                @if(Auth::id() == $video->user->id)
                  <button video-title="{{ json_encode(['title'=> $video->title, 'label'=> 'Change Your Video Title:', 'url'=> $videoAcrionUrl('edit-video-title', 'frontend.')]) }}" class="bg-primary p-2 ml-3 lg:ml-8 text-white fill-white rounded-full shadow-main duration-500 hover:bg-secondary hover:shadow-secondary"><svg xmlns="http://www.w3.org/2000/svg"   width="16" height="16" viewBox="0 0 512 512"><path d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z"/></svg></button>
                @else
                  <i class="hidden" video-title></i>
                @endif
              </p>
              <small class="text-md font-poppins text-slate-500 italic"
                >{{ Carbon\Carbon::parse($video->created_at)->format('l d F Y | h:i:s A') }}</small
              >
            </div>
          </div>
        </div>
        <div class="w-full md:p-2 p-4 bg-[#DBF1F030] rounded-lg my-6 shadow-main flex flex-col md:flex-row gap-4 items-center justify-between">
          <div class="flex gap-4 items-start justify-start w-full md:w-auto">
            <figure class="border-4 rounded-full border-solid border-primary">
              <img
                src="{{ $video->user->picture }}"
                class="w-16 h-16 rounded-full border border-primary shadow-main"
                alt="User Profile Image"
              />
            </figure>
            <div class="my-auto lg:pr-2">
              <h1 class="text-2xl font-medium font-primary capitalize text-primary tracking-wide leading-6">
                {{ $video->user->name }}
              </h1> 
              <p class="font-light font-poppins text-sm leading-5 text-slate-500">
                A enthusiastic software developer.
              </p>
            </div>
          </div>
          <div class="flex gap-6 items-center justify-center">
            <div class="pt-2.5 pb-1.5 px-6 bg-white/30 shadow-main rounded-full">
              <div class="flex gap-5">
                <div class="flex items-center justify-center gap-2.5 group {{ $currentUserDislike ? 'active' : '' }}" id="like-content">
                  <figure like-button="{{ $videoAcrionUrl("like") }}" class="mb-2.5 mt-1.5">
                    <i class="cursor-pointer duration-500 hover:drop-shadow-primary">
                      <svg
                        width="27"
                        height="24"
                        viewBox="0 0 27 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          d="M16.1597 0.748686C17.5003 1.01795 18.3717 2.32801 18.1036 3.67432L17.985 4.26462C17.7117 5.64718 17.2064 6.96242 16.5 8.15856H23.925C25.2914 8.15856 26.4 9.27185 26.4 10.6441C26.4 11.602 25.8586 12.4357 25.0645 12.8499C25.6266 13.3056 25.9875 14.0046 25.9875 14.7865C25.9875 15.9982 25.1213 17.008 23.9817 17.2254C24.2086 17.6034 24.3375 18.0436 24.3375 18.5148C24.3375 19.6177 23.6208 20.555 22.6308 20.876C22.6669 21.0469 22.6875 21.2281 22.6875 21.4145C22.6875 22.7867 21.5789 23.9 20.2125 23.9H15.1852C14.2055 23.9 13.2516 23.61 12.4369 23.0663L10.4517 21.7356C9.075 20.8139 8.25 19.2604 8.25 17.5983V15.615V13.1295V11.8402C8.25 10.3282 8.93578 8.90421 10.1062 7.95661L10.4878 7.65111C11.8542 6.55335 12.7875 5.01027 13.1278 3.29114L13.2464 2.70083C13.5145 1.35452 14.8191 0.479425 16.1597 0.748686ZM1.65 8.98706H4.95C5.86266 8.98706 6.6 9.72753 6.6 10.6441V22.243C6.6 23.1595 5.86266 23.9 4.95 23.9H1.65C0.737344 23.9 0 23.1595 0 22.243V10.6441C0 9.72753 0.737344 8.98706 1.65 8.98706Z"
                          class="fill-secondary group-[.active]:fill-primary"
                        ></path></svg></i> 
                  </figure>
                  <p class="text-secondary group-[.active]:text-primary font-semibold font-mono tracking-wide text-xl">{{ $video->likes_count }}</p>
                </div>
                <p class="border-r border-solid border-slate-400"></p>
                <div class="flex items-center justify-center gap-2.5 group {{ $currentUserLike ? 'active' : '' }}" id="dislike-content">
                  <figure dislike-button="{{ $videoAcrionUrl("dislike") }}" class="mt-2.5 mb-1.5">
                    <i class="cursor-pointer duration-500 hover:drop-shadow-primary">
                      <svg
                        width="27"
                        height="24"
                        viewBox="0 0 27 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          d="M10.8403 23.8514C9.49969 23.5821 8.62828 22.272 8.89641 20.9257L9.015 20.3354C9.28828 18.9529 9.79359 17.6376 10.5 16.4415L3.075 16.4415C1.70859 16.4415 0.6 15.3282 0.6 13.956C0.6 12.998 1.14141 12.1644 1.93547 11.7501C1.37344 11.2944 1.0125 10.5954 1.0125 9.81349C1.0125 8.60182 1.87875 7.59209 3.01828 7.37461C2.79141 6.9966 2.6625 6.55646 2.6625 6.08526C2.6625 4.98232 3.37922 4.04508 4.36922 3.72404C4.33313 3.55316 4.3125 3.37193 4.3125 3.18551C4.3125 1.81332 5.42109 0.700024 6.7875 0.700024H11.8148C12.7945 0.700024 13.7484 0.989998 14.5631 1.5337L16.5483 2.86447C17.925 3.78617 18.75 5.33961 18.75 7.00178V8.985V11.4705V12.7598C18.75 14.2718 18.0642 15.6958 16.8938 16.6434L16.5122 16.9489C15.1458 18.0467 14.2125 19.5898 13.8722 21.3089L13.7536 21.8992C13.4855 23.2455 12.1809 24.1206 10.8403 23.8514ZM25.35 15.613H22.05C21.1373 15.613 20.4 14.8725 20.4 13.956L20.4 2.35702C20.4 1.44049 21.1373 0.700024 22.05 0.700024H25.35C26.2627 0.700024 27 1.44049 27 2.35702L27 13.956C27 14.8725 26.2627 15.613 25.35 15.613Z"
                          class="fill-secondary group-[.active]:fill-primary"
                        ></path></svg>
                      </i> 
                  </figure>
                  <p class="text-secondary group-[.active]:text-primary  font-semibold font-mono tracking-wide text-xl">{{ $video->dislikes_count }}</p>
                </div>
              </div>
            </div>

            <a href="https://drive.usercontent.google.com/u/0/uc?id={{ $video->video_id }}&export=download" target="_blank">
              <i class="text-secondary  w-12 h-12 flex items-center justify-center shadow-main rounded-full hover:bg-primary duration-500 hover:drop-shadow-primary group">
                <svg
                  width="30"
                  height="24"
                  viewBox="0 0 42 30"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M9.45 30C4.23281 30 0 25.6808 0 20.3571C0 16.1518 2.63812 12.5759 6.31312 11.2567C6.30656 11.0759 6.3 10.8951 6.3 10.7143C6.3 4.79464 10.9987 0 16.8 0C20.6916 0 24.0844 2.15625 25.9022 5.37054C26.8997 4.6875 28.1072 4.28571 29.4 4.28571C32.8781 4.28571 35.7 7.16518 35.7 10.7143C35.7 11.5312 35.5491 12.308 35.28 13.0312C39.1125 13.8214 42 17.2835 42 21.4286C42 26.1629 38.2397 30 33.6 30H9.45ZM14.6344 18.817L19.8844 24.1741C20.5012 24.8036 21.4987 24.8036 22.1091 24.1741L27.3591 18.817C27.9759 18.1875 27.9759 17.1696 27.3591 16.5469C26.7422 15.9241 25.7447 15.9174 25.1344 16.5469L22.575 19.1585V10.1786C22.575 9.28795 21.8728 8.57143 21 8.57143C20.1272 8.57143 19.425 9.28795 19.425 10.1786V19.1585L16.8656 16.5469C16.2487 15.9174 15.2512 15.9174 14.6409 16.5469C14.0306 17.1763 14.0241 18.1942 14.6409 18.817H14.6344Z"
                    class="fill-primary group-hover:fill-white duration-500"
                  ></path></svg
              ></i>
            </a>

            <div class="w-12 h-12 flex items-center justify-center bg-white/30 shadow-main rounded-full duration-500 hover:bg-primary group hover:drop-shadow-primary" id="share-icon">
              <i class="m-auto cursor-pointer"
                ><svg
                  width="27"
                  height="24"
                  viewBox="0 0 30 27"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M17.9 0.704051C17.2352 1.00352 16.8017 1.6788 16.8017 2.41867V6.17674H10.3275C4.70887 6.17674 0.153839 10.8039 0.153839 16.5114C0.153839 23.1644 4.86495 26.1356 5.9459 26.7346C6.09041 26.8168 6.25227 26.8461 6.41412 26.8461C7.04419 26.8461 7.55288 26.3235 7.55288 25.6894C7.55288 25.249 7.30432 24.8438 6.98639 24.5443C6.44302 24.0217 5.70312 22.9941 5.70312 21.209C5.70312 18.0969 8.18873 15.5719 11.2524 15.5719H16.8017V19.33C16.8017 20.0699 17.2294 20.7451 17.9 21.0446C18.5705 21.3441 19.3451 21.2208 19.8885 20.7275L29.1373 12.2719C29.5246 11.9137 29.75 11.4087 29.75 10.8743C29.75 10.34 29.5303 9.83499 29.1373 9.4768L19.8885 1.02114C19.3451 0.522019 18.5647 0.398707 17.9 0.704051Z"
                    class="fill-primary group-hover:fill-white duration-500"
                  ></path></svg
              ></i>
            </div>
          </div>
        </div>
      </article>

      <!-- Comments Section -->
      <article class="w-full xl:w-35/100">
        <div class="bg-[#DBF1F030] p-4 shadow-main" comment-box="{{ $videoAcrionUrl("storeComment") }}">

          <div class="w-full">
            <!-- Render the Main Comment Text Area -->
            <textarea name="" cols="30" rows="6" class="w-full resize-none outline-none border border-solid border-green-500 p-3 text-lg font-mono focus:border-2 text-slate-800 rounded-md" placeholder="Write here what's on your mind..." id="comment-textarea"></textarea>
          </div>

          <div class="relative">
            <div class="absolute z-10 p-2 bg-white bottom-3 right-1.5">
              <div class="bg-primary text-white font-white flex gap-1 rounded-lg shadow-main">
                <i class="block py-2 px-3 bg-primary rounded-lg duration-500 hover:bg-secondary hover:drop-shadow-secondary cursor-pointer" id="comment-refresh-btn">
                  <svg
                    width="20"
                    height="24"
                    viewBox="0 0 20 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M11.0089 22.7885C10.4508 23.3354 9.54458 23.3354 8.98655 22.7885L3.27226 17.1885C2.71422 16.6417 2.71422 15.7535 3.27226 15.2067C3.8303 14.6598 4.73655 14.6598 5.29458 15.2067L8.57137 18.4179V9.19979C8.57137 8.42542 9.20976 7.79979 9.99994 7.79979C10.7901 7.79979 11.4285 8.42542 11.4285 9.19979V18.4179L14.7053 15.2067C15.2633 14.6598 16.1696 14.6598 16.7276 15.2067C17.2857 15.7535 17.2857 16.6417 16.7276 17.1885L11.0133 22.7885H11.0089ZM2.85708 7.79979C2.85708 8.57417 2.21869 9.19979 1.42851 9.19979C0.638332 9.19979 -6.10352e-05 8.57417 -6.10352e-05 7.79979V4.99979C-6.10352e-05 2.68104 1.91958 0.799793 4.28565 0.799793H15.7142C18.0803 0.799793 19.9999 2.68104 19.9999 4.99979V7.79979C19.9999 8.57417 19.3615 9.19979 18.5714 9.19979C17.7812 9.19979 17.1428 8.57417 1.1428 7.79979V4.99979C17.1428 4.22542 16.5044 3.59979 15.7142 3.59979H4.28565C3.49547 3.59979 2.85708 4.22542 2.85708 4.99979V7.79979Z"
                      fill="#F1F5F9"
                    ></path>
                  </svg>
                </i>
                <span class="border-r border-solid border-slate-200 my-2"></span>
                <i class="block py-2 px-3 bg-primary rounded-lg duration-500 hover:bg-secondary hover:drop-shadow-secondary cursor-pointer" id="comment-submit-btn">
                  <svg
                    width="25"
                    height="24"
                    viewBox="0 0 25 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M23.5492 0.262625C24.0227 0.590682 24.2711 1.15775 24.182 1.72482L21.182 21.2208C21.1117 21.6754 20.8351 22.0737 20.432 22.2987C20.0289 22.5236 19.546 22.5518 19.1195 22.3737L13.5131 20.0445L10.3021 23.5172C9.88495 23.9718 9.22869 24.1217 8.65212 23.8968C8.07555 23.6718 7.70054 23.1141 7.70054 22.4955V18.5776C7.70054 18.3901 7.77085 18.212 7.89742 18.0761L15.7538 9.50446C16.0257 9.20921 16.0163 8.75462 15.735 8.47342C15.4538 8.19223 14.9991 8.17349 14.7038 8.44062L5.16925 16.9092L1.03012 14.8377C0.533242 14.5893 0.214487 14.0926 0.200424 13.5396C0.186361 12.9866 0.476991 12.471 0.955123 12.1945L21.9554 0.197013C22.457 -0.0888649 23.0758 -0.0607457 23.5492 0.262625Z"
                      class="fill-white"
                    ></path>
                  </svg>
                </i>
              </div>
            </div>
          </div>

          <!-- Comments -->
          <div
            class="mt-6 max-h-[calc(100vh_-_365px)] overflow-x-hidden pr-3"
            id="custom-scrollbar"
          >
            <div class="w-full" video-comments>

              @foreach ($video->comments as $comment)
                <div class="p-2 bg-white rounded-md border border-solid border-slate-300 mt-3">
                  <div class="flex gap-4">
                    <figure>
                      <img 
                        src="{{ $comment['user']['picture'] }}"
                        class="!w-10 !h-10 !min-w-10 rounded-full border border-primary shadow-main"
                        alt="User Profile Image"
                      />
                    </figure>
                    <div class="my-auto w-full">
                      <div class="w-full flex items-center justify-between">
                        <div class="my-auto">
                          <h1 class="leading-3">
                            <span
                              class="text-2xl font-medium font-primary capitalize text-primary tracking-wide"
                              >{{ $comment['user']['name'] }}</span
                            ><br class="block sm:hidden" /><span
                              class="text-secondary text-sm italic font-light font-poppins sm:ml-3 my-auto leading-[0.1] sm:leading-4"
                              >{{ Carbon\Carbon::parse($comment['updated_at'])->diffForHumans() }}</span
                            >
                          </h1> 
                        </div>
                        
                        @auth
                          <div class="text-end">
                            <button
                              class="bg-primary p-3 text-white fill-white rounded-full shadow-main duration-500 hover:bg-secondary hover:shadow-secondary"
                              edit-comment="{{ json_encode(['description'=> $comment['description'], 'label'=> 'Change Your Comment Descriptions:', 'editUrl'=> route('user.video.editComment', ['id'=> $comment['id'], 'userId'=> $comment['user_id'], 'videoId'=> $comment['video_id']]), 'deleteUrl'=> route('user.video.deleteComment', ['id'=> $comment['id'], 'userId'=> $comment['user_id'], 'videoId'=> $comment['video_id']]) ]) }}"
                            >
                              <svg xmlns="http://www.w3.org/2000/svg"   width="20" height="20" viewBox="0 0 512 512"><path d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z"/></svg>
                            </button>
                          </div>
                        @endauth
                      </div> 
                      <div class="font-normal font-poppins text-md leading-6 text-slate-700 pt-2 px-2 relative -ml-14 border-t border-slate-300 mt-4">
                        <p class="leading-6 w-full text-start">
                          {!! $comment['description'] !!}
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
              
          </div>
        </div>
      </article>
    </div>
  </main>


  <footer></footer>

  <!-- Unnecessary elements/block Just build tailwindcss for production purpose -->
  <div class="!hidden">
    <div class="fixed top-0 left-0 w-full bg-black/50 min-h-screen flex items-center justify-center z-20 font-oswald" id="edit-form">
      <form
        class="container xl:max-w-3xl w-full object-cover bg-cover h-full p-4 md:p-10 rounded-lg shadow-primary-deep relative"
        style="background-image: url('{{ asset('/assets/images/bg.jpg') }}')">
        @csrf
        
        <div class="absolute top-2 right-2">
          <button class="text-lg font-bold bg-primary duration-500 text-slate-100 hover:bg-red-500 py-1 px-3 rounded-full hover:rotate-90" id="remove-edit-form">X</button>
        </div>
        
        <div>
          <label for="change_video_title" class="text-md font-light text-slate-600 capitalize mb-1 font-jockey">Change Your Video Title: <span class="text-sm pl-1 text-red-400 font-light font-poppins">(max 254 letters)</span></label>
          <input type="text" class="w-full text-lg font-mono text-secondary font-semibold focus:border-4 focus:border-primary px-4 py-1.5 bg-slate-200 rounded outline-none border-solid border border-slate-600" value="{{ $video->title }}">
        </div>

        <div class="mt-4 w-full flex gap-4 items-center justify-end">
          <button class="text-lg font-semibold tracking-wide rounded-md hover:tracking-wider hover:bg-primary hover:drop-shadow-primary duration-500 uppercase bg-secondary text-slate-100 py-1 px-3">update</button>
          <p class="text-lg font-semibold tracking-wide rounded-md hover:tracking-wider hover:bg-red-500 hover:drop-shadow-primary duration-500 uppercase bg-red-400 text-slate-100 py-1 px-3">delete</p>
        </div>
      </form>
    </div>
</section>
  

<script> 
</script>
<script src="{{ asset('assets/js/video-player.js') }}"></script>

</div>

@endsection

