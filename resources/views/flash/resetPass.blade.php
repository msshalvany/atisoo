@extends('flash.layout.layout')
@section('content')
    <section class="forms-start">
        <a href="/"><div class="home-btn"><i class="fa fa-home"></i><br>صفحه اصلی </div></a>
        <div class="eroore">شما خطا دارید</div>
        <div class="sucses">رمز عوض شد</div>
        <form class="forms-resetPass-1" action="">
            <label for="usrename">شماره همراه خود را وارد کنید:</label>
            <input type="text" id="phon" name="phon"  placeholder="مثال : 09131572450"/>
            <input type="submit" value="ارسال" />
        </form>
        <form class="forms-resetPass-2" action="">
            <label for="code">کد SMS شده را وارد کنید:</label>
            <input type="text" id="code" name="code" />
            <input type="submit" value="ارسال"  />
        </form>
        <form class="forms-resetPass-3" action="">
            <label for="time"> یک رمز عبور جدید انتخاب کنید :</label>
            <input type="text" id="password" name="password" />
            <input id="send" type="submit" value="ارسال" />
        </form>
    </section>
@endsection
