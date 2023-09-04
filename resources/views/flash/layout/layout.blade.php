<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="keywords" content="@yield('keys')">
    <link rel="stylesheet" href="{{ asset('/flash/css/all.css') }}?t={{ time() }}" />
    <link rel="stylesheet" href="{{ asset('/flash/css/style.css') }}?t={{ time() }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="/flash/img/favicon.png">
    <meta name="description" content="خدمات انلاین دوربین های مداربسته">
    <title>@yield('title')</title>
    @yield('css')
</head>
<body>
    <ul class="circles">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>
    <div class="mask"></div>
    <div class="chat-icon" onclick="location.replace('\chate')"><i style="color: white" class="fa fa-commenting"></i><br>چت با مدیریت</div>
    <header>
        <nav>
        <div class="navBtns">
                @if (session()->exists('user'))
                    <a class="logout-btn" href="{{ route('logout') }}">خروج</a>
                    @php
                        $count = count(\App\Models\shop::where('userId', session()->get('user'))->get());
                    @endphp
                @else
                    <a class="loginBtn" href="/login">ورود</a>
                    <a class="registerBtn" href="/register">ثبت نام</a>
                    @php
                        $count = 0;
                    @endphp
                @endif
                <div class="dropdao-btn-container">
                    <div class="dropdao-btn dropdao-btn-reset">ریست پسورد</div>
                    <div class="dropdao-btn-list">
                        <a class="resetPass" href="/resetDe">ریست پسورد DVR و NVR</a>
                        <a class="resetPassCam" href="/resetCa">ریست پسورد دوربین ip</a>
                    </div>
                </div>
                <div class="dropdao-btn-container">
                    <div class="dropdao-btn dropdao-btn-search">جستجوی فایل</div>
                    <div class="dropdao-btn-list">
                        <a class="search-flash-btn" href="/searchViwe">جستجوی فایل فلش</a>
                        <a class="search-upadte-btn" href="#">جستجوی فایل آپدیت</a>
                    </div>
                </div>
                <a class="byForYou" href="/byForYou">خرید فایل از شما</a>
                <a class="abute" href="/abute">درباره ما</a>
                
            </div>
            <i class="fa fa-bars navBtns-open"></i>
            <a href="/panel">
                <div class="by">
                    <i class="fa fa-shopping-cart">
                        {{-- <div class="cart-count">{{ $count }}</div> --}}
                        <div class="cart-count">{{$count}}</div>
                    </i>
                </div>
            </a>
        </nav>
    </header>
    @if (session()->exists('user'))
        <div class="user" id="{{ session()->get('user') }}"></div>
    @else
        <div class="user" id="0"></div>
    @endif
    @yield('content')
</body>

</html>
<script src="/flash/js/jquery.js"></script>
<script src="/flash/js/function.js"></script>
<script src="{{ asset('/flash/js/script.js') }}?t={{ time() }}"></script>
@yield('scripts')
@if (session('errorLogin'))
    <script !src="">
        // alertEore('ابتدا باید ثبت نام کنید')
        location.href = '/register'
    </script>
@endif

