@extends('admin.layout.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section>
                <h1 class="pageLables">اپدیت</h1>
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <section class="panel">
                            <header class="panel-heading">
                                Basic Forms
                            </header>
                            <div class="panel-body">
                                <form role="form"
                                    action="{{ route('flashUpdateManual', ['id' => $device->id]) }}"
                                    method="POST" enctype="multipart/form-data" autocomplete="off">
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleInputPassword1"> کد روی برد</label>
                                        <input type="text" name="name1" class="form-control" id="exampleInputPassword1"
                                            value="{{ $device->name1 }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">کد پشت برد</label>
                                        <input type="text" name="name2" class="form-control" id="exampleInputPassword1"
                                            value="{{ $device->name2 }}"required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1"> برچسب برد</label>
                                        <input type="text" name="name3" class="form-control" id="exampleInputPassword1"
                                            value="{{ $device->name3 }}"required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">ic</label>
                                        <input type="text" name="ic" class="form-control" id="exampleInputPassword1"
                                            value="{{ $device->ic }}"required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">lable</label>
                                        <input type="text" name="lable" class="form-control" id="exampleInputPassword1"
                                            value="{{ $device->lable }}"required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">chanel</label>
                                        <input type="text" name="chanel" class="form-control" id="exampleInputPassword1"
                                            value="{{ $device->chanel }}"required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">ipromName</label>
                                        <input type="text" name="ipromName" class="form-control"
                                            id="exampleInputPassword1" value="{{ $device->ipromName }}"required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">flashSize</label>
                                        <input type="text" name="flashSize" class="form-control"
                                            id="exampleInputPassword1" value="{{ $device->flashSize }}"required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">قیمت فایل فلش</label>
                                        <input type="number" name="flashPrice" class="form-control"
                                            id="exampleInputPassword1" value="{{ $device->flashPrice }}"required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">قیمت فایل فلش</label>
                                        <input type="number" name="ipromPrice" class="form-control"
                                            id="exampleInputPassword1" value="{{ $device->ipromPrice }}"required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">password</label>
                                        <input type="text" name="password" class="form-control"
                                            id="exampleInputPassword1" value="{{ $device->password }}"required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">قیمت فایل فلش</label>
                                        <textarea type="number" name="description" class="form-control"
                                            id="exampleInputPassword1" value="{{ $device->description }}"required>
                                            {{ $device->description   }}
                                        </textarea>
                                    </div>
                                    <button style="margin-top: 12px;" type="submit" name="btn" class="btn btn-info">
                                        آپدیت
                                    </button>
                                </form>
                            </div>
                        </section>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <script src="/admin/js/jquery.js"></script>
@endsection
