@extends('flash.layout.layout')
@section('title')
    درباره ما
@endsection
@section('css')
    <style>
        .abute-dic {
            padding: 120px;
        }

        .abute-galoru ul {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
    </style>
@endsection
@section('content')
    <a href="/">
        <div class="home"><i class="fa fa-home"></i><br>صفحه اصلی </div>
    </a>
    <div class="abute-dic">
        <ul>
            <li><b>آدرس مرکز تعمیرات آتی سو : </b>استان یزد ، شهرستان یزد
                خیابان فرخی ، پاساژ فرخی
                طبقه همکف ، آخرین مغازه
                (تعمیرات دوربین مداربسته)
                کد پستی : 8913893654</li>
            <li><b>همراه: </b>09217902890</li>
        </ul>
        {{-- <ul>
        <li><b>ادرس : </b>یزد</li>
    </ul> --}}
    </div>
    <div class="abute-galoru">
        <ul>
            <img width="60%" src="/flash/img/about2.jpg" alt="موردی یافت نشد">
            <img width="60%" src="/flash/img/about1.jpg" alt="موردی یافت نشد">
        </ul>
    </div>
@endsection
@section('scripts')
    <script>
        $('.abute').css('box-shadow', '0px 8px 5px rgb(122 122 122) ');
    </script>
@endsection