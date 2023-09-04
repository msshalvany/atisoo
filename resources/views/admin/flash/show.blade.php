@extends('admin.layout.layout')
@section('content')
    <table class="table table-striped">
        <tbody>
            <tr>
                <th scope="row">ایدی سایت</th>
                <td>{{ $device->id2 }}</td>
            </tr>
            <tr>
                <th scope="row">کد روی برد</th>
                <td>{{ $device->name1 }}</td>
            </tr>
            <tr>
                <th scope="row">کد پشت برد</th>
                <td>{{ $device->name2 }}</td>
            </tr>
            <tr>
                <th scope="row">کد روی برچسب برد</th>
                <td>{{ $device->name3 }}</td>
            </tr>
            <tr>
                <th scope="row">ic</th>
                <td>{{ $device->ic }}</td>
            </tr>
            <tr>
                <th scope="row"> lable</th>
                <td>{{ $device->lable }}</td>
            </tr>
            <tr>
                <th scope="row">chanel</th>
                <td>{{ $device->chanel }}</td>
            </tr>
            <tr>
                <th scope="row">size</th>
                <td>{{ $device->flashSize }}</td>
            </tr>
            <tr>
                <th scope="row">password</th>
                <td>{{ $device->password }}</td>
            </tr>
            <tr>
                <th scope="row">توضیحات</th>
                <td>{{ $device->description }}</td>
            </tr>
        </tbody>
    </table>
    <b style="font-size: 24px">نظر کاربران</b><br><br>
    <ul class="list-group">
        @foreach ($comment as $item)
            <li class="list-group-item">{{$item->text}}</li>
        @endforeach
    </ul>
@endsection
