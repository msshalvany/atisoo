@extends('admin.layout.layout')
@section('content')
    <p>یه مسیر زیر در هاست خود برویدو فایل های خود را در پوشه هایی از 0 تا 100 قرار دهید</p>
    <img src="/flash/img/gide_flash.png" alt=""><br><br>
    <p>پوشه بندی در پوشه ها به شکل زیر باید قرار بگیرد</p>
    <img src="/flash/img/gide_flash2.png" alt=""><br><br>
    <p>نمونه ای از فایل جیسان</p><br>
    <img src="/flash/img/gide_flash3.png" alt=""><br><br>
    <a href="/flash/img/data_file.json">دانلود</a>
    <form role="form" action="{{ route('flashLodear') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
        @csrf
        <button style="margin-top: 12px;" type="submit" name="btn" class="btn btn-info">اپلود فابل های فلش
        </button>
    </form><br>
@endsection
