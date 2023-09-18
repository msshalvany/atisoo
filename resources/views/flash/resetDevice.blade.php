@extends('flash.layout.layout')
@section('keys')
    {{ $info->resetDeviceKey }}
@endsection
@section('title')
    ریست رمز دستگاه
@endsection
@section('content')
    <a href="/">
        <div class="home"><i class="fa fa-home"></i><br>صفحه اصلی </div>
    </a>
    <section style="margin-top: 120px" class="section1">
        <img src="{{ $info->logo }}" class="logo-img" alt="موردی یافت نشد"><br>
        <h1>ریست رمز DVR ,NVR</h1><br>
        <form action="" class="search serach-device" method="get">
            <input type="text" name="text"
                placeholder="نام روی برد یا برچسب پشت دستگاه یا دوربین را تایپ کنید ......." />
            <button><i style="color: rgb(88, 88, 88)" class="fa fa-search"></i></button>
        </form>
    </section>
    <section class="by-for-you-contaoner resetDevice-container">
        <ul>
            @if ($device != 'null')
                @foreach ($device as $item)
                    <li class="flash-cont-by-for-you">
                        <div class="flash-dis-cont-by-for-you">
                            <div> آیدی سایت : <span>{{ $item->id2 }}</span></div>
                            <div><br>
                                توضیحات :
                                @php
                                    $audio = json_decode($item->mp3);
                                @endphp
                                <br>
                                @if (count($audio)!=0)
                                <audio src="{{ $audio[0] }}" controls></audio>
                                @endif
                            </div>
                            <div><br>
                                توضیحات متنی:
                                <br>
                                <p style="white-space: pre-wrap">
                                    {{ $item->description }}
                                </p>
                            </div><br>
                            <div><br>
                                نرم افزار ها :
                                <br>
                                @php
                                    $apps = json_decode($item->apps);
                                @endphp
                                @if (count($apps) != 0)
                                    @foreach ($apps as $key => $value)
                                        <a class="apps-link" href="{{ $value }}">نرم افزار
                                            {{ $key + 1 }}</a><br>
                                    @endforeach
                                @endif
                            </div>
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
                            <div><br>
                                فیلم آموزشی :
                                <br>
                                @php
                                    $vedio = json_decode($item->vedio);
                                @endphp
                                @if (count($vedio) != 0)
                                    <video width="300px" src="{{ $vedio[0] }}" controls></video>
                                @endif
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
        $('.dropdao-btn').eq(0).css('box-shadow', '0px 8px 5px rgb(33 135 0)');
    </script>
@endsection
