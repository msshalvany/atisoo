@extends('flash.layout.layout')
@section('content')
    <section class="propeganda">
        <h2>برای تبلیغات رایگان باید فرم زیر را پر کنید</h2>
        <form action="{{route('UserInfo')}}" class="info-form" method="post">
            @csrf
            <label for="">نام شما :</label>
            <input value="{{$user->name}}" type="text" name="name"/>
            <label for="">نام مغازه :</label>
            <input value="{{$user->stor}}" type="text" name="stor"/>
            <label for="">شهر کسب وکار شما : {{$user->city}}</label>
            <select name="city">
                <option value="0">استان را انتخاب کنید</option>
                <option value="آذربایجان شرقی">آذربایجان شرقی</option>
                <option value="آذربایجان غربی">آذربایجان غربی</option>
                <option value="اردبیل">اردبیل</option>
                <option value="اصفهان">اصفهان</option>
                <option value="البرز">البرز</option>
                <option value="ایلام">ایلام</option>
                <option value="بوشهر">بوشهر</option>
                <option value="تهران">تهران</option>
                <option value="چهارمحال بختیاری">چهارمحال بختیاری</option>
                <option value="خراسان جنوبی">خراسان جنوبی</option>
                <option value="خراسان رضوی">خراسان رضوی</option>
                <option value="خراسان شمالی">خراسان شمالی</option>
                <option value="خوزستان">خوزستان</option>
                <option value="زنجان">زنجان</option>
                <option value="سمنان">سمنان</option>
                <option value="سیستان و بلوچستان">سیستان و بلوچستان</option>
                <option value="فارس">فارس</option>
                <option value="قزوین">قزوین</option>
                <option value="قم">قم</option>
                <option value="کردستان">کردستان</option>
                <option value="کرمان">کرمان</option>
                <option value="کرمانشاه">کرمانشاه</option>
                <option value="کهکیلویه و بویراحمد">کهکیلویه و بویراحمد</option>
                <option value="گلستان">گلستان</option>
                <option value="گیلان">گیلان</option>
                <option value="لرستان">لرستان</option>
                <option value="مازندران">مازندران</option>
                <option value="مرکزی">مرکزی</option>
                <option value="هرمزگان">هرمزگان</option>
                <option value="همدان">همدان</option>
                <option value="یزد">یزد</option>
            </select>
            <label for="">توضیحات درباره ی خودتان : </label>
            <textarea name="discription" id=""> {{$user->discription}}</textarea>
            <input class="chang-info" type="submit" value="تغیر مشخصات"/>
        </form>
    </section>
    {{--    <div class="other-filter">--}}
    {{--        <form action="">--}}
    {{--            <label for="">نمایش بر اساس شهر : </label>--}}
    {{--            <select name="" id="">--}}
    {{--                <option value="">یزد</option>--}}
    {{--                <option value="">تهران</option>--}}
    {{--            </select>--}}
    {{--        </form>--}}
    {{--    </div>--}}
    <section class="other-people">
        <ul>
            @foreach($users as $item)
                <li>
                    <div class="name">
                        <span style="font-weight: bold">نام :</span>{{$item->name}}
                    </div>
                    <div class="name">
                        <span style="font-weight: bold">شهر :</span>{{$item->city}}
                    </div>
                    <div class="ahop-name">
                        <span style="font-weight: bold">نام مغازه :</span>{{$item->stor}}
                    </div>
                    <div class="phon">
                        <span style="font-weight: bold">شماره تماس :</span>{{$item->phon}}
                    </div>
                    <div class="dic">
                        {{$item->discription}}
                    </div>
                </li>
            @endforeach
        </ul>
    </section>
@endsection
