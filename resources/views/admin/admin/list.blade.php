@extends('admin.layout.layout')
@section('content')
<table class="table table-striped table-advance table-hover">
    <thead>
    <tr>
        <td>نام</td>
        <td>لول</td>
        <td>حذف</td>
        <td>ادیت</td>
    </tr>
    </thead>
    <tbody>
    @foreach ($admin as $item)
        <tr>
            <td>{{ $item->username }}</td>
            <td>{{ $item->level }}</td>
            <form class="conf-form" action="{{route('adminDelete',['id'=>$item->id])}}" method="POST">
                @csrf
                <td>
                    <button class="btn btn-danger btn-xs"><i class="icon-trash "></i></button>
                </td>
            </form>
            <form action="{{route('adminUpdateV',['id'=>$item->id])}}" method="get">
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