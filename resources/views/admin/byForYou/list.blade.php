@extends('admin.layout.layout')
@section('content')
<table class="table table-striped table-advance table-hover">
    <thead>
    <tr>
        <td>نام</td>
        <td>حذف</td>
    </tr>
    </thead>
    <tbody>
    @foreach ($device as $item)
        <tr>
            <td>{{ $item->name1 }}</td>
            <form action="{{route('byForYouDelete',['id'=>$item->id])}}" method="POST">
                @csrf
                @method('delete')
                <td>
                    <button class="btn btn-danger btn-xs"><i class="icon-trash "></i></button>
                </td>
            </form>
        </tr>
    @endforeach
    </tbody>
</table>

@endsection