@extends('admin.layout.layout')
@section('content')
    <span>جمع کل خرید ها : </span> {{ $data->count }}<br> <br>
    <span>جمع کل</span> : {{ $data->total }} هزار تومان<br><br>
    <br><br>
    <form action="{{ route('resetMonny') }}" method="post">
        @csrf
        <button class="btn btn-info">resete</button>
    </form>
    <h3>تعویض قیمت تمام فایل ها</h3>
    <form class="container row" action="{{ route('updatPiceALL') }}" method="post">
        @csrf
        <label for="">فایل فلش : </label>
        <input style="width: 240px;display: inline" class="form-control" name="flash" value="50" type="number"><br><br>
        <label for="">فایل اپروم : </label>
        <input style="width: 240px;display: inline" class="form-control" name="iprom" value="20"
            type="number"><br><br>
        <input type="submit" value="انجام" class="btn btn-primary">
    </form>
@endsection
