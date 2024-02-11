@extends('admin.layout.layout')
@section('content')
    <p>یه مسیر زیر در هاست خود برویدو فایل های خود را در پوشه هایی از 0 تا 100 قرار دهید</p>
    <p>پوشه بندی در پوشه ها به شکل زیر باید قرار بگیرد</p>
    <img src="/flash/img/katalog/2.png" alt=""><br><br>
    <p>نمونه ای از فایل جیسان</p><br>
    <img src="/flash/img/katalog/json.png" width="600px" alt=""><br><br>
    <a href="/flash/img/katalog/json.json">دانلود</a>
    <form role="form" action="{{ route('katalogLoder') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
        @csrf
        <button style="margin-top: 12px;" type="submit" name="btn" class="btn btn-info">اضافه کردن  کاتالوگ
        </button>
    </form><br>
@endsection
