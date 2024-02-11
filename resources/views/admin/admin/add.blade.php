@extends('admin.layout.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section>
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <section class="panel">
                            <header class="panel-heading">
                                admins
                            </header>
                            <div class="panel-body">
                                <form role="form" action="{{ route('adminAdd') }}" method="POST"
                                    enctype="multipart/form-data" autocomplete="off">
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">username</label>
                                        <input type="text" name="username" 
                                            class="form-control" id="exampleInputPassword1">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">level</label>
                                        <input type="number"  name="level" 
                                            class="form-control" id="exampleInputPassword1">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">password</label>
                                        <input type="text"  name="password" 
                                            class="form-control" id="exampleInputPassword1">
                                    </div>

                                    <button style="margin-top: 12px;" type="submit" name="btn"
                                        class="btn btn-info">اضافه
                                        کردن
                                    </button>
                                </form>
                            </div>
                            @error('username')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            @error('level')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </section>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <script src="/admin/js/jquery.js"></script>
@endsection
