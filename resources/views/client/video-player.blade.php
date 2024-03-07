@extends('layouts.client-layout')
@section('content')

@php
  $videoAcrionUrl = function (string $routeName, $as = 'user.video.') use($video) {
    if(Auth::check()){
      $user_id = Auth::user()->id;
      $video_id = $video['video']['id'];

      if(Route::has("{$as}{$routeName}")){
        return route("{$as}{$routeName}", compact('user_id', 'video_id'));
      } else return "#";

    } else return "#";
  }
@endphp 

<!-- // src="https://www.youtube.com/embed/IHHwVoKroFM?si=P7DVqBgvxDsg0kde"-->
<section
  class="w-full object-cover bg-cover h-full"
  style="background-image: url('{{ asset('/assets/images/bg.jpg') }}')"
>
  <header>
    <nav class="fixed left-0 top-0 flex items-center justify-start">
      @auth 
        <div class="m-6 p-4 bg-slate-100 rounded-full my-6 shadow-main flex flex-col md:flex-row gap-4 items-center justify-start group" login-bubble>
          <div class="flex shadow-primary-deep items-start justify-start w-full md:w-auto bg-transparent">
            <figure class="border-4 rounded-full border-solid border-primary cursor-pointer">
              <img
                src="{{ Auth::user()->picture }}"
                class="w-16 h-16 rounded-full border border-primary shadow-main"
                alt="User Profile Image"
              />
            </figure>
            <div class="my-auto opacity-0 group-[.active]:lg:pr-0 overflow-hidden w-0 h-0 group-hover:w-60 group-[.active]:w-60 group-hover:h-auto group-[.active]:h-auto group-hover:ml-4 group-[.active]:ml-4 group-hover:overflow-visible group-[.active]:overflow-visible group-hover:opacity-100 group-[.active]:opacity-100 duration-700 bg-transparent">
              <h1
                class="text-2xl font-medium font-primary capitalize tracking-wide leading-3 flex gap-2 text-nowrap cursor-pointer"
              >
                <span class="text-secondary">{{ Auth::user()->name }}</span>
                
                <span class="fill-primary text-primary -mt-1">  
                  <svg width="24" height="24" viewBox="0 0 30 30" fill="none"  xmlns="http://www.w3.org/2000/svg">
                    <path d="M19.7969 10.7666C21.3749 12.4999 21.4124 12.0276 19.7723 13.6722C17.9444 15.5055 16.0978 17.3214 14.2549 19.1397C14.0387 19.3543 13.8586 19.6327 13.5278 19.6554C13.2649 19.6385 13.1166 19.4711 12.9644 19.3167C11.7582 18.0971 10.5616 16.8664 9.34428 15.656C8.93497 15.2493 8.869 14.9145 9.32357 14.4871C11.2791 12.6447 10.7398 12.746 12.4155 14.4326C13.5278 15.5523 13.5143 15.5639 14.6228 14.4663C15.8647 13.2376 17.1249 12.0252 18.3403 10.7719C18.8661 10.2282 19.259 10.1751 19.7959 10.7661L19.7969 10.7666Z" fill="rgb(0 158 145)"/>
                    <path d="M27.7397 10.3299C27.3564 10.0024 27.2457 9.69939 27.2982 9.21213C27.7002 5.5027 24.6493 2.37461 20.8981 2.66648C20.3044 2.71376 19.9534 2.59508 19.5585 2.12808C17.1725 -0.702351 12.8387 -0.71007 10.4513 2.10927C10.0641 2.56662 9.72803 2.71907 9.1213 2.67034C5.32105 2.36158 2.33411 5.45591 2.70778 9.28209C2.75304 9.74522 2.61966 10.0178 2.27392 10.3135C-0.752509 12.9201 -0.759732 17.0965 2.26284 19.6766C2.64614 20.0042 2.75304 20.3091 2.70248 20.7963C2.32496 24.4778 5.22186 27.5586 8.90557 27.3386C9.67554 27.2932 10.119 27.5041 10.6246 28.0762C12.8599 30.6037 17.0098 30.6452 19.2884 28.1742C19.8518 27.5644 20.327 27.0072 21.0898 27.3646C24.798 27.4587 27.6949 24.3422 27.3039 20.8209C27.2515 20.3467 27.3227 20.0268 27.7152 19.6896C30.7527 17.085 30.7623 12.9143 27.7397 10.3299ZM27.1253 15.7013C26.8715 17.1448 25.8141 17.8583 24.5669 18.2949C23.8923 18.5323 23.716 18.7334 24.0599 19.4373C24.6233 20.5894 24.8712 21.8143 24.1181 23.0131C23.2297 24.4247 21.6777 24.9047 20.0246 24.2988C19.1155 23.9649 18.4524 24.2473 18.0354 25.1459C17.3704 26.5763 16.2884 27.2633 14.7836 27.205C13.405 27.1504 12.5633 26.3675 11.9903 25.1855C11.3383 23.84 11.3176 23.8284 9.93894 24.3234C8.53576 24.828 7.31267 24.6548 6.26823 23.5254C5.71013 22.9214 5.3928 22.2417 5.43999 21.5682C5.42892 20.8378 5.57915 20.2999 5.78573 19.7726C6.22922 18.6529 6.23259 18.6432 5.09232 18.1444C3.97854 17.6571 3.11997 16.9547 2.87728 15.6864C2.52576 13.842 3.2418 12.6244 5.36632 11.7584C6.11606 11.4535 6.27352 11.2219 5.90371 10.4636C5.28542 9.20055 5.13181 7.88496 6.1045 6.67309C7.20529 5.30105 8.56369 5.02799 10.4797 5.91084C11.1919 6.23841 11.4847 6.14434 11.7423 5.39512C12.2272 3.98159 13.106 2.9352 14.7273 2.80349C16.3765 2.66986 17.4682 3.39061 18.2213 5.31407C18.5463 6.14579 18.8261 6.2307 19.5999 5.85633C20.8736 5.24267 22.1867 5.14474 23.3756 6.14627C24.6589 7.22451 24.9574 8.56857 24.1268 10.3772C23.7473 11.2036 23.8769 11.4743 24.707 11.8076C26.7473 12.6263 27.4518 13.8459 27.1248 15.7018L27.1253 15.7013Z" fill="rgb(0 158 145)"/>
                    </svg>
                </span>
              </h1>
              <p
                class="font-light font-poppins text-sm leading-6 text-slate-500 text-nowrap"
              >
                {{ __('@screen-wave') }}
              </p>
              <p
                class="font-light font-poppins text-sm leading-3 text-slate-500 text-nowrap"
              >
                A enthusiastic software developer.
              </p>
            </div>
          </div>
          
          <div class="hidden group-hover:block group-[.active]:block">
            <a href="#logout" class="block">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="32" height="32" class="fill-primary hover:fill-red-500"><path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"/></svg>
            </a>
          </div>
        </div>
      @else
        <div class="m-6 p-4 bg-slate-100 rounded-full my-6 shadow-main flex flex-col md:flex-row gap-4 items-center justify-between">
          <div class="flex shadow-primary-deep items-start justify-start w-full md:w-auto group" login-bubble>
            <figure class="cursor-pointer">
              <img
                src="{{ asset('assets/images/google.png') }}"
                class="w-16 h-16 rounded-full"
                alt="User Profile Image"
              />
            </figure>
            <div class="opacity-0 group-[.active]:lg:pr-0 overflow-hidden w-0 h-0 group-hover:w-60 group-[.active]:w-60 group-hover:h-auto group-[.active]:h-auto group-hover:ml-4 group-[.active]:ml-4 group-hover:overflow-visible group-[.active]:overflow-visible group-hover:opacity-100 group-[.active]:opacity-100 duration-700 flex gap-2 my-auto">
              <a href="{{ route('google.oAuth.') }}" target="_blank" class="text-2xl hover:underline hover:text-primary hover:tracking-wide font-medium font-primary capitalize tracking-wide leading-3 flex gap-2 text-nowrap cursor-pointer">
                sign in with google
              </a>
              <span class="fill-red-500 text-primary -mt-1">  
                <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"> <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zm0-384c13.3 0 24 10.7 24 24V264c0 13.3-10.7 24-24 24s-24-10.7-24-24V152c0-13.3 10.7-24 24-24zM224 352a32 32 0 1 1 64 0 32 32 0 1 1 -64 0z"/></svg>
              </span> 
            </div>
          </div>
        </div>
      @endauth
    </nav>
  </header>


  <main class="w-full min-h-screen flex flex-col items-center justify-center">
    <div class="container flex flex-col xl:flex-row gap-6 py-4">
      <article class="w-full xl:w-65/100">
        <div class="w-full">
          <div class="w-full p-4 shadow-main bg-transparent">
            <iframe
              class="w-full min-h-72 sm:min-h-96 md:min-h-[60vh] rounded-xl border border-solid border-primary"
              title="YouTube video player"
              frameborder="0"
              src="https://drive.google.com/file/d/{{ $video['video']['video_id'] }}/preview"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
              allowfullscreen=""
            ></iframe>
          </div>

          <div class="font-primary pt-4 flex gap-2">
            <div class="w-full"> 
              <p class="text-sm font-bold text-secondary">
                <span class="tracking-wide">{{ number_format($video['video']['views']) }}</span>
                <span class="text-sm font-light text-slate-600 pl-1">views</span>
              </p>
              <p
                class="break-words tracking-wide leading-6 pb-2 sm:pb-0 text-2xl md:text-3xl text-secondary"
              >
                <!--Figma Autolayout Wrap: Unlocking Seamless and Responsive Designs!
                | CONFIG 2023 -->
                {{ $video['video']['title'] }}
              </p>
              <small class="text-md font-poppins text-slate-500 italic"
                >{{ Carbon\Carbon::parse($video['video']['created_at'])->format('l d F Y | h:i:s A') }}</small
              >
            </div>
            
            @if(Auth::id() == $video['user']['id'])
              <div class="text-end">
                <button video-title="{{ json_encode(['title'=> $video['video']['title'], 'label'=> 'Change Your Video Title:', 'url'=> $videoAcrionUrl('edit-video-title', 'frontend.')]) }}"
                  class="bg-primary p-2 text-white fill-white rounded-full shadow-main duration-500 hover:bg-secondary hover:shadow-secondary"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 192 512"
                    width="26"
                    height="26"
                  >
                    <path
                      d="M96 184c39.8 0 72 32.2 72 72s-32.2 72-72 72-72-32.2-72-72 32.2-72 72-72zM24 80c0 39.8 32.2 72 72 72s72-32.2 72-72S135.8 8 96 8 24 40.2 24 80zm0 352c0 39.8 32.2 72 72 72s72-32.2 72-72-32.2-72-72-72-72 32.2-72 72z"
                    ></path>
                  </svg>
                </button>
              </div>

            @endif
          </div>
        </div>
        <div class="w-full md:p-2 p-4 bg-[#DBF1F030] rounded-lg my-6 shadow-main flex flex-col md:flex-row gap-4 items-center justify-between">
          <div class="flex gap-4 items-start justify-start w-full md:w-auto">
            <figure class="border-4 rounded-full border-solid border-primary">
              <img
                src="{{ $video['user']['picture'] }}"
                class="w-16 h-16 rounded-full border border-primary shadow-main"
                alt="User Profile Image"
              />
            </figure>
            <div class="my-auto lg:pr-2">
              <h1
                class="text-2xl font-medium font-primary capitalize text-primary tracking-wide leading-3"
              >
                {{ $video['user']['name'] }}
              </h1>
              <p
                class="font-light font-poppins text-sm leading-6 text-slate-500"
              >
                {{ __('@screen-wave') }}
              </p>
              <p
                class="font-light font-poppins text-sm leading-[0.4] text-slate-500"
              >
                A enthusiastic software developer.
              </p>
            </div>
          </div>
          <div class="flex gap-6 items-center justify-center">
            <div class="pt-2.5 pb-1.5 px-6 bg-white/30 shadow-main rounded-full">
              <div class="flex gap-5">
                <div class="flex items-center justify-center gap-2.5 group {{ $video['current_user_like_dislike']['like'] == 1 ? 'active' : '' }}" id="like-content">
                  <figure like-button="{{ $videoAcrionUrl("like") }}">
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
                      <small class="text-secondary group-[.active]:text-primary leading-3">Like</small>
                  </figure>
                  <p class="text-secondary group-[.active]:text-primary font-semibold font-mono tracking-wide text-xl">{{ $video['video']['likes_count'] }}</p>
                </div>
                <p class="border-r border-solid border-slate-400"></p>
                <div class="flex items-center justify-center gap-2.5 group {{ $video['current_user_like_dislike']['dislike'] == 1 ? 'active' : '' }}" id="dislike-content">
                  <figure dislike-button="{{ $videoAcrionUrl("dislike") }}">
                    <i class="cursor-pointer duration-500 hover:drop-shadow-primary"
                      ><svg
                        width="27"
                        height="24"
                        viewBox="0 0 27 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          d="M10.8403 23.8514C9.49969 23.5821 8.62828 22.272 8.89641 20.9257L9.015 20.3354C9.28828 18.9529 9.79359 17.6376 10.5 16.4415L3.075 16.4415C1.70859 16.4415 0.6 15.3282 0.6 13.956C0.6 12.998 1.14141 12.1644 1.93547 11.7501C1.37344 11.2944 1.0125 10.5954 1.0125 9.81349C1.0125 8.60182 1.87875 7.59209 3.01828 7.37461C2.79141 6.9966 2.6625 6.55646 2.6625 6.08526C2.6625 4.98232 3.37922 4.04508 4.36922 3.72404C4.33313 3.55316 4.3125 3.37193 4.3125 3.18551C4.3125 1.81332 5.42109 0.700024 6.7875 0.700024H11.8148C12.7945 0.700024 13.7484 0.989998 14.5631 1.5337L16.5483 2.86447C17.925 3.78617 18.75 5.33961 18.75 7.00178V8.985V11.4705V12.7598C18.75 14.2718 18.0642 15.6958 16.8938 16.6434L16.5122 16.9489C15.1458 18.0467 14.2125 19.5898 13.8722 21.3089L13.7536 21.8992C13.4855 23.2455 12.1809 24.1206 10.8403 23.8514ZM25.35 15.613H22.05C21.1373 15.613 20.4 14.8725 20.4 13.956L20.4 2.35702C20.4 1.44049 21.1373 0.700024 22.05 0.700024H25.35C26.2627 0.700024 27 1.44049 27 2.35702L27 13.956C27 14.8725 26.2627 15.613 25.35 15.613Z"
                          class="fill-secondary group-[.active]:fill-primary"
                        ></path></svg></i
                    ><small class="text-secondary group-[.active]:text-primary leading-3">Dilike</small>
                  </figure>
                  <p class="text-secondary group-[.active]:text-primary  font-semibold font-mono tracking-wide text-xl">{{ $video['video']['dislikes_count'] }}</p>
                </div>
              </div>
            </div>
            <div
              class="w-16 h-16 flex items-center justify-center bg-white/30 shadow-main rounded-full duration-500 hover:bg-primary group hover:drop-shadow-primary"
            >
              <i class="m-auto" id="share-icon"
                ><svg
                  width="30"
                  height="27"
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
        <div
          class="bg-white shadow-main p-2 xl:p-4 w-full flex justify-between items-center rounded-xl"
        >
          <div
            class="flex gap-3 md:gap-6 items-center justify-center text-secondary tracking-wide"
          >
            <i
              class="bg-primary w-12 h-12 flex items-center justify-center shadow-main rounded-full"
              ><svg
                width="30"
                height="24"
                viewBox="0 0 42 30"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M9.45 30C4.23281 30 0 25.6808 0 20.3571C0 16.1518 2.63812 12.5759 6.31312 11.2567C6.30656 11.0759 6.3 10.8951 6.3 10.7143C6.3 4.79464 10.9987 0 16.8 0C20.6916 0 24.0844 2.15625 25.9022 5.37054C26.8997 4.6875 28.1072 4.28571 29.4 4.28571C32.8781 4.28571 35.7 7.16518 35.7 10.7143C35.7 11.5312 35.5491 12.308 35.28 13.0312C39.1125 13.8214 42 17.2835 42 21.4286C42 26.1629 38.2397 30 33.6 30H9.45ZM14.6344 18.817L19.8844 24.1741C20.5012 24.8036 21.4987 24.8036 22.1091 24.1741L27.3591 18.817C27.9759 18.1875 27.9759 17.1696 27.3591 16.5469C26.7422 15.9241 25.7447 15.9174 25.1344 16.5469L22.575 19.1585V10.1786C22.575 9.28795 21.8728 8.57143 21 8.57143C20.1272 8.57143 19.425 9.28795 19.425 10.1786V19.1585L16.8656 16.5469C16.2487 15.9174 15.2512 15.9174 14.6409 16.5469C14.0306 17.1763 14.0241 18.1942 14.6409 18.817H14.6344Z"
                  class="fill-white"
                ></path></svg
            ></i>
            <h1 class="text-xl leading-5 md:text-2xl font-primary">
              Download the video from here.
            </h1>
          </div>
          <div>
            <a
              href="https://drive.usercontent.google.com/u/0/uc?id={{ $video['video']['video_id'] }}&export=download" target="_blank"
              class="block bg-primary md:px-6 md:py-2 px-3 py-1 duration-500 hover:drop-shadow-primary hover:bg-secondary hover:tracking-wide text-sm md:text-xl font-primary uppercase text-white rounded-full text-nowrap"
              >Download Now</a
            >
          </div>
        </div>
      </article>

      <!-- Comments Section -->
      <article class="w-full xl:w-35/100">
        <div class="bg-[#DBF1F030] p-4 shadow-main" comment-box="{{ $videoAcrionUrl("store-comment") }}">

          <div class="w-full">
            <!-- Render the Main Comment Text Area -->
            <textarea name="" cols="30" rows="8" class="w-full resize-none outline-none border border-solid border-green-500 p-3 text-lg font-mono focus:drop-shadow-primary text-slate-800 rounded-md" placeholder="Write here what's on your mind..." id="comment-textarea"></textarea>
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

              @foreach ($video['video']['comments'] as $comment)
                <div class="p-2 bg-white rounded-md border border-solid border-slate-300 mt-3">
                  <div class="flex gap-4">
                    <figure>
                      <img 
                        src="{{ $comment['user']['picture'] }}"
                        {{-- src="{{ App\Helper\HelperClass::makeAvatar($comment['user']['picture'], Avatar::create($comment['user']['name'])->toBase64()) }}" --}}
                        {{-- src="{{ file_get_contents($comment['user']['picture']) ? $comment['user']['picture'] : Avatar::create($comment['user']['name'])->toBase64() }}" --}}
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
                          <p
                            class="font-light font-poppins text-sm sm:leading-[.3] text-slate-500"
                          >
                            {{ __('@screen-wave') }}
                          </p>
                        </div>
                        
                        @auth
                          <div class="text-end">
                            <button
                              class="bg-primary p-2 text-white fill-white rounded-full shadow-main duration-500 hover:bg-secondary hover:shadow-secondary"
                              edit-comment="{{ json_encode(['description'=> $comment['description'], 'label'=> 'Change Your Comment Descriptions:', 'editUrl'=> route('user.video.edit-comment', ['id'=> $comment['id'], 'user_id'=> $comment['user_id'], 'video_id'=> $comment['video_id']]), 'deleteUrl'=> route('user.video.delete-comment', ['id'=> $comment['id'], 'user_id'=> $comment['user_id'], 'video_id'=> $comment['video_id']]) ]) }}"
                            >
                              <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 192 512"
                                width="26"
                                height="26"
                              >
                                <path
                                  d="M96 184c39.8 0 72 32.2 72 72s-32.2 72-72 72-72-32.2-72-72 32.2-72 72-72zM24 80c0 39.8 32.2 72 72 72s72-32.2 72-72S135.8 8 96 8 24 40.2 24 80zm0 352c0 39.8 32.2 72 72 72s72-32.2 72-72-32.2-72-72-72-72 32.2-72 72z"
                                ></path>
                              </svg>
                            </button>
                          </div>
                        @endauth
                      </div>
                      <div
                        class="font-normal font-poppins text-md leading-6 text-slate-700 pt-2 px-2 relative -ml-14"
                      >
                        <p class="leading-6 w-full text-start">
                          {!! $comment['description'] !!}
                        </p>
                        {{-- <div class="absolute bottom-0 right-0 p-1">
                          <button
                            class="cursor-pointer font-semibold bg-white pl-6 text-secondary duration-300 hover:underline italic hover:text-primary pr-2 py-0.5 text-sm"
                          >
                            show more...
                          </button>
                        </div> --}}
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
<div class="hidden">
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
        <input type="text" class="w-full text-lg font-mono text-secondary font-semibold focus:border-4 focus:border-primary px-4 py-1.5 bg-slate-200 rounded outline-none border-solid border border-slate-600" value="{{ $video['video']['title'] }}">
      </div>

      <div class="mt-4 w-full flex gap-4 items-center justify-end">
        <button class="text-lg font-semibold tracking-wide rounded-md hover:tracking-wider hover:bg-primary hover:drop-shadow-primary duration-500 uppercase bg-secondary text-slate-100 py-1 px-3">update</button>
        <p class="text-lg font-semibold tracking-wide rounded-md hover:tracking-wider hover:bg-red-500 hover:drop-shadow-primary duration-500 uppercase bg-red-400 text-slate-100 py-1 px-3">delete</p>
      </div>
    </form>
  </div>
</section>
  

{{-- console.log(@json($video)); --}}
<script> 
</script>
<script src="{{ asset('assets/js/video-player.js') }}"></script>

</div>

@endsection