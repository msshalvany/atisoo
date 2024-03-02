@extends('flash.layout.layout')
@section('title')
    اطلاعات
@endsection
@section('css')
        .form-complete {
            top: 50%;
            margin-top: -200px !important;
            height: 300px !important;
        }

        /* file upload button */
        input[type="file"]::file-selector-button {
            border-radius: 4px;
            padding: 0 16px;
            height: 40px;
            cursor: pointer;
            background-color: #0059FF;
            color: white;
            border: 1px solid #0059FF;
            box-shadow: 0px 1px 0px rgba(0, 0, 0, 0.05);
            margin-right: 16px;
            transition: background-color 200ms;
        }

        /* file upload button hover state */
        input[type="file"]::file-selector-button:hover {
            background-color: transparent;
            color: #0059FF;
        }

        /* file upload button active state */
        input[type="file"]::file-selector-button:active {
            background-color: #e5e7eb;
        }
@endsection
@section('content')
    <section class="forms-start">
        <a href="/">
            <div class="home"><i style="color: white" class="fa fa-home"></i><br>صفحه اصلی </div>
        </a>
        <form class="form-complete" action="{{ route('completeInfo', ['id' => session()->get('user')]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <label for="usrename">نام خود را به انگلیسی یا فارسی بنویسید</label>
            <input type="text" id="name" name="name" placeholder="فقط شامل حروف فارسی یا انگلیسی" />
            <label for="usrename">یک عکس کم حجم برای پروفایل خود آپلود کنید:</label>
            <input type="file" id="pic" name="pic" />
            <input type="submit" value="ارسال" />
        </form>
    </section>
@endsection

@section('scripts')
    <script>
        $('.login-regester').css('box-shadow', '0px 8px 5px rgb(122 122 122)');
    </script>
    @if (session('completeError'))
        <script !src="">
            alertEore('اطلاعات را صحیح وارد کنید')
        </script>
    @endif
@endsection
