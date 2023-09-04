@extends('admin.layout.layout')
@section('content')
    <section>
        <div class="col-lg-12">
            <section class="panel">
                <div class="panel-body">
                    <form role="form" action="{{route('changInfo')}}" method="POST" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputPassword1">کلمات کلیدی صفحه اصلی</label><br>
                            <textarea name="indexKey" class="form-control" id="exampleInputPassword1" cols="100% " rows="5">{{$info->indexKey}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">کلمات کلیدی صفحه سرچ فلش</label><br>
                            <textarea name="searchFlashKey" class="form-control" id="exampleInputPassword1" cols="100% " rows="5">{{$info->searchFlashKey}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">کلمات کلیدی صفحه سرچ اپدیت</label><br>
                            <textarea name="searchUpdateKey" class="form-control" id="exampleInputPassword1" cols="100% " rows="5">{{$info->searchUpdateKey}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">کلمات کلیدی صفحه خرید از شما فلش </label><br>
                            <textarea name="byFlahYouKey" class="form-control" id="exampleInputPassword1" cols="100% " rows="5">{{$info->byFlahYouKey}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">کلمات کلیدی صفحه خرید از شما اپدیت </label><br>
                            <textarea name="byUpdateYouKey" class="form-control" id="exampleInputPassword1" cols="100% " rows="5">{{$info->byUpdateYouKey}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">کلمات کلیدی صفحه خرید فایل  به جای کلمات برد و غیره * بگزذارید</label><br>
                            <textarea name="deviceKey" class="form-control" id="exampleInputPassword1" cols="100% " rows="5">{{$info->deviceKey}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">کلمات کلیدی صفحه  ریست DVR</label><br>
                            <textarea name="resetDeviceKey" class="form-control" id="exampleInputPassword1" cols="100% " rows="5">{{$info->resetDeviceKey}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">کلمات کلیدی صفحه  ریست cam ip</label><br>
                            <textarea name="resetCamKey" class="form-control" id="exampleInputPassword1" cols="100% " rows="5">{{$info->resetCamKey}}</textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputPassword1">لوگو</label>
                            <input type="file" name="logo" value="/flash/img/logo.jpg" class="form-control"
                                   id="exampleInputPassword1">
                        </div>
                        <img src="/{{$info->logo}}" width="300" alt=""><br>
                        <button style="margin-top: 12px;" type="submit"
                                name="btn" class="btn btn-info">تغیر
                        </button>
                    </form>
                </div>
            </section>
        </div>
    </section>
@endsection
