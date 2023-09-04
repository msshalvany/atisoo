@extends('admin.layout.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section>
                <h1 class="pageLables">اپدیت</h1>
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <section class="panel">
                            <div class="panel-body">
                                <form role="form" action="{{ route('commentUpdate', ['id' => $comment->id]) }}" method="POST"
                                    enctype="multipart/form-data" autocomplete="off">
                                    @csrf   
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">متن</label>
                                        <textarea class="form-control" name="text" id="" cols="30" rows="10">{{ $comment->text }}</textarea>
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
