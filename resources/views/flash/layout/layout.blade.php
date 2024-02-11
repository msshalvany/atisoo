<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="keywords" content="@yield('keys')">
    <link rel="stylesheet" href="{{ asset('/flash/css/all.css') }}?t={{ time() }}" />
    <link rel="stylesheet" href="{{ asset('/flash/css/style.css') }}?t={{ time() }}" />
    <link rel="stylesheet" href="/flash/css/bootstrap.rtl.min.css" />
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
    <div class="loead-wait-cin">
        <span class="pers"></span>
        <span>در حال اپلود ....</span>
        <button class="btn btn-danger stop-ajsx">کنسل</button>
    </div>
    <div class="chat-icon" onclick="location.replace('\chate')"><i style="color: white"
            class="fa fa-commenting"></i><br>چت با اپراتور</div>
    <header>
        <nav>
            <div class="navBtns">
                @if (session()->exists('user'))
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
                    <div class="dropdao-btn dropdao-btn-reset">برای عموم مردم</div>
                    <div class="dropdao-btn-list">
                        <a href="/resetDe" class="resetPass" href="/resetDe">ریست پسورد DVR و NVR</a>
                        <a href="/packegeL" class="resetPass">پکیج های آموزشی</a>
                    </div>
                </div>
                <div class="dropdao-btn-container">
                    <div class="dropdao-btn dropdao-btn-search">برای نصاب ها و تعمیرکاران</div>
                    <div class="dropdao-btn-list">
                        <a href="/resetCa" class="search-reset-cam" href="/resetCa">ریست پسورد دوربین ip</a>
                        <a href="/searchUpdateViwe" class="search-upadte-btn">جستجوی فایل آپدیت</a>
                        <a href="/katalogL" class="search-upadte-btn">دانلود کاتالوگ ها و دفتر چه ها</a>
                    </div>
                </div>
                <div class="dropdao-btn-container">
                    <div class="dropdao-btn dropdao-btn-red"> تعمیرکاران</div>
                    <div class="dropdao-btn-list">
                        <a href="/searchViwe" class="byForYou" href="/searchViwe">جستجوی فایل فلش</a>
                        <a href="/byForYou" class="byForYou" href="byForYou">خرید فایل فلش از تعمیرکاران</a>
                        <a href="/byForYouUpdateFile" class="byForYou">خرید فایل آپدیت از تعمیرکاران</a>
                    </div>
                </div>
                <div class="dropdao-btn-container">
                    <div class="dropdao-btn dropdao-btn-about">همکاری با ما</div>
                    <div class="dropdao-btn-list">
                        <a href="/cooperateL" class="abute">همکاری با ما و کسب درآمد</a>
                        <a class="abute" href="/abute">درباره ما</a>
                    </div>
                </div>
            </div>
            @if (session()->exists('user'))
                <i class="fa fa-bars navBtns-open"></i>
            @endif
            <div class="left-items-nav">
                <a class="home-btn" href="/">
                    <div>
                        <i class="fa fa-home"></i>
                        <p>صفحه اصلی</p>
                    </div>
                </a>
                @if (session()->exists('user'))
                    <a href="/panel">
                        <div class="panel-icon">
                            <i class="fa fa-dashboard"></i>
                            <p>پنل کاربری</p>
                        </div>
                    </a>
                    <a href="/shopPage">
                        <div class="by">
                            <i class="fa fa-shopping-cart">
                                <div class="cart-count">{{ $count }}</div>
                            </i>
                        </div>
                    </a>
                @endif
            </div>
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
<script src="{{ asset('/flash/js/function.js') }}?t={{ time() }}"></script>
<script src="{{ asset('/flash/js/script.js') }}?t={{ time() }}"></script>
<script>
    $('.developer').click(function(e) {
        var id = $('.user').attr('id')
        if (id == 0) {
            location.href = "/register"
        } else {
            alertSucsses('در ابتدای سال 1403 این قسمت فعال و منتشر می شود')
        }
    });
</script>
<script>
    $('.others').click(function(e) {
        var id = $('.user').attr('id')
        if (id == 0) {
            location.href = "/register"
        } else {
            location.href = "/"
        }
    });
</script>
@yield('scripts')
<!-- @if (session('errorLogin'))
<script !src="">
    // alertEore('ابتدا باید ثبت نام کنید')
    location.href = '/register'
</script>
@endif -->
