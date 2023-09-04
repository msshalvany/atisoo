@extends('admin.layout.layout')
@section('content')
    <p>یه مسیر زیر در هاست خود برویدو فایل های خود را در پوشه هایی از 0 تا 100 قرار دهید</p>
    <img src="/flash/img/resetDevice1.png" alt=""><br><br>
    <p>پوشه بندی در پوشه ها به شکل زیر باید قرار بگیرد</p>
    <img src="/flash/img/resetDevice2.png" alt=""><br><br>
    <p>نمونه ای از فایل جیسان</p><br>
    <img src="/flash/img/resetDevice3.png" alt=""><br><br>
    <a href="/flash/img/rest_cam_device.json">دانلود</a>
    <form role="form" action="{{ route('resetPassDvrNvrLoder') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
        @csrf
        <button style="margin-top: 12px;" type="submit" name="btn" class="btn btn-info"> بروزرسانی ریست پسورد  DVR NVR 
        </button>
    </form><br>
@endsection
