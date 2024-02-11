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
                                متن اماده
                            </header>
                            <div class="panel-body">
                                <form role="form" action="{{ route('addReadyMessege') }}" method="POST" enctype="multipart/form-data"
                                    autocomplete="off">
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">متن جدید</label>
                                        <textarea required type="text" name="text" class="form-control"
                                            id="exampleInputPassword1"></textarea>
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
        <table class="table table-striped table-advance table-hover">
            <thead>
                <tr>
                    <td>متن</td>
                    <td>حذف</td>
                </tr>
            </thead>
            <tbody>

                @foreach ($list as $item)
                    <tr>
                        <td>{{ $item->text }}</td>
                        <form  action="{{ route('readyMessegeDelete', ['id' => $item->id]) }}"
                            method="POST">
                            @csrf
                            @method('delete')
                            <td>
                                <button class="btn btn-danger btn-xs"><i class="icon-trash "></i></button>
                            </td>
                        </form>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
