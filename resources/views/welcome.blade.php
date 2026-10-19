<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('assets/css/wellcome.css') }}">


</head>


<body style="background-image:url('assets/img/bg/home-bg.jpg'); background-size: cover"
    class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18]  flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
    <header
        class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden flex flex-row justify-between items-center">
        @if (Route::has('login'))
            <nav class="flex items-center justify-end gap-4">
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal">
                        Log in
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                            Register
                        </a>
                    @endif
                @endauth
            </nav>
        @endif
        <div class="site-logo">
            <img style="max-width: 110%;" src="{{ asset('assets/img/logo.png') }}" alt="" />
        </div>
    </header>
    <div style="margin-top: 100px">
        <main id="coun">
            <div class="wellcome">
                <div class="image flex justify-between" >
                    <h1 id="hi">
                        Hi ,
                    </h1>
                    <img style="@" class="w-9 h-7" src="{{ asset("assets/img/quote.png") }}" srcset="">
                </div>
                <span style="font-size: 2rem;">We Can help You Finding </span>
                <br>
                <span style="font-size: 2rem;">the <span style="color:#ef4444 ">Best</span> Way to Imporove</span>
                <div id="to-home">

                    <a style="font-size: 30px" href="{{ route('home') }}">Go To The Website</a>
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"
                        fill="none">
                        <path
                            d="M 9.6666 7.0104 V 4.3333 C 9.6666 3.5973 10.264 3 11 3 H 19.6666 C 20.4026 3 20.9999 3.5973 20.9999 4.3333 V 19.6666 C 20.9999 20.4026 20.4026 20.9999 19.6666 20.9999 H 11 C 10.264 20.9999 9.6666 20.4026 9.6666 19.6666 V 16.9896"
                            stroke="#8b5cf6" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                            fill="none"></path>
                        <path d="M 5.3333 15.6666 L 9 12 L 5.3333 8.3333" stroke="#8b5cf6" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round" fill="none"></path>
                        <path d="M 9 12 H 1" stroke="#8b5cf6" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" fill="none"></path>
                        <path
                            d="M 20.7239 3.5307 L 16.296 6.276 C 15.904 6.5187 15.6653 6.948 15.6653 7.4093 V 16.592 C 15.6653 17.0533 15.904 17.4813 16.296 17.7253 L 20.7253 20.4719"
                            stroke="#8b5cf6" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                            fill="none"></path>
                    </svg>
                </div>
            </div>

            <div class="wellcome-img">
                <img src="{{ asset('assets/img/wellcome.png') }}" alt="">
            </div>

        </main>
    </div>

    @if (Route::has('login'))
        <div class="h-14.5 hidden lg:block"></div>
    @endif
</body>

</html>
