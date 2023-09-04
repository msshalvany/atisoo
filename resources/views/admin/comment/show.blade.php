@extends('admin.layout.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    لیست فایل ها
                </header>
                @if ($comments->hasPages())
                    <ul class="pagination pagination" style="display: flex">
                        {{-- Previous Page Link --}}
                        @if ($comments->onFirstPage())
                            <li class="disabled"><span>«</span></li>
                        @else
                            <li><a href="{{ $comments->appends(request()->input())->previousPageUrl() }}" rel="prev">«</a>
                            </li>
                        @endif

                        @if ($comments->currentPage() > 3)
                            <li class="hidden-xs"><a href="{{ $comments->appends(request()->input())->url(1) }}">1</a></li>
                        @endif
                        @if ($comments->currentPage() > 4)
                            <li><span>...</span></li>
                        @endif
                        @foreach (range(1, $comments->lastPage()) as $i)
                            @if ($i >= $comments->currentPage() - 2 && $i <= $comments->currentPage() + 2)
                                @if ($i == $comments->currentPage())
                                    <li class="active"><span>{{ $i }}</span></li>
                                @else
                                    <li><a
                                            href="{{ $comments->appends(request()->input())->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endif
                            @endif
                        @endforeach
                        @if ($comments->currentPage() < $comments->lastPage() - 3)
                            <li><span>...</span></li>
                        @endif
                        @if ($comments->currentPage() < $comments->lastPage() - 2)
                            <li class="hidden-xs"><a
                                    href="{{ $comments->url($comments->lastPage()) }}">{{ $comments->lastPage() }}</a>
                            </li>
                        @endif

                        {{-- Next Page Link --}}
                        @if ($comments->hasMorePages())
                            <li><a href="{{ $comments->appends(request()->input())->nextPageUrl() }}" rel="next">»</a>
                            </li>
                        @else
                            <li class="disabled"><span>»</span></li>
                        @endif
                    </ul>
                @endif
                <table class="table table-striped table-advance table-hover">
                    <thead>
                        <tr>
                            <td>متن</td>
                            <td>کاربر</td>
                            <td>دستگاه</td>
                            <td>حذف</td>
                            <td>آپدیت</td>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($comments as $item)
                            <tr>
                                <td>{{ $item->text }}</td>
                                <td>{{ $item->user_id}}</td>
                                <td>{{ $item->device_id}}</td>
                                <form  action="{{ route('commentDelete', ['id' => $item->id]) }}"
                                    method="POST">
                                    @csrf
                                    @method('delete')
                                    <td>
                                        <button class="btn btn-danger btn-xs"><i class="icon-trash "></i></button>
                                    </td>
                                </form>
                                <form action="{{ route('commentUpdateShow', ['id' => $item->id]) }}" method="get">
                                    @csrf
                                    <td>
                                        <button class="btn btn-primary btn-xs"><i class="icon-pencil "></i></button>
                                    </td>
                                </form>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                @if ($comments->hasPages())
                    <ul class="pagination pagination" style="display: flex">
                        {{-- Previous Page Link --}}
                        @if ($comments->onFirstPage())
                            <li class="disabled"><span>«</span></li>
                        @else
                            <li><a href="{{ $comments->appends(request()->input())->previousPageUrl() }}"
                                    rel="prev">«</a></li>
                        @endif

                        @if ($comments->currentPage() > 3)
                            <li class="hidden-xs"><a href="{{ $comments->appends(request()->input())->url(1) }}">1</a></li>
                        @endif
                        @if ($comments->currentPage() > 4)
                            <li><span>...</span></li>
                        @endif
                        @foreach (range(1, $comments->lastPage()) as $i)
                            @if ($i >= $comments->currentPage() - 2 && $i <= $comments->currentPage() + 2)
                                @if ($i == $comments->currentPage())
                                    <li class="active"><span>{{ $i }}</span></li>
                                @else
                                    <li><a
                                            href="{{ $comments->appends(request()->input())->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endif
                            @endif
                        @endforeach
                        @if ($comments->currentPage() < $comments->lastPage() - 3)
                            <li><span>...</span></li>
                        @endif
                        @if ($comments->currentPage() < $comments->lastPage() - 2)
                            <li class="hidden-xs"><a
                                    href="{{ $comments->url($comments->lastPage()) }}">{{ $comments->lastPage() }}</a>
                            </li>
                        @endif

                        {{-- Next Page Link --}}
                        @if ($comments->hasMorePages())
                            <li><a href="{{ $comments->appends(request()->input())->nextPageUrl() }}" rel="next">»</a>
                            </li>
                        @else
                            <li class="disabled"><span>»</span></li>
                        @endif
                    </ul>
                @endif
            </section>
            @if (count($comments) == 0)
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
