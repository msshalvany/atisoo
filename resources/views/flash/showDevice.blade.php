@extends('flash.layout.layout')
@section('title')
{{ $device->name1 }}
@endsection
@php
    $text = [];
    $tKes= explode(',',$info->deviceKey);
    foreach ($tKes as $value) {
        $new = str_replace('*',$device->lable,$value);
        array_push($text,$new);
        $new = str_replace('*',$device->ipromName,$value);
        array_push($text,$new);
        $new = str_replace('*',$device->name1,$value);
        array_push($text,$new);
        $new = str_replace('*',$device->name2,$value);
        array_push($text,$new);
        $new = str_replace('*',$device->name3,$value);
        array_push($text,$new);
        $new = str_replace('*',$device->ic,$value);
        array_push($text,$new);
    }
    $text = implode(',',$text);
@endphp
@section('keys'){{$text}}@endsection
@section('css')
    <style>
        .home {
            position: fixed;
            top: 5px;
            left: 80px;
            text-align: center;
            font-weight: bold;
            color: white;
            background-color: #ff4141;
            padding: 5px 15px;
            border-radius: 12px;
            z-index: 12;
            font-size: 12px;
        }

        .fa-shopping-cart {
            font-size: 32px;
            position: relative;
            cursor: pointer;
        }
        .flash-cont,
        .flash-cont-by-for-you {
            margin-top: 200px;
        }
    </style>
@endsection
@section('content')
    <div class="flash-cont flash-cont-show">
        <div class="flash-by-cont flash-by-cont-show">
            <ul id="{{ $device->id }}">
                <li>
                    فایل فلش : {{ $device->flashPrice }} هزار تومان <input type="checkbox" name="" class="flash" />
                </li>
                <br />
                @if ($device->iprom != 'false')
                    <li>
                        فایل ایپروم : {{ $device->ipromPrice }} هزار تومان <input type="checkbox" name=""
                            class="iprom" />
                    </li>
                @endif
            </ul>

            <button class="addShop">افزودن به سبد خرید</button>
        </div>
       <div class="flash-dis-cont">
            <div>آیدی سایت : <span>{{ $device->id2 }}</span></div>
            <div>کد روی برد : <span>{{ $device->name1 }}</span></div>
            <div>کد پشت برد : <span>{{ $device->name2 }}</span></div>
            <div>برچسب روی برد : <span>{{ $device->name3 }}</span></div>
            <div>پردازنده : <span>{{ $device->ic }}</span></div>
            <div>لیبل : <span>{{ $device->lable }}</span></div>
            <div>تعداد کانال : <span>{{ $device->chanel }}</span></div>
            @if ($device->ipromName != 'null')
                <div> نام ای سی ایپروم: <span>{{ $device->ipromName }}</span></div>
            @endif
            <br>
            <div>رمز: <span>{{ $device->password }}</span></div>
            <div>سایز فایل: <span>{{ $device->flashSize }}</span></div>
            <br>
            <div>
                توضیحات :
                <p>
                    {{ $device->description }}
                </p>
            </div>
        </div>
        <div class="flash-img-cont">
            <div class="slider">
                @php
                    $imags = json_decode($device->imags);
                @endphp
                @foreach ($imags as $img)
                <div class="img-magnifier-container">
                    <img class="myimage" src="/{{ $img }}" alt="موردی یافت نشد" />
                </div>
                @endforeach
                <div class="next fa fa-right-long"></div>
                <div class="prev fa fa-left-long"></div>
            </div>
        </div>
    </div>
    <P style="text-align: center ;font-size: 34px;font-weight: bold">نظرات همکاران</P>
    <ul class="comments">
        @foreach ($comment as $item)
            <li>
                کاربر شماره {{ $item->user_id }} <br>
                {{ $item->text }}
            </li>
        @endforeach
    </ul>
@endsection
