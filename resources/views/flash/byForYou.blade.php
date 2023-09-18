@extends('flash.layout.layout')
@section('keys'){{$info->byFlahYouKey}}@endsection
@section('title')
    خرید از شما
@endsection
@section('content')
    <a href="/">
        <div class="home"><i class="fa fa-home"></i><br>صفحه اصلی </div>
    </a>
    <section style="margin-top: 120px" class="section1">
        <img src="{{ $info->logo }}" class="logo-img" alt="موردی یافت نشد"><br>
        <h1>خرید فایل فلش و آپدیت از شما</h1><br>
    </section>
    <section class="by-for-you-contaoner">
        <ul>
            @if ($device != 'null')
                @foreach ($device as $item)
                    <li class="flash-cont-by-for-you">
                        <div class="flash-dis-cont-by-for-you">
                            <div> آیدی سایت : <span>{{ $item->id2 }}</span></div>
                            <div>کد روی برد : <span>{{ $item->name1 }}</span></div>
                            <div>کد پشت برد : <span>{{ $item->name2 }}</span></div>
                            <div>برچسب روی برد : <span>{{ $item->name3 }}</span></div>
                            <div>پردازنده : <span>{{ $item->ic }}</span></div>
                            <div>لیبل: <span>{{ $item->lable }}</span></div>
                            <div>تعداد کانال : <span>{{ $item->chanel }}</span></div>
                            <div> نام ای سی ایپروم: <span>{{ $item->ipromName }}</span></div>
                            <div><br>
                                توضیحات :
                                <br>
                                <audio src="{{$item->mp3}}" controls></audio>
                            </div>
                            <br>
                            <div><br>
                                توضیحات  متنی:
                                <br>
                                <p style="white-space: pre-wrap">
                                    {{ $item->description }}
                                </p>
                            </div><br>
                        </div>
                        <div class="flash-img-cont">
                            <div class="slider">
                                @php
                                    $imags = json_decode($item->imags);
                                @endphp
                                @foreach ($imags as $img)
                                <div class="img-magnifier-container">
                                        <img class="myimage" src="{{ $img }}" alt="موردی یافت نشد" />
                                </div>
                                @endforeach
                                <div class="next fa fa-right-long"></div>
                                <div class="prev fa fa-left-long"></div>
                            </div>
                            <div>
                               قیمت پیشنهادی :
                                <span style="color: red; font-weight: bold">{{ $item->price}} هزار تومان </span>
                            </div>
                        </div>
                    </li>
                @endforeach
            @endif
            @if (count($device) == 0)
                موردی در حال حال حاضر وجود ندارد
            @endif
        </ul>
    </section>
@endsection
@section('scripts')
    <script>
        $('.byForYou').css('box-shadow', '0px 8px 5px rgb(122 122 122)');
    </script>
@endsection


