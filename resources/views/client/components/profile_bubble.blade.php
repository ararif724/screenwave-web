@auth 
    <div class="flex flex-col md:flex-row gap-4 items-center justify-start group py-2 px-4" login-bubble>
        <div class="flex items-start justify-start w-full md:w-auto bg-transparent">
            <figure class="border-4 rounded-full border-solid border-primary cursor-pointer">
                <img
                src="{{ Auth::user()->picture }}"
                class="w-16 h-16 rounded-full border border-primary shadow-main"
                alt="User Profile Image"
                />
            </figure>
            <div class="px-4 py-2 bg-transparent">
                <h1 class="text-2xl font-medium font-primary capitalize tracking-wide leading-3 flex gap-2 text-nowrap cursor-pointer">
                    <span class="text-secondary">{{ Auth::user()->name }}</span>
                    
                    <i class="fill-primary text-primary -mt-1">  
                        <svg width="24" height="24" viewBox="0 0 30 30" fill="none"  xmlns="http://www.w3.org/2000/svg">
                        <path d="M19.7969 10.7666C21.3749 12.4999 21.4124 12.0276 19.7723 13.6722C17.9444 15.5055 16.0978 17.3214 14.2549 19.1397C14.0387 19.3543 13.8586 19.6327 13.5278 19.6554C13.2649 19.6385 13.1166 19.4711 12.9644 19.3167C11.7582 18.0971 10.5616 16.8664 9.34428 15.656C8.93497 15.2493 8.869 14.9145 9.32357 14.4871C11.2791 12.6447 10.7398 12.746 12.4155 14.4326C13.5278 15.5523 13.5143 15.5639 14.6228 14.4663C15.8647 13.2376 17.1249 12.0252 18.3403 10.7719C18.8661 10.2282 19.259 10.1751 19.7959 10.7661L19.7969 10.7666Z" fill="rgb(0 158 145)"/>
                        <path d="M27.7397 10.3299C27.3564 10.0024 27.2457 9.69939 27.2982 9.21213C27.7002 5.5027 24.6493 2.37461 20.8981 2.66648C20.3044 2.71376 19.9534 2.59508 19.5585 2.12808C17.1725 -0.702351 12.8387 -0.71007 10.4513 2.10927C10.0641 2.56662 9.72803 2.71907 9.1213 2.67034C5.32105 2.36158 2.33411 5.45591 2.70778 9.28209C2.75304 9.74522 2.61966 10.0178 2.27392 10.3135C-0.752509 12.9201 -0.759732 17.0965 2.26284 19.6766C2.64614 20.0042 2.75304 20.3091 2.70248 20.7963C2.32496 24.4778 5.22186 27.5586 8.90557 27.3386C9.67554 27.2932 10.119 27.5041 10.6246 28.0762C12.8599 30.6037 17.0098 30.6452 19.2884 28.1742C19.8518 27.5644 20.327 27.0072 21.0898 27.3646C24.798 27.4587 27.6949 24.3422 27.3039 20.8209C27.2515 20.3467 27.3227 20.0268 27.7152 19.6896C30.7527 17.085 30.7623 12.9143 27.7397 10.3299ZM27.1253 15.7013C26.8715 17.1448 25.8141 17.8583 24.5669 18.2949C23.8923 18.5323 23.716 18.7334 24.0599 19.4373C24.6233 20.5894 24.8712 21.8143 24.1181 23.0131C23.2297 24.4247 21.6777 24.9047 20.0246 24.2988C19.1155 23.9649 18.4524 24.2473 18.0354 25.1459C17.3704 26.5763 16.2884 27.2633 14.7836 27.205C13.405 27.1504 12.5633 26.3675 11.9903 25.1855C11.3383 23.84 11.3176 23.8284 9.93894 24.3234C8.53576 24.828 7.31267 24.6548 6.26823 23.5254C5.71013 22.9214 5.3928 22.2417 5.43999 21.5682C5.42892 20.8378 5.57915 20.2999 5.78573 19.7726C6.22922 18.6529 6.23259 18.6432 5.09232 18.1444C3.97854 17.6571 3.11997 16.9547 2.87728 15.6864C2.52576 13.842 3.2418 12.6244 5.36632 11.7584C6.11606 11.4535 6.27352 11.2219 5.90371 10.4636C5.28542 9.20055 5.13181 7.88496 6.1045 6.67309C7.20529 5.30105 8.56369 5.02799 10.4797 5.91084C11.1919 6.23841 11.4847 6.14434 11.7423 5.39512C12.2272 3.98159 13.106 2.9352 14.7273 2.80349C16.3765 2.66986 17.4682 3.39061 18.2213 5.31407C18.5463 6.14579 18.8261 6.2307 19.5999 5.85633C20.8736 5.24267 22.1867 5.14474 23.3756 6.14627C24.6589 7.22451 24.9574 8.56857 24.1268 10.3772C23.7473 11.2036 23.8769 11.4743 24.707 11.8076C26.7473 12.6263 27.4518 13.8459 27.1248 15.7018L27.1253 15.7013Z" fill="rgb(0 158 145)"/>
                        </svg>
                    </i>
                </h1>
                <p class="font-light font-poppins text-sm leading-6 text-slate-500 text-nowrap">{{ __('@screen-wave') }}</p>
                <p class="font-light font-poppins text-sm leading-3 text-slate-500 text-nowrap">A enthusiastic software developer.</p>
            </div>
        </div>
        
        <div class="">
            <a href="#logout" class="block">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="32" height="32" class="fill-primary hover:fill-red-500"><path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"/></svg>
            </a>
        </div>
    </div>
