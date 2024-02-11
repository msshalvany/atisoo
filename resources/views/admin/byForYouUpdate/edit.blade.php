@extends('admin.layout.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section>
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <section class="panel">
                            <header class="panel-heading">
                               فایل اپدیت
                            </header>
                            <div class="panel-body">
                                <form role="form" action="{{ route('byForYouUpdateFileUpdate', ['id'=>$byForYou->id]) }}" method="POST" enctype="multipart/form-data"
                                    autocomplete="off">
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleInputPassword1"> کد روی برد</label>
                                        <input type="text" name="name1" value="{{$byForYou->name1}}" class="form-control"
                                            id="exampleInputPassword1">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">کد پشت برد</label>
                                        <input type="text" name="name2" value="{{$byForYou->name2}}" class="form-control"
                                            id="exampleInputPassword1">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1"> برچسب برد</label>
                                        <input type="text" name="name3" value="{{$byForYou->name3}}" class="form-control"
                                            id="exampleInputPassword1">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">ic</label>
                                        <input type="text" name="ic" value="{{$byForYou->ic}}" class="form-control"
                                            id="exampleInputPassword1">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">lable</label>
                                        <input type="text" name="lable" value="{{$byForYou->lable}}" class="form-control"
                                            id="exampleInputPassword1">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">chanel</label>
                                        <input type="text" name="chanel" value="{{$byForYou->chanel}}" class="form-control"
                                            id="exampleInputPassword1">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">sort</label>
                                        <input type="number" name="sort" value="{{$byForYou->sort}}" class="form-control"
                                            id="exampleInputPassword1">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">قیمت</label>
                                        <input type="number" name="price" value="{{$byForYou->price}}"  class="form-control"
                                            id="exampleInputPassword1">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">description</label>
                                        <textarea  class="form-control" name="description" id="" cols="30" rows="10">{{$byForYou->description}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">فایل صوتی</label>
                                        <input type="file" name="mp3" class="form-control"
                                            id="exampleInputPassword1">
                                    </div>
                                    <button style="margin-top: 12px;" type="submit" name="btn"
                                        class="btn btn-info">اضافه
                                        کردن
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
