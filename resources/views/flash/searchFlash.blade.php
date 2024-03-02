@extends('flash.layout.layout')
@section('keys')
    {{ $info->searchFlashKey }}
@endsection
@section('title')
    جستجوی فایل فلش
@endsection
@section('css')
        .section1 {
            margin-top: 120px
        }
@endsection
@section('content')
    <a href="/">
        <div class="home"><i class="fa fa-home"></i><br>صفحه اصلی </div>
    </a>
    <section class="section1">
        <img src="{{ $info->logo }}" class="logo-img" alt="موردی یافت نشد"><br>
        <h1 style="text-align: center;display: block;width: 100%;"> موتور جستجوی فایل فلش</h1><br>
        <div class="count-file">
            {{-- <div class="count-user">
                <div class="icon"><i class="fa fa-user"></i></div>
                <div class="count">{{ $userCount }}</div>
                <p>تعداد کاربران </p>
            </div> --}}
            <div class="file-count">
                <div class="icon"><i class="fa fa-file"></i></div>
                <div class="count">{{ $fileCount }}</div>
                <p>تعداد فایل های آپلود شده</p>
            </div>
        </div>
        <p style="text-align: center;padding: 0 12px"> در صورتی که فایلی را پیدا نکردید در <span style="color: red"> چت با
                مدیریت </span> پیام دهید </p><br>
        <form action="{{ route('search') }}" class="search" method="get">
            <input type="text" name="text"
                placeholder="قسمتی از نام روی برد یا برچسب پشت دستگاه یا دوربین را تایپ کنید..." />
            <button><i style="color: rgb(88, 88, 88)" class="fa fa-search"></i></button>
        </form>
    </section>
    <section class="section2">

        @if ($device != 'null')
            @if ($device->hasPages())
                <ul class="pagination" style="display: flex">
                    {{-- Previous Page Link --}}
                    @if ($device->onFirstPage())
                        <li class="disabled"><span>«</span></li>
                    @else
                        <li><a href="{{ $device->appends(request()->input())->previousPageUrl() }}" rel="prev">«</a>
                        </li>
                    @endif

                    @if ($device->currentPage() > 3)
                        <li class="hidden-xs"><a href="{{ $device->appends(request()->input())->url(1) }}">1</a> </li>
                    @endif
                    @if ($device->currentPage() > 4)
                        <li><span>...</span></li>
                    @endif
                    @foreach (range(1, $device->lastPage()) as $i)
                        @if ($i >= $device->currentPage() - 2 && $i <= $device->currentPage() + 2)
                            @if ($i == $device->currentPage())
                                <li class="active"><span>{{ $i }}</span></li>
                            @else
                                <li><a href="{{ $device->appends(request()->input())->url($i) }}">{{ $i }}</a>
                                </li>
                            @endif
                        @endif
                    @endforeach
                    @if ($device->currentPage() < $device->lastPage() - 3)
                        <li><span>...</span></li>
                    @endif
                    @if ($device->currentPage() < $device->lastPage() - 2)
                        <li class="hidden-xs"><a
                                href="{{ $device->url($device->lastPage()) }}">{{ $device->lastPage() }}</a>
                        </li>
                    @endif

                    {{-- Next Page Link --}}
                    @if ($device->hasMorePages())
                        <li><a href="{{ $device->appends(request()->input())->nextPageUrl() }}" rel="next">»</a>
                        </li>
                    @else
                        <li class="disabled"><span>»</span></li>
                    @endif
                </ul>
            @endif
        @endif
        <ul>
            @if ($device != 'null')
                @foreach ($device as $item)
                    <li class="flash-cont">
                        <div class="flash-dis-cont">
                            <div>آیدی سایت : <span>{{ $item->id2 }}</span></div>
                            <div>کد روی برد : <span>{{ $item->name1 }}</span></div>
                            <div>کد پشت برد : <span>{{ $item->name2 }}</span></div>
                            <div>برچسب روی برد : <span>{{ $item->name3 }}</span></div>
                            <div>پردازنده : <span>{{ $item->ic }}</span></div>
                            <div>لیبل: <span>{{ $item->lable }}</span></div>
                            <div>تعداد کانال : <span>{{ $item->chanel }}</span></div>
                            @if ($item->ipromName != 'null')
                                <div> نام ای سی ایپروم: <span>{{ $item->ipromName }}</span></div>
                            @endif
                            <br>
                            <a class="show-device" href="showDevice/{{ $item->id }}">مشاهده جزئیات و خرید</a>
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
                        </div>
                    </li>
                @endforeach
            @endif
        </ul>
        @if ($device != 'null')
            @if ($device->hasPages())
                <ul class="pagination" style="display: flex">
                    {{-- Previous Page Link --}}
                    @if ($device->onFirstPage())
                        <li class="disabled"><span>«</span></li>
                    @else
                        <li><a href="{{ $device->appends(request()->input())->previousPageUrl() }}" rel="prev">«</a>
                        </li>
                    @endif

                    @if ($device->currentPage() > 3)
                        <li class="hidden-xs"><a href="{{ $device->appends(request()->input())->url(1) }}">1</a> </li>
                    @endif
                    @if ($device->currentPage() > 4)
                        <li><span>...</span></li>
                    @endif
                    @foreach (range(1, $device->lastPage()) as $i)
                        @if ($i >= $device->currentPage() - 2 && $i <= $device->currentPage() + 2)
                            @if ($i == $device->currentPage())
                                <li class="active"><span>{{ $i }}</span></li>
                            @else
                                <li><a href="{{ $device->appends(request()->input())->url($i) }}">{{ $i }}</a>
                                </li>
                            @endif
                        @endif
                    @endforeach
                    @if ($device->currentPage() < $device->lastPage() - 3)
                        <li><span>...</span></li>
                    @endif
                    @if ($device->currentPage() < $device->lastPage() - 2)
                        <li class="hidden-xs"><a
                                href="{{ $device->url($device->lastPage()) }}">{{ $device->lastPage() }}</a>
                        </li>
                    @endif

                    {{-- Next Page Link --}}
                    @if ($device->hasMorePages())
                        <li><a href="{{ $device->appends(request()->input())->nextPageUrl() }}" rel="next">»</a>
                        </li>
                    @else
                        <li class="disabled"><span>»</span></li>
                    @endif
            @endif
            </ul>
        @endif
    </section>
@endsection
@section('scripts')
    <script>
        $('.dropdao-btn').eq(2).css('box-shadow', '0px 8px 5px rgb(177 0 0)');
    </script>
@endsection