@else
    <div class="py-2 px-4 flex flex-col md:flex-row gap-4 items-center justify-between">
        <div class="flex flex-row-reverse gap-4 items-start justify-start w-full md:w-auto group" login-bubble>
            <figure class="cursor-pointer">
                <img
                src="{{ asset('assets/images/google.png') }}"
                class="w-16 h-16 rounded-full"
                alt="User Profile Image"
                />
            </figure>
            <div class="flex gap-2 my-auto">
                <i class="fill-red-500 text-primary -mt-1 pr-1">  
                    <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"> <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zm0-384c13.3 0 24 10.7 24 24V264c0 13.3-10.7 24-24 24s-24-10.7-24-24V152c0-13.3 10.7-24 24-24zM224 352a32 32 0 1 1 64 0 32 32 0 1 1 -64 0z"/></svg>                
                </i> 

                <a href="{{ route('google.oAuth.') }}" target="_blank" class="duration-500 text-2xl hover:underline hover:text-primary font-medium font-primary capitalize tracking-wide leading-3 flex gap-2 text-nowrap cursor-pointer text-secondary">sign in with google</a>
            </div>
        </div>
    </div>
@endauth

































{{-- <nav class="fixed left-0 bottom-0 lg:top-0 lg:bottom-auto flex items-center justify-start">
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
                    <h1 class="text-2xl font-medium font-primary capitalize tracking-wide leading-3 flex gap-2 text-nowrap cursor-pointer">
                        <span class="text-secondary">{{ Auth::user()->name }}</span>
                        
                        <i class="fill-primary text-primary -mt-1">  
                            <svg width="24" height="24" viewBox="0 0 30 30" fill="none"  xmlns="http://www.w3.org/2000/svg">
                            <path d="M19.7969 10.7666C21.3749 12.4999 21.4124 12.0276 19.7723 13.6722C17.9444 15.5055 16.0978 17.3214 14.2549 19.1397C14.0387 19.3543 13.8586 19.6327 13.5278 19.6554C13.2649 19.6385 13.1166 19.4711 12.9644 19.3167C11.7582 18.0971 10.5616 16.8664 9.34428 15.656C8.93497 15.2493 8.869 14.9145 9.32357 14.4871C11.2791 12.6447 10.7398 12.746 12.4155 14.4326C13.5278 15.5523 13.5143 15.5639 14.6228 14.4663C15.8647 13.2376 17.1249 12.0252 18.3403 10.7719C18.8661 10.2282 19.259 10.1751 19.7959 10.7661L19.7969 10.7666Z" fill="rgb(0 158 145)"/>
                            <path d="M27.7397 10.3299C27.3564 10.0024 27.2457 9.69939 27.2982 9.21213C27.7002 5.5027 24.6493 2.37461 20.8981 2.66648C20.3044 2.71376 19.9534 2.59508 19.5585 2.12808C17.1725 -0.702351 12.8387 -0.71007 10.4513 2.10927C10.0641 2.56662 9.72803 2.71907 9.1213 2.67034C5.32105 2.36158 2.33411 5.45591 2.70778 9.28209C2.75304 9.74522 2.61966 10.0178 2.27392 10.3135C-0.752509 12.9201 -0.759732 17.0965 2.26284 19.6766C2.64614 20.0042 2.75304 20.3091 2.70248 20.7963C2.32496 24.4778 5.22186 27.5586 8.90557 27.3386C9.67554 27.2932 10.119 27.5041 10.6246 28.0762C12.8599 30.6037 17.0098 30.6452 19.2884 28.1742C19.8518 27.5644 20.327 27.0072 21.0898 27.3646C24.798 27.4587 27.6949 24.3422 27.3039 20.8209C27.2515 20.3467 27.3227 20.0268 27.7152 19.6896C30.7527 17.085 30.7623 12.9143 27.7397 10.3299ZM27.1253 15.7013C26.8715 17.1448 25.8141 17.8583 24.5669 18.2949C23.8923 18.5323 23.716 18.7334 24.0599 19.4373C24.6233 20.5894 24.8712 21.8143 24.1181 23.0131C23.2297 24.4247 21.6777 24.9047 20.0246 24.2988C19.1155 23.9649 18.4524 24.2473 18.0354 25.1459C17.3704 26.5763 16.2884 27.2633 14.7836 27.205C13.405 27.1504 12.5633 26.3675 11.9903 25.1855C11.3383 23.84 11.3176 23.8284 9.93894 24.3234C8.53576 24.828 7.31267 24.6548 6.26823 23.5254C5.71013 22.9214 5.3928 22.2417 5.43999 21.5682C5.42892 20.8378 5.57915 20.2999 5.78573 19.7726C6.22922 18.6529 6.23259 18.6432 5.09232 18.1444C3.97854 17.6571 3.11997 16.9547 2.87728 15.6864C2.52576 13.842 3.2418 12.6244 5.36632 11.7584C6.11606 11.4535 6.27352 11.2219 5.90371 10.4636C5.28542 9.20055 5.13181 7.88496 6.1045 6.67309C7.20529 5.30105 8.56369 5.02799 10.4797 5.91084C11.1919 6.23841 11.4847 6.14434 11.7423 5.39512C12.2272 3.98159 13.106 2.9352 14.7273 2.80349C16.3765 2.66986 17.4682 3.39061 18.2213 5.31407C18.5463 6.14579 18.8261 6.2307 19.5999 5.85633C20.8736 5.24267 22.1867 5.14474 23.3756 6.14627C24.6589 7.22451 24.9574 8.56857 24.1268 10.3772C23.7473 11.2036 23.8769 11.4743 24.707 11.8076C26.7473 12.6263 27.4518 13.8459 27.1248 15.7018L27.1253 15.7013Z" fill="rgb(0 158 145)"/>
                            </svg>
                        </i>
                    </h1>
                    <p class="font-light font-poppins text-sm leading-6 text-slate-500 text-nowrap">{{ __('@screen-wave') }}</p>
                    <p class="font-light font-poppins text-sm leading-3 text-slate-500 text-nowrap">A enthusiastic software developer.</p>
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
</nav> --}}