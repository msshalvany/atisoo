@extends('admin.layout.layout')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <section>
            <h1 class="pageLables">افزودن مورد جدید</h1>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <section class="panel">
                        <header class="panel-heading">
                        عکس فایل اپدیت
                        </header>
                        <div class="panel-body">
                            <form role="form" action="{{ route('byForYouUpdateFileImageInsert') }}" method="post" enctype="multipart/form-data"
                                autocomplete="off">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputPassword1">عکس</label>
                                    <input type="file" name="img" class="form-control" id="exampleInputPassword1">
                                </div>
                                <input type="hidden" name="idDevice" value="{{$idDevice}}">
                                <button type="submit" style="margin-top: 12px;"name="btn" class="btn btn-info">اضافه کردن</button>
                                <br><br>
                                <a href="{{ route('byForYouUpdateFileList') }}" class="btn btn-info">اتمام</a>
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