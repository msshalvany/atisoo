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
                                <form role="form" action="{{ route('cooperateUpdateM', ['id' => $cooperate->id]) }}" method="POST"
                                    enctype="multipart/form-data" autocomplete="off">
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">نام</label>
                                        <input type="text" name="name" value="{{ $cooperate->name }}"
                                            class="form-control" id="exampleInputPassword1">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">کد </label>
                                        <input type="text" name="code" value="{{ $cooperate->code }}"
                                            class="form-control" id="exampleInputPassword1">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">sort</label>
                                        <input type="number" name="sort" value="{{ $cooperate->sort }}"
                                            class="form-control" id="exampleInputPassword1">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">توضیحات</label>
                                        <textarea class="form-control" name="description" id="" cols="30" rows="10">{{ $cooperate->description }}</textarea>
                                    </div>
                                    <button style="margin-top: 12px;" type="submit" name="btn"
                                        class="btn btn-info">اپدیت
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
