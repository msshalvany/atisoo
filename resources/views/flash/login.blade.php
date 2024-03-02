@extends('flash.layout.layout')
@section('css')
@endsection
@section('content')
    <section class="forms-start">

        <form class="regester" action="{{ route('login') }}" method="post">
            @csrf
            <label for="phon">شماره همراه خود را وارد کنید :</label>
            <input type="text" class="phon" name="phon" placeholder="مثال : 09131572450">
            <label for="password">رمز خود را وارد کنید:</label>
            <input type="text" class="password" name="password" placeholder="حداقل 4 رقمی">
            <div>
                <label for="remember">مرا بخاطر بسپار</label>
                <input type="checkbox" name="remember" id="">
            </div>
            <a style="text-decoration: underline" href="{{ route('resePassVwie') }}">رمز عبور را فراموش کرده ام </a>
            <input type="submit" value="وارد شوید">
        </form>
    </section>
@endsection

@section('scripts')
    @if (session('erroreLogin'))
        @if (session('erroreLogin') == 'data')
            <script !src="">
                alertEore('اطلاعات را صحیح وارد کنید')
            </script>
        @endif
        @if (session('erroreLogin') == 'null')
            <script !src="">
                alertEore('رمز یا نام کاربری اشتباه است')
            </script>
        @endif
    @endif
    <script>
        $('.login-regester').css('box-shadow', '0px 8px 5px rgb(122 122 122)');
    </script>
@endsection
