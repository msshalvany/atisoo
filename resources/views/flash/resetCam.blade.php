@extends('flash.layout.layout')
@section('keys'){{$info->resetCamKey}}@endsection
@section('title')
    ریست رمز دوربین
@endsection
@section('content')
    <a href="/">
        <div class="home"><i class="fa fa-home"></i><br>صفحه اصلی </div>
    </a>
    <section style="margin-top: 120px" class="section1">
        <img src="{{ $info->logo }}" class="logo-img" alt="موردی یافت نشد"><br>
        <h1>ریست رمز دوربین های ip</h1><br>
        <form action="" class="search serach-cam" method="get">
            <input type="text" name="text"
                placeholder="دنبال چی می گردی ؟ همین جا سرچ کن......." />
            <button><i style="color: rgb(88, 88, 88)" class="fa fa-search"></i></button>
        </form>
    </section>
    <section class="by-for-you-contaoner resetCam-container">
        <ul>
            @if ($device != 'null')
                @foreach ($device as $item)
                    <li class="flash-cont-by-for-you">
                        <div class="flash-dis-cont-by-for-you">
                            <div> آیدی سایت : <span>{{ $item->id2 }}</span></div>
                            <div><br>
                                @php
                                    $audio = json_decode($item->mp3);
                                @endphp
                                <br>
                                @if (count($audio)!=0)
                                توضیحات :
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
                                <br>
                                @php
                                    $apps = json_decode($item->apps);
                                @endphp
                                @if (count($apps) != 0)
                                نرم افزار ها :

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
                                <br>
                                @php
                                    $vedio = json_decode($item->vedio);
                                @endphp
                                @if (count($vedio) != 0)
                                فیلم آموزشی :

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
        $('.dropdao-btn').eq(1).css('box-shadow', '0px 8px 5px rgb(79 0 124)');
    </script>
@endsection
  