@extends('flash.layout.layout')
@section('keys')
    {{ $info->indexKey }}
@endsection
@section('title')
    خدمات آنلاین مدار بسته
@endsection
@section('css')
    <style>
        .byForYou {
            display: none
        }

        .abute {
            display: none
        }

        .dropdao-btn-container {
            display: none
        }

        .searchViwe {
            display: none
        }
    </style>
@endsection
@section('content')
    <section class="section1">
        <img src="{{ $info->logo }}" class="logo-img" alt="موردی یافت نشد"><br>
        <h1>خدمات آنلاین دوربین مداربسته و dvr , nvr</h1><br>
        {{-- <p style="text-align: center">مشاوره خرید فایل فلش - <span style="color: red">تلگرام</span> یا <span
                style="color: red">ایتا</span> : <span >09217902890</span> </p>
        <p style="text-align: center"> در صورتی که فایلی را پیدا نکردید در <span style="color: red">تلگرام</span> یا <span
                style="color: red">ایتا</span> عکس از پشت و روی برد بفرستید تا فوری برای شما ارسال شود</p><br> --}}
        <div class="count-user-file">
            <div class="count-user">
                <div class="icon"><i class="fa fa-user"></i></div>
                <div class="count">{{ $userCount }}</div>
                <p>تعداد ثبت نام کنندگان</p>
            </div>
            {{-- <div class="file-count">
                <div class="icon"><i class="fa fa-file"></i></div>
                <div class="count">{{ $fileCount }}</div>
                <p>تعداد فایل ها</p>
            </div> --}}
        </div>
        <div class="circle-menue">
            <a href="/resetDe"><p>ریست پسورد DVR , NVR</p><span style="color: red;text-shadow: none">(برای عموم مردم)</span></a>
            <a href="/resetCa"><p>ریست پسورد دوربین ip</p><span style="color: red;text-shadow: none">(برای عموم مردم)</span></a>
            <a class="updateBtn" href=""><p>جستجوی فایل آپدیت</p><span style="color: black;text-shadow: none;font-size: 12px">(برای نصاب ها و  تعمیرکاران)</span></a>
            <a href="/searchViwe"><p>جستجوی فایل فلش</p><span style="color: black;text-shadow: none;font-size: 12px">(برای نصاب ها و تعمیرکاران)</span></a>
            <a href="/byForYou"><P>خرید فایل فلش  از تعمیرکاران</P></a>
            <a class="updateBtnBy" href=""><p>خرید  فایل آپدیت از تعمیرکاران</p></a>
            <a href="/abute"><p>درباره ما</p></a>
        </div>
    </section>

    {{-- <session class="session-disc-audio">
        <ul>
            <li>
                <audio src="/flash/audio/3.ogg" controls></audio>
                <p>
                    راهنمای خرید
                    <br>
                    تلگرام و ایتا : 09217902890
                </p>
            </li>
            <li>
                <audio src="/flash/audio/2.ogg" controls></audio>
                <p>تفاوت فایل فلش و فایل آپدیت</p>
            </li>
            <li>
                <audio src="/flash/audio/1.ogg" controls></audio>
                <p>
                    پذیرش تعمیرات از سراسر کشور <br>
                    تلگرام و ایتا : 09217902890
                </p>
            </li>
        </ul>
    </session> --}}
    {{-- <a href="/other">
        <div class="others">
            لیست نصاب ها و فروشندگان دوربین های مدار بسته
            <span style="color: red">تبلیغ رایگان</span>
        </div>
    </a> --}}
@endsection
@section('scripts')
    <script !src="">
        $('.updateBtn').click(function(e) {
            e.preventDefault();
            alertSucsses('در حال توسعه به زودی فعال میشود')
        });
        $('.updateBtnBy').click(function(e) {
            e.preventDefault();
            alertSucsses('در حال توسعه به زودی فعال میشود')
        });
    </script>
@endsection
