@extends('flash.layout.layout')
@section('title')
    سبد خرید
@endsection
@section('css')
@endsection
@section('content')
    @php
        $user = \App\Models\user::find(session()->get('user'));
    @endphp
    <div class="mask"></div>
    <div class="tabs">
        <div id="tabs-nav">
            <ul style="display: flex">
                <li class="active"><a href="#tab1" id="by-tab">سبد خرید</a></li>
                <li><a href="#tab2" id="down-tab">دانلود فایل</a></li>
            </ul>
            <div>
                <span>شماره کاربری : {{ $user->id }}</span>
                <span>مقدار تخفیف شما : <span class="panelDiscount">{{ $user->discount }} </span>هزار تومان </span>
            </div>
            {{--            <li><a href="#tab3">فروش فایل فلش</a></li> --}}
        </div>
        <!-- END tabs-nav -->
        {{-- ===================================== shop ===================================== --}}
        {{-- ===================================== shop ===================================== --}}
        {{-- ===================================== shop ===================================== --}}
        {{-- ===================================== shop ===================================== --}}
        {{-- ===================================== shop ===================================== --}}
        {{-- ===================================== shop ===================================== --}}
        {{-- ===================================== shop ===================================== --}}
        {{-- ===================================== shop ===================================== --}}
        {{-- ===================================== shop ===================================== --}}
        {{-- ===================================== shop ===================================== --}}
        {{-- ===================================== shop ===================================== --}}
        {{-- ===================================== shop ===================================== --}}
        {{-- ===================================== shop ===================================== --}}
        {{-- ===================================== shop ===================================== --}}
        {{-- ===================================== shop ===================================== --}}

        <div id="tabs-content">
            <div id="tab1" class="tab-content tab-content1">
                <section class="section2">
                    @php
                        $count = 0;
                    @endphp
                    @if (count($deviceShop) == 0)
                        <b>موردی یافت نشد</b>
                    @else
                        <ul>
                            @foreach ($deviceShop as $shop)
                                @if ($shop->deviceId != 0)
                                    <li class="flash-cont">
                                        <div class="flash-by-cont">
                                            <ul>
                                                @if ($shop->flash != 'false')
                                                    <li>
                                                        @php
                                                            $price = \App\Models\device::find($shop->deviceId)->flashPrice;
                                                            $count += $price;
                                                        @endphp
                                                        فایل فلش : {{ $price }} هزار تومان
                                                    </li>
                                                @endif
                                                <br />
                                                @if ($shop->iprom != 'false')
                                                    @php
                                                        $price = \App\Models\device::find($shop->deviceId)->ipromPrice;
                                                        $count += $price;
                                                    @endphp
                                                    <li>
                                                        فایل اپروم : {{ $price }} هزار تومان
                                                    </li>
                                                @endif
                                            </ul>
                                            <br>
                                            <form action="{{ route('deleteFlash', ['id' => $shop->id]) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button>حذف</button>
                                            </form>
                                        </div>
                                        <div class="flash-dis-cont">
                                            @php
                                                $device = \App\Models\device::where('id', $shop->deviceId)->first();
                                            @endphp
                                            <div>آیدی سایت : <span>{{ $device->id2 }}</span></div>
                                            <div>کد روی برد : <span>{{ $device->name1 }}</span></div>
                                            <div>کد پشت برد : <span>{{ $device->name2 }}</span></div>
                                            <div>برچسب روی برد : <span>{{ $device->name3 }}</span></div>
                                            <div>پردازنده : <span>{{ $device->ic }}</span></div>
                                            <div>لیبل: <span>{{ $device->lable }}</span></div>
                                            <div>حجم فایل فلش: <span>{{ $device->flashSize }}</span></div>
                                            <div>رمز: <span>{{ $device->password }}</span></div>
                                            <div>تعداد کانال : <span>{{ $device->chanel }}</span></div>
                                        </div>
                                        <div class="flash-img-cont">
                                            <div class="slider">
                                                @php
                                                    $imags = json_decode($device->imags);
                                                @endphp
                                                @foreach ($imags as $img)
                                                    <div class="img-magnifier-container">
                                                        <img class="myimage" src="{{ $img }}"
                                                            alt="موردی یافت نشد" />
                                                    </div>
                                                @endforeach
                                                <div class="next fa fa-right-long"></div>
                                                <div class="prev fa fa-left-long"></div>
                                            </div>
                                        </div>
                                    </li>
                                @elseif ($shop->package_id != 0)
                                    <li class="flash-cont">
                                        @php
                                            $package = \App\Models\packege::where('id', $shop->package_id)->first();
                                            $count += $package->price;
                                        @endphp

                                        <div class="flash-by-cont">
                                            <div>
                                                قیمت : {{ $package->price }} هزار تومان
                                            </div>
                                            <form action="{{ route('deleteShopPack', ['id' => $shop->id]) }}"
                                                method="post">
                                                @csrf
                                                @method('delete')
                                                <button>حذف</button>
                                            </form>

                                        </div>
                                        <div class="flash-dis-cont">
                                            <div>نام پکیج : <span>{{ $package->name }}</span></div>
                                        </div>

                                        <div class="flash-img-cont">
                                            <div class="slider">
                                                @php
                                                    $imags = json_decode($package->imags);
                                                @endphp
                                                @foreach ($imags as $img)
                                                    <div class="img-magnifier-container">
                                                        <img class="myimage" src="{{ $img }}"
                                                            alt="موردی یافت نشد" />
                                                    </div>
                                                @endforeach
                                                <div class="next fa fa-right-long"></div>
                                                <div class="prev fa fa-left-long"></div>
                                            </div>
                                        </div>
                                    </li>
                                @elseif ($shop->updateFile_id != 0)
                                    <li class="flash-cont">
                                        <div class="flash-by-cont">
                                            <ul>
                                                <li>
                                                    @php
                                                        $price = \App\Models\UpdateFile::find($shop->updateFile_id)->price;
                                                        $count += $price;
                                                    @endphp
                                                    قیمت : {{ $price }} هزار تومان
                                                </li>
                                            </ul>
                                            <br>
                                            <form action="{{ route('deleteFlash', ['id' => $shop->id]) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button>حذف</button>
                                            </form>
                                        </div>
                                        <div class="flash-dis-cont">
                                            @php
                                                $device = \App\Models\UpdateFile::where('id', $shop->updateFile_id)->first();
                                            @endphp
                                            <div>آیدی سایت : <span>{{ $device->id2 }}</span></div>
                                            <div>کد روی برد : <span>{{ $device->name1 }}</span></div>
                                            <div>کد پشت برد : <span>{{ $device->name2 }}</span></div>
                                            <div>برچسب روی برد : <span>{{ $device->name3 }}</span></div>
                                            <div>پردازنده : <span>{{ $device->ic }}</span></div>
                                            <div>لیبل: <span>{{ $device->lable }}</span></div>
                                            <div>تعداد کانال : <span>{{ $device->chanel }}</span></div>
                                        </div>
                                        <div class="flash-img-cont">
                                            <div class="slider">
                                                @php
                                                    $imags = json_decode($device->imags);
                                                @endphp
                                                @foreach ($imags as $img)
                                                    <div class="img-magnifier-container">
                                                        <img class="myimage" src="{{ $img }}"
                                                            alt="موردی یافت نشد" />
                                                    </div>
                                                @endforeach
                                                <div class="next fa fa-right-long"></div>
                                                <div class="prev fa fa-left-long"></div>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                        <br>
                        <form action="{{ route('byFlash') }}" method="post">
                            @csrf
                            <input type="hidden" name="total" value="{{ $count }}">
                            <br>
                            <p>فایل های موجود در این سایت کاملا سالم هستند و در صورت نا کار آمد بودن فایل برای شما ، این وب
                                سایت
                                هیچ مسئولیتی را نمی پذیرد</p><br>
                            <b>موافقم </b><input class="check-after-by" type="checkbox"><br>
                            <br>
                            <b> استفاده از تخفیف </b> <input class="discountCheckbox" name="discount"
                                type="checkbox"><br><br>
                            <div>
                                جمع خرید :
                                <span style="color: red; font-weight: bold"><span
                                        class="totalPrice">{{ $count }}</span> هزار تومان </span>
                            </div>
                            <input type="submit" disabled class="by-end" value="خرید نهایی">
                        </form>
                    @endif
                </section>
            </div>
            {{-- ===================================== shop ===================================== --}}
            {{-- ===================================== shop ===================================== --}}
            {{-- ===================================== shop ===================================== --}}
            {{-- ===================================== shop ===================================== --}}
            {{-- ===================================== shop ===================================== --}}
            {{-- ===================================== shop ===================================== --}}
            {{-- ===================================== shop ===================================== --}}
            {{-- ===================================== shop ===================================== --}}
            {{-- ===================================== shop ===================================== --}}
            {{-- ===================================== shop ===================================== --}}
            {{-- ===================================== shop ===================================== --}}
            {{-- ===================================== shop ===================================== --}}
            {{-- ===================================== shop ===================================== --}}
            {{-- ===================================== shop ===================================== --}}
            {{-- ===================================== shop ===================================== --}}





            {{-- ===================================== byed ===================================== --}}
            {{-- ===================================== byed ===================================== --}}
            {{-- ===================================== byed ===================================== --}}
            {{-- ===================================== byed ===================================== --}}
            {{-- ===================================== byed ===================================== --}}
            {{-- ===================================== byed ===================================== --}}
            {{-- ===================================== byed ===================================== --}}
            {{-- ===================================== byed ===================================== --}}


            <div style="display: none" id="tab2" class="tab-content tab-content2">
                <section class="section2">
                    @if (count($deviceByed) == 0)
                        <b>موردی یافت نشد</b>
                    @endif
                    <ul>
                        @foreach ($deviceByed as $Byed)
                            @if ($Byed->deviceId != 0)
                                @php
                                    $endTime = \Carbon\Carbon::parse($Byed->created_at)->add(5, 'day');
                                    $timeForEnd = now()
                                        ->diff($endTime)
                                        ->format('%H:%I:%S-%Y-%M-%D');
                                    $h = now()
                                        ->diff($endTime)
                                        ->format('%H');
                                    $i = now()
                                        ->diff($endTime)
                                        ->format('%I');
                                    $s = now()
                                        ->diff($endTime)
                                        ->format('%S');
                                    $y = now()
                                        ->diff($endTime)
                                        ->format('%Y');
                                    $m = now()
                                        ->diff($endTime)
                                        ->format('%M');
                                    $d = now()
                                        ->diff($endTime)
                                        ->format('%D');
                                @endphp
                                <div class="end-time mt-3">
                                    <b>زمان باقی مانده برای دانلود فایل :</b><br><br>
                                    <span id="d">{{ $d }} روز</span> , <span>{{ $h }}
                                        ساعت</span> , <span id="i">{{ $i }} </span>دقیقه , <span
                                        id="s">{{ $s }}</span> ثانیه
                                </div>
                                <li class="flash-cont">
                                    <div class="flash-by-cont">
                                        <ul>
                                            @if ($Byed->flash != 'false')
                                                @php
                                                    $linkFlashs = json_decode(\App\Models\device::find($Byed->deviceId)->flash);
                                                    $flashId = \App\Models\device::find($Byed->deviceId)->id;
                                                @endphp
                                                <li>دانلود فایل های فلش ارائه شده:<br><br>
                                                    @foreach ($linkFlashs as $key => $item)
                                                        <a href="{{ route('downloadeFile', ['file' => Crypt::encrypt($flashId), 'order' => $key, 'type' => Crypt::encrypt('flash')]) }}"
                                                            class="link-download">دانلود فایل {{ $key + 1 }}</a><br>
                                                    @endforeach
                                                </li>
                                            @endif
                                            <br />
                                            @if ($Byed->iprom != 'false')
                                                @php
                                                    $linkIprom = json_decode(\App\Models\device::find($Byed->deviceId)->iprom);
                                                    $IpromId = \App\Models\device::find($Byed->deviceId)->id;
                                                @endphp
                                                <li>دانلود فایل های ایپروم ارائه شده:<br><br>
                                                    @foreach ($linkIprom as $key => $item)
                                                        <a href="{{ route('downloadeFile', ['file' => Crypt::encrypt($IpromId), 'order' => $key, 'type' => Crypt::encrypt('iprom')]) }}"
                                                            class="link-download">دانلود فایل {{ $key + 1 }}</a><br>
                                                    @endforeach

                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                    <div class="flash-dis-cont">
                                        @php
                                            $device = \App\Models\device::where('id', $Byed->deviceId)->first();
                                        @endphp
                                        <div>آیدی سایت : <span>{{ $device->id2 }}</span></div>
                                        <div>کد روی برد : <span>{{ $device->name1 }}</span></div>
                                        <div>کد پشت برد : <span>{{ $device->name2 }}</span></div>
                                        <div>برچسب روی برد : <span>{{ $device->name3 }}</span></div>
                                        <div>پردازنده : <span>{{ $device->ic }}</span></div>
                                        <div>لیبل: <span>{{ $device->lable }}</span></div>
                                        <div>حجم فایل فلش: <span>{{ $device->flashSize }}</span></div>
                                        <div>رمز: <span>{{ $device->password }}</span></div>
                                        <div>تعداد کانال : <span>{{ $device->chanel }}</span></div>
                                    </div>
                                    <div class="flash-img-cont">
                                        <div class="slider">
                                            @php
                                                $imags = json_decode($device->imags);
                                            @endphp
                                            @foreach ($imags as $img)
                                                <div class="img-magnifier-container">
                                                    <img class="myimage" src="{{ $img }}" alt="" />
                                                </div>
                                            @endforeach
                                            <div class="next fa fa-right-long"></div>
                                            <div class="prev fa fa-left-long"></div>
                                        </div>
                                    </div>
                                </li>
                                <br />
                                <span style="color:red "> اگر بیش از یک فایل در بالا هست ، از تعمیرکاران مختلفی خریداری شده
                                    است
                                    و تمامی فایل های ارائه شده سالم هستند</span>
                                <br /><br>
                                @php
                                    $commentBool = $commentBool = \App\Models\Comment::where('by_id', $Byed->id)->get();
                                @endphp
                                @if ($commentBool == '[]')
                                    <form action="{{ route('addComment') }}" class="comment-form" method="POST">
                                        @csrf
                                        <p style="white-space: pre-wrap;font-size:12px ">
                                             پس از فلش کردن ، نظر خود را درباره فایل بنویسید و دقیقا مشخص کنید کدام فایل اوکی
                                            بوده و نتیجه دستگاه شما چی شده
                                            و به ازای هر نظر 5 هزار تومان ناقابل تخفیف بگیرید .
                                            این نظرات برای همکاران و حتی خود شما در آینده خیلی مفید است .
                                            تخفیف بگیرید = 5 هزار تومان به ازای هر نظر
                                        </p>
                                        <textarea name="text" name="" id="" cols="30" rows="10"></textarea>
                                        <input name="device" type="hidden" value="{{ $device->id2 }}"><br>
                                        <input name="type" type="hidden" value="device"><br>
                                        <input name="by" type="hidden" value="{{ $Byed->id }}"><br>
                                        <input class="sb-comment-form" type="submit" value="ثبت نظر">
                                    </form><br>
                                @else
                                    <p>از نظر شما ممنونیم تخفیف شما با موفقیت قرار داده شد</p>
                                @endif
                            @elseif ($Byed->package_id != 0)
                                @php
                                    $endTime = \Carbon\Carbon::parse($Byed->created_at)->add(5, 'day');
                                    $timeForEnd = now()
                                        ->diff($endTime)
                                        ->format('%H:%I:%S-%Y-%M-%D');
                                    $h = now()
                                        ->diff($endTime)
                                        ->format('%H');
                                    $i = now()
                                        ->diff($endTime)
                                        ->format('%I');
                                    $s = now()
                                        ->diff($endTime)
                                        ->format('%S');
                                    $y = now()
                                        ->diff($endTime)
                                        ->format('%Y');
                                    $m = now()
                                        ->diff($endTime)
                                        ->format('%M');
                                    $d = now()
                                        ->diff($endTime)
                                        ->format('%D');
                                @endphp
                                <div class="end-time mt-3">
                                    <b>زمان باقی مانده برای دانلود فایل :</b><br><br>
                                    <span id="d">{{ $d }} روز</span> , <span>{{ $h }}
                                        ساعت</span> , <span id="i">{{ $i }} </span>دقیقه , <span
                                        id="s">{{ $s }}</span> ثانیه
                                </div>
                                <li class="flash-cont">
                                    @php
                                        $package = \App\Models\packege::where('id', $Byed->package_id)->first();
                                    @endphp
                                    <div class="flash-by-cont">
                                        <div>دانلود فایل های ایپروم ارائه شده:<br><br>
                                            <a href="{{ route('downloadeFile', ['file' => Crypt::encrypt($package->id), 'order' => 0, 'type' => Crypt::encrypt('pack')]) }}"
                                                class="link-download">دانلود فایل</a><br>
                                        </div>
                                    </div>
                                    <div class="flash-dis-cont">
                                        <div>نام پکیج : <span>{{ $package->name }}</span></div>
                                    </div>
                                    <div class="flash-img-cont">
                                        <div class="slider">
                                            @php
                                                $imags = json_decode($package->imags);
                                            @endphp
                                            @foreach ($imags as $img)
                                                <div class="img-magnifier-container">
                                                    <img class="myimage" src="{{ $img }}"
                                                        alt="موردی یافت نشد" />
                                                </div>
                                            @endforeach
                                            <div class="next fa fa-right-long"></div>
                                            <div class="prev fa fa-left-long"></div>
                                        </div>
                                    </div>
                                </li>
                                @php
                                    $commentBool = $commentBool = \App\Models\Comment::where('by_id', $Byed->id)->get();
                                @endphp
                                @if ($commentBool == '[]')
                                    <form action="{{ route('addComment') }}" class="comment-form" method="POST">
                                        @csrf
                                        <p style=" white-space: pre-wrap;font-size:12 ">
                                            پس از فلش کردن ، نظر خود را درباره فایل بنویسید و دقیقا مشخص کنید کدام فایل اوکی
                                            بوده و نتیجه دستگاه شما چی شده
                                            و به ازای هر نظر 5 هزار تومان ناقابل تخفیف بگیرید .
                                            این نظرات برای همکاران و حتی خود شما در آینده خیلی مفید است .
                                            تخفیف بگیرید = 5 هزار تومان به ازای هر نظر
                                        </p>
                                        <textarea name="text" name="" id="" cols="30" rows="10"></textarea>
                                        <input name="device" type="hidden" value="{{ $device->id2 }}"><br>
                                        <input name="by" type="hidden" value="{{ $Byed->id }}"><br>
                                        <input name="type" type="hidden" value="pack"><br>
                                        <input class="sb-comment-form" type="submit" value="ثبت نظر">
                                    </form><br>
                                @else
                                    <p>از نظر شما ممنونیم تخفیف شما با موفقیت قرار داده شد</p>
                                @endif
                            @elseif ($Byed->updateFile_id != 0)
                                @php
                                    $endTime = \Carbon\Carbon::parse($Byed->created_at)->add(5, 'day');
                                    $timeForEnd = now()
                                        ->diff($endTime)
                                        ->format('%H:%I:%S-%Y-%M-%D');
                                    $h = now()
                                        ->diff($endTime)
                                        ->format('%H');
                                    $i = now()
                                        ->diff($endTime)
                                        ->format('%I');
                                    $s = now()
                                        ->diff($endTime)
                                        ->format('%S');
                                    $y = now()
                                        ->diff($endTime)
                                        ->format('%Y');
                                    $m = now()
                                        ->diff($endTime)
                                        ->format('%M');
                                    $d = now()
                                        ->diff($endTime)
                                        ->format('%D');
                                @endphp
                                <div class="end-time mt-3">
                                    <b>زمان باقی مانده برای دانلود فایل :</b><br><br>
                                    <span id="d">{{ $d }} روز</span> , <span>{{ $h }}
                                        ساعت</span> , <span id="i">{{ $i }} </span>دقیقه , <span
                                        id="s">{{ $s }}</span> ثانیه
                                </div>
                                <li class="flash-cont">
                                    <div class="flash-by-cont">
                                        <ul>
                                            <li>
                                                @php
                                                    $linkFiles = json_decode(\App\Models\UpdateFile::find($Byed->updateFile_id)->path);
                                                    $device = \App\Models\UpdateFile::find($Byed->updateFile_id);
                                                @endphp
                                                <div>دانلود فایل های ارائه شده:<br><br>
                                                    @foreach ($linkFiles as $key => $item)
                                                        <a href="{{ route('downloadeFile', ['file' => Crypt::encrypt($device->id), 'order' => $key, 'type' => Crypt::encrypt('up')]) }}"
                                                            class="link-download">دانلود فایل </a><br>
                                                    @endforeach

                                            </li>
                                        </ul>
                                        <br>
                                    </div>
                                    <div class="flash-dis-cont">
                                        @php
                                            $device = \App\Models\UpdateFile::where('id', $Byed->updateFile_id)->first();
                                        @endphp
                                        <div>آیدی سایت : <span>{{ $device->id2 }}</span></div>
                                        <div>کد روی برد : <span>{{ $device->name1 }}</span></div>
                                        <div>کد پشت برد : <span>{{ $device->name2 }}</span></div>
                                        <div>برچسب روی برد : <span>{{ $device->name3 }}</span></div>
                                        <div>پردازنده : <span>{{ $device->ic }}</span></div>
                                        <div>لیبل: <span>{{ $device->lable }}</span></div>
                                        <div>تعداد کانال : <span>{{ $device->chanel }}</span></div>
                                    </div>
                                    <div class="flash-img-cont">
                                        <div class="slider">
                                            @php
                                                $imags = json_decode($device->imags);
                                            @endphp
                                            @foreach ($imags as $img)
                                                <div class="img-magnifier-container">
                                                    <img class="myimage" src="{{ $img }}"
                                                        alt="موردی یافت نشد" />
                                                </div>
                                            @endforeach
                                            <div class="next fa fa-right-long"></div>
                                            <div class="prev fa fa-left-long"></div>
                                        </div>
                                    </div>
                                    {{-- @php
                                        $commentBool = $commentBool = \App\Models\Comment::where('by_id', $Byed->id)->get();
                                    @endphp
                                    @if ($commentBool == '[]')
                                        <form action="{{ route('addComment') }}" class="comment-form" method="POST">
                                            @csrf
                                            <p style=" white-space: pre;">
                                                پس از فلش کردن ، نظر خود را درباره فایل بنویسید و دقیقا مشخص کنید کدام فایل
                                                اوکی
                                                بوده و نتیجه دستگاه شما چی شده
                                                و به ازای هر نظر 5 هزار تومان ناقابل تخفیف بگیرید .
                                                این نظرات برای همکاران و حتی خود شما در آینده خیلی مفید است .
                                                تخفیف بگیرید = 5 هزار تومان به ازای هر نظر
                                            </p>
                                            <textarea name="text" name="" id="" cols="30" rows="10"></textarea>
                                            <input name="device" type="hidden" value="{{ $device->id2 }}"><br>
                                            <input name="by" type="hidden" value="{{ $Byed->id }}"><br>
                                            <input name="type" type="hidden" value="pack"><br>
                                            <input class="sb-comment-form" type="submit" value="ثبت نظر">
                                        </form><br>
                                    @else
                                        <p>از نظر شما ممنونیم تخفیف شما با موفقیت قرار داده شد</p>
                                    @endif --}}
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </section>
            </div>
        </div>

        {{-- ===================================== byed ===================================== --}}
        {{-- ===================================== byed ===================================== --}}
        {{-- ===================================== byed ===================================== --}}
        {{-- ===================================== byed ===================================== --}}
        {{-- ===================================== byed ===================================== --}}
        {{-- ===================================== byed ===================================== --}}
        {{-- ===================================== byed ===================================== --}}
        {{-- ===================================== byed ===================================== --}}
        <!-- END tabs-content -->
    </div>
    <!-- END tabs -->
