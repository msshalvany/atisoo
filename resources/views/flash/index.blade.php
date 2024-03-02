@extends('flash.layout.layout')
@section('keys')
    {{ $info->indexKey }}
@endsection
@section('title')
    خدمات آنلاین مدار بسته
@endsection
@section('css')
        .byForYou {
            display: none;
        }

        .abute {
            display: none;
        }

        .dropdao-btn-container {
            display: none
        }

        .searchViwe {
            display: none
        }

        .enamad {
            position: fixed;
            bottom: 18px;
            right: 8px;
            width: 100px;
        }

        .kasb {
            position: fixed;
            bottom: 180px;
            right: 8px;
            width: 100px;
        }

        .enamad img,
        .kasb img {
            width: 100px;
        }

        .home-btn {
            display: none
        }
    @if (!session()->exists('user'))
            .navBtns {
                display: block;
                width: 100%;
                justify-content: unset;
                background-color: unset;
                height: unset;
                position: unset;
                top: unset;
                right: unset;
                flex-direction: unset;
                z-index: unset;
            }
    @else
        .navBtns-open {
        display: none;
        }
        .navBtns {
        display: block;
        justify-content: unset;
        background-color: unset;
        height: unset;
        position: unset;
        top: unset;
        right: unset;
        flex-direction: unset;
        z-index: unset;
        }
    @endif
@endsection
@section('content')
    <div class="learn-ios">
        <div style="position: relative">
            <div class="learn-ios-cancel"><i class="fa fa-times"></i></div>
            <div class="learn-ios-text">
                <p>1 - وارد تنظیمات مرورگر خود شوید</p>
                <p>2 - گزینه Add to home screan را کلیک کنید</p>
                <img style="margin-top: 12px" width="80%" src="flash/img/learn-ios.jpg" alt="">
            </div>
        </div>
    </div>
    <div class="enamad">
        <a referrerpolicy="origin" target="_blank"
            href="https://trustseal.enamad.ir/?id=345037&amp;Code=pEkNCaiy1BJE34X2k4QV"><img referrerpolicy="origin"
                src="https://Trustseal.eNamad.ir/logo.aspx?id=345037&amp;Code=pEkNCaiy1BJE34X2k4QV" alt=""
                style="cursor:pointer" id="pEkNCaiy1BJE34X2k4QV"></a>
    </div>
    <div class="kasb">
        <img referrerpolicy='origin' id = 'rgvjfukzesgtfukzrgvjrgvj' style = 'cursor:pointer'
            onclick = 'window.open("https://logo.samandehi.ir/Verify.aspx?id=360633&p=xlaogvkaobpdgvkaxlaoxlao", "Popup","toolbar=no, scrollbars=no, location=no, statusbar=no, menubar=no, resizable=0, width=450, height=630, top=30")'
            alt = 'logo-samandehi' src = 'https://logo.samandehi.ir/logo.aspx?id=360633&p=qftiwlbqlymawlbqqftiqfti' />
    </div>
    <section class="section1">
        <img src="{{ $info->logo }}" class="logo-img" alt="موردی یافت نشد"><br>
        <h1>خدمات آنلاین دوربین مداربسته و dvr , nvr</h1><br>
        {{-- <p style="text-align: center">مشاوره خرید فایل فلش - <span style="color: red">تلگرام</span> یا <span
                style="color: red">ایتا</span> : <span >09217902890</span> </p>
        <p style="text-align: center"> در صورتی که فایلی را پیدا نکردید در <span style="color: red">تلگرام</span> یا <span
                style="color: red">ایتا</span> عکس از پشت و روی برد بفرستید تا فوری برای شما ارسال شود</p><br> --}}
        <div class="count-user-appps">

            <div class="apps-links">
                <p style="font-size: 18px">دانلود اپلیکیشن : خدمات آنلاین مداربسته . آتی سو</p>
                <div class="apps-links-item">
                    {{-- <div><img width="150px" src="flash/img/logo-app.png" alt=""></div> --}}
                    <a href="https://play.google.com/store/apps/details?id=co.median.android.lyrpxz"><img
                            width="160px"src="flash/img/google-play-download.png" alt=""></a>
                    <a href="https://cafebazaar.ir/app/io.gonative.android.jykprp">
                        <div><img width="150px" src="flash/img/bazar.png" alt=""></div>
                    </a>
                    <a href="flash/Atisoo.apk">
                        <div><img width="150px" src="flash/img/direct-download.png" alt=""></div>
                    </a>
                    <div class="learn-ios-btn"><img width="160px"src="flash/img/iOS.png" alt=""></div>
                    <a href="/ruls"><img width="160px"src="flash/img/ruls.png" alt=""></a>
                    <div class="count-user">
                        <div class="icon"><i class="fa fa-user"></i></div>
                        <div class="count">{{ $userCount }}</div>
                        <p>تعداد ثبت نام کنندگان</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="circle-menue">
            <a href="/resetDe">
                <p>ریست پسورد DVR , NVR</p><span style="color: red;text-shadow: none">(برای عموم مردم)</span>
            </a>
            <a href="/packegeL">
                <p>پکیج های آموزشی</p><span style="color: red;text-shadow: none">(برای عموم مردم)</span>
            </a>
            <a href="/resetCa">
                <p>ریست پسورد دوربین ip</p><span style="color: red;text-shadow: none;font-size: 12px">(برای نصاب ها و
                    تعمیرکاران)</span>
            </a>
            <a class="updateBtn" href="/searchUpdateViwe">
                <p>جستجوی فایل آپدیت</p><span style="color: red;text-shadow: none;font-size: 12px">(برای نصاب ها و
                    تعمیرکاران)</span>
            </a>
            <a class="updateBtn" href="/katalogL">
                <p style="font-size: 20px">دانلود کاتالوگ ها و دفترچه ها</p><span
                    style="color: red;text-shadow: none;font-size: 12px">(برای نصاب ها و
                    تعمیرکاران)</span>
            </a>
            <a href="/searchViwe">
                <p>جستجوی فایل فلش</p><span style="color: black;text-shadow: none;font-size: 12px">(برای
                    تعمیرکاران)</span>
            </a>
            <a href="/byForYou">
                <P>خرید فایل فلش از تعمیرکاران</P>
            </a>
            <a class="updateBtnBy" href="{{ route('byForYouUpdateFile') }}">
                <p>خرید فایل آپدیت از تعمیرکاران</p>
            </a>
            <a href="{{ route('cooperateL') }}" class="updateBtn">
                <p>همکاری با ما و کسب درآمد</p>
            </a>
            <a href="/abute">
                <p>درباره ما</p>
            </a>
        </div>
    </section>
    <div class="others">
        {{$info->ibaladam}}
    </div>
@endsection
@section('scripts')
    <script !src="">
        // $('.updateBtn').click(function(e) {
        //     e.preventDefault();
        //     alertSucsses('در حال توسعه به زودی فعال میشود')
        // });
        // $('.updateBtnBy').click(function(e) {
        //     e.preventDefault();
        //     alertSucsses('در حال توسعه به زودی فعال میشود')
        // });
    </script>
    @if (session()->get('remember') == 1)
        <script>
            document.cookie = "atisoo_phon = {{ session()->get('atisoo_phon') }}";
            document.cookie = "atisoo_password = {{ session()->get('atisoo_password') }}";
        </script>
    @endif
@endsection
