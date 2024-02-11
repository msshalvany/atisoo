@extends('flash.layout.layout')
@section('title')
    ثبت نام
@endsection
@section('css')
    <style>
        

        .forms-start form {

            height: 220px !important;

        }
    </style>
@endsection
@section('content')
    <section class="forms-start">
        
        <div class="eroore">شما خطا دارید</div>
        <div class="sucses">بلیت شما رزرو شد</div>
        <form class="form-1" action="">
            <label for="usrename">شماره همراه خود را وارد کنید :</label>
            <input type="text" id="phon" name="phon" placeholder="مثال : 09131572450" />
            <input type="submit" value="ارسال" />
        </form>
        <form class="form-2" action="">
            <label for="code">کد SMS شده را وارد کنید:</label>
            <input type="text" id="code" name="code" />
            <input type="submit" value="ارسال" />
        </form>
        <form class="form-3" action="">
            <label for="time"> یک رمز عبور برای خود انتخاب کنید :</label>
            <input type="text" id="password" name="password" />
            <label for="time" class="text-danger mt-2"> اگر معرف دارید شماره او را وارد کنید (دلخواه):</label>
            <input type="text" id="invidPhon" name="invidPhon" />
            <input class="mt-1" id="send" type="submit" value="ارسال" />
        </form>
    </section>
@endsection

@section('scripts')
    <script>
        $('.login-regester').css('box-shadow', '0px 8px 5px rgb(122 122 122)');
    </script>
@endsection