@endsection
@section('scripts')
    @if (session('pay') == 'erroe')
        <script>
            alertEore('پرداخت نا موفق بود')
        </script>
    @endif
    @if (session('addComment') == 1)
        <script>
            alertSucsses('از نظر شما ممنونم')
            $('#by-tab').parent().removeClass('active');
            $('#down-tab').parent().addClass('active');
            $('.tab-content1').hide();
            $('.tab-content2').show();
        </script>
    @endif
    @if (session('pay') == 'successful')
        <script !src="">
            alertSucsses('پرداخت موفق بود')
            $('#by-tab').parent().removeClass('active');
            $('#down-tab').parent().addClass('active');
            $('.tab-content1').hide();
            $('.tab-content2').show();
        </script>
    @else
        <script>
            // $("#tabs-nav li:first-child").addClass("active");
            // $(".tab-content").hide();
            // $(".tab-content:first").show();
        </script>
    @endif
    <script>
        setInterval(() => {
            var timz = document.getElementsByClassName('end-time');
            for (let j = 0; j < timz.length; j++) {
                var s = eval($(timz[j]).find('#s').text());
                s = s - 1;
                if (s < 1) {
                    var i = eval($(timz[j]).find('#i').text());
                    if (i < 1) {
                        var h = eval($(timz[j]).find('#h').text());
                        h = h - 1;
                        s = 60
                        i = 60
                        $(timz[j]).find('#s').text(s)
                        $(timz[j]).find('#i').text(i)

                    }
                    i = i - 1;
                    s = 60
                    $(timz[j]).find('#s').text(s)
                    $(timz[j]).find('#i').text(i)

                }
                $(timz[j]).find('#s').text(s);
            }

        }, 1000);
        $('.discountCheckbox').click(function(e) {
            var totalPrice = eval($('.totalPrice').text())
            var panelDiscount = eval($('.panelDiscount').text())
            if ($(e.target).is(":checked")) {
                totalPrice = totalPrice - panelDiscount
                $('.totalPrice').text(totalPrice);
            } else {
                totalPrice = totalPrice + panelDiscount
                $('.totalPrice').text(totalPrice);
            }
        });
    </script>
@endsection
