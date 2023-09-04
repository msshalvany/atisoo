@extends('admin.layout.layout')
@section('content')
    <div class="conf-cont">
        <p>ایا از انجام این عملیات مطمعن هستید</p>
        <div>
            <button class="cancel">کنسل</button>
            <button class="submit">مطمعن</button>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    لیست فایل ها
                </header>
                <form class="container row" action="{{ route('flashSearch') }}">
                    <input style="width: 240px;display: inline" class="form-control" name="text" type="text">
                    <input type="submit" value="جستوجو" class="btn btn-primary">
                </form><br>
                @if ($device->hasPages())
                    <ul class="pagination pagination" style="display: flex">
                        {{-- Previous Page Link --}}
                        @if ($device->onFirstPage())
                            <li class="disabled"><span>«</span></li>
                        @else
                            <li><a href="{{ $device->appends(request()->input())->previousPageUrl() }}" rel="prev">«</a>
                            </li>
                        @endif

                        @if ($device->currentPage() > 3)
                            <li class="hidden-xs"><a href="{{ $device->appends(request()->input())->url(1) }}">1</a></li>
                        @endif
                        @if ($device->currentPage() > 4)
                            <li><span>...</span></li>
                        @endif
                        @foreach (range(1, $device->lastPage()) as $i)
                            @if ($i >= $device->currentPage() - 2 && $i <= $device->currentPage() + 2)
                                @if ($i == $device->currentPage())
                                    <li class="active"><span>{{ $i }}</span></li>
                                @else
                                    <li><a
                                            href="{{ $device->appends(request()->input())->url($i) }}">{{ $i }}</a>
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
                <table class="table table-striped table-advance table-hover">
                    <thead>
                        <tr>
                            <td>id</td>
                            <td>نام</td>
                            <td>نمایش</td>
                            <td>حذف</td>
                            <td>آپدیت</td>
                            <td>آپدیت دستی</td>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($device as $item)
                            <tr>
                                <td>{{ $item->id2 }}</td>
                                <td>{{ $item->name1 }}</td>
                                <form class="" action="{{ route('flashShow', ['id' => $item->id]) }}" method="GET">
                                    @csrf
                                    @method('delete')
                                    <td>
                                        <button class="btn btn-success btn-xs"><i class="icon-picture"></i></button>
                                    </td>
                                </form>
                                <form class="conf-form" action="{{ route('flashDelete', ['id' => $item->id]) }}"
                                    method="POST">
                                    @csrf
                                    @method('delete')
                                    <td>
                                        <button class="btn btn-danger btn-xs"><i class="icon-trash "></i></button>
                                    </td>
                                </form>
                                <form action="{{ route('flashUpdate', ['id' => $item->id]) }}" method="POST">
                                    @csrf
                                    <td>
                                        <button class="btn btn-primary btn-xs"><i class="icon-pencil "></i></button>
                                    </td>
                                </form>
                                <form action="{{ route('flashUpdateManualV', ['id' => $item->id]) }}" method="get">
                                    @csrf
                                    <td>
                                        <button class="btn btn-warning btn-xs"><i class="icon-pencil "></i></button>
                                    </td>
                                </form>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                @if ($device->hasPages())
                    <ul class="pagination pagination" style="display: flex">
                        {{-- Previous Page Link --}}
                        @if ($device->onFirstPage())
                            <li class="disabled"><span>«</span></li>
                        @else
                            <li><a href="{{ $device->appends(request()->input())->previousPageUrl() }}"
                                    rel="prev">«</a></li>
                        @endif

                        @if ($device->currentPage() > 3)
                            <li class="hidden-xs"><a href="{{ $device->appends(request()->input())->url(1) }}">1</a></li>
                        @endif
                        @if ($device->currentPage() > 4)
                            <li><span>...</span></li>
                        @endif
                        @foreach (range(1, $device->lastPage()) as $i)
                            @if ($i >= $device->currentPage() - 2 && $i <= $device->currentPage() + 2)
                                @if ($i == $device->currentPage())
                                    <li class="active"><span>{{ $i }}</span></li>
                                @else
                                    <li><a
                                            href="{{ $device->appends(request()->input())->url($i) }}">{{ $i }}</a>
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
            </section>
            @if (count($device) == 0)
                <div style="text-align: center">موردی یافت نشد</div><br>
                <a style="text-align: center;display: block;" class="btn btn-primary" href="/dashbord/flashList">برگشت</a>
            @endif
        </div>
    </div>
    @if (session('updateFlashErr'))
        <script !src="">
            alertEore('فایل موجود نیست')
        </script>
    @endif
    @if (session('byedErr'))
        <script !src="">
            alertEore('فایل در سبد خرید فردی وجود دارد')
        </script>
    @endif
    @if (session('shopErr'))
        <script !src="">
            alertEore('فایل را فردی خریده لطفا 24 ساعت صبر کنید')
        </script>
    @endif

@endsection