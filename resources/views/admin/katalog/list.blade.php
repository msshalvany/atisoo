@extends('admin.layout.layout')
@section('content')
    <table class="table table-striped table-advance table-hover">
        <thead>
            <tr>
                <td>نام</td>
                <td>ترتیب</td>
                @if (session()->get('level') <= 1)
                    <td>حذف</td>
                @endif
                <td>اپدیت</td>
                <td>اپدیت دستی</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($katalog as $item)
                <tr>
                    <td>{{ $item->id2 }}</td>
                    <td>{{ $item->sort }}</td>
                    @if (session()->get('level') <= 1)
                        <form action="{{ route('katalogDelete', ['id' => $item->id]) }}" method="POST">
                            @csrf
                            @method('delete')
                            <td>
                                <button class="btn btn-danger btn-xs"><i class="icon-trash "></i></button>
                            </td>
                        </form>
                    @endif
                    <form action="{{ route('katalogUpdate', ['id' => $item->id]) }}" method="POST">
                        @csrf
                        <td>
                            <button class="btn btn-primary btn-xs"><i class="icon-pencil "></i></button>
                        </td>
                    </form>
                    <form action="{{ route('katalogUpdatView', ['id' => $item->id]) }}" method="get">
                        @csrf
                        <td>
                            <button class="btn btn-warning btn-xs"><i class="icon-pencil "></i></button>
                        </td>
                    </form>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
