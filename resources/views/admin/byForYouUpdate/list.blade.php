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
                <td>ادیت</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($device as $item)
                <tr>
                    <td>{{ $item->name1 }}</td>
                    <td>{{ $item->sort }}</td>
                    @if (session()->get('level') <= 1)
                        <form action="{{ route('byForYouUpdateFileDelete', ['id' => $item->id]) }}" method="POST">
                            @csrf
                            @method('delete')
                            <td>
                                <button class="btn btn-danger btn-xs"><i class="icon-trash "></i></button>
                            </td>
                        </form>
                    @endif
                    <form action="{{ route('byForYouUpdateFileUpdateV', ['id' => $item->id]) }}" method="get">
                        @csrf
                        <td>
                            <button class="btn btn-info btn-xs"><i class="icon-trash "></i></button>
                        </td>
                    </form>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
