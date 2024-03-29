@extends('flash.layout.layout')
@section('keys')
    {{ $info->resetCamKey }}
@endsection
@section('title')
پکیج های آموزشی 
@endsection
@section('content')
    <a href="/">
        <div class="home"><i class="fa fa-home"></i><br>صفحه اصلی </div>
    </a>
    <section style="margin-top: 120px" class="section1">
        <img src="{{ $info->logo }}" class="logo-img" alt="موردی یافت نشد"><br>
        <h1>پکیج های اموزشی</h1><br>
        {{-- <form action="" class="search serach-cam" method="get">
            <input type="text" name="text" placeholder="دنبال چی می گردی ؟ همین جا سرچ کن......." />
            <button><i style="color: rgb(88, 88, 88)" class="fa fa-search"></i></button>
        </form> --}}
    </section>
    <section class="by-for-you-contaoner resetCam-container">
        <ul>
            @if ($packege != 'null')
                @foreach ($packege as $item)
                    <li class="flash-cont-by-for-you">
                        <div class="shop-item-con-dis-by-for-you">
                            <div> آیدی سایت : <span>{{ $item->id2 }}</span></div>
                            <div><br>
                                @php
                                    $audio = json_decode($item->mp3);
                                @endphp
                                <br>
                                @if (count($audio) != 0)
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
                            <div>
                                <p>قیمت : <span style="color: red"> {{ $item->price }} هزارتومان</span></p>
                            </div>
                            <form action="{{ route('addShopPackege', ['id' => $item->id]) }}" method="POST">
                                @csrf
                                <button class="add-packege-btn">افزودن به سبد خرید</button>
                            </form>
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
            @if (count($packege) == 0)
                موردی در حال حال حاضر وجود ندارد
            @endif
        </ul>
    </section>
@endsection
@section('scripts')
    @if (session('addPackS') == 1)
        <script !src="">
            alertSucsses("عملیات موفق بود");
        </script>
    @endif
    <script>
        $('.dropdao-btn').eq(0).css('box-shadow', '0px 8px 5px rgb(33 135 0)');
    </script>
@endsection
