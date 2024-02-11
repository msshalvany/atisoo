@extends('flash.layout.layout')
@section('title')
    پنل کاربری
@endsection
@section('css')
    <style>
        .custom-file-upload {
            display: block;
            position: relative;
            width: 160px;
            height: 40px;
            border-radius: 25px;
            background-color: rgb(0, 89, 255);
            box-shadow: 0 4px 7px rgba(0, 0, 0, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            transition: transform .2s ease-out;
        }

        .custom-file-upload input {
            display: none
        }

        .stop-ajsx {
            display: none;
        }
    </style>
@endsection
@section('content')
    <div class="edit-user-con">
        <div>
            <img src="{{ $user->image }}" alt="ss">
        </div>
        <form style="border-bottom: 2px solid rgb(177, 177, 177)" class="chang-img-form pb-4"
            action="{{ route('editeUserImg', ['id' => session()->get('user')]) }}" enctype="multipart/form-data"
            method="POST">
            @csrf
            <div style="width: unset;">
                <label class="custom-file-upload">
                    <input name="image" type="file" class="chang-img-user" />
                    تغییر عکس
                </label>
            </div>
        </form>
        <form>
            @csrf
            <div style="border-bottom: 2px solid rgb(177, 177, 177)" class="pb-5">
                <div class="showPaneldiscount" style="width: unset;">
                    <p>تخفیف شما : {{ $user->discount }} هزار تومان</p>
                </div>
                <div class="showPanelScore" style="width: unset;">
                    <p>امتیاز شما : {{ $user->score }}</p>
                </div>
                <div class="changScorDisc blue-btn">تبدیل امتیاز به تخفیف</div>
                <div>به ازای هر نفری که در هنگام ثبت نام ، شماره همراه شما رو به عنوان کد معرف بزنه = یک امتیاز بگیرید</div>
            </div>
        </form>
        <form action="{{ route('checkFrind') }}" method="POST">
            @csrf
            <div style="border-bottom: 2px solid rgb(177, 177, 177)" class="pb-3">
                @if ($user->frind != 0)
                    <div class="p-1" style="background: yellow">
                        <label for="">حوضه فعالیت خود را مشخص کنید :( مخصوص همکاران)</label><br>
                        @php
                            $nas = strpos($user->frind, 'نصاب');
                            $fro = strpos($user->frind, 'فروشنده');
                            $ta = strpos($user->frind, 'تعمیرکار');
                        @endphp
                        نصب : <input type="checkbox" name="nas" value="نصاب"
                            @if ($nas) checked @endif>
                        فروشنده : <input type="checkbox" name="fro" value="فروشنده"
                            @if ($fro) checked @endif>
                        تعمیرکار : <input type="checkbox" name="ta" value="تعمیرکار"
                            @if ($ta) checked @endif>   
                        <button class="blue-btn w-100 mt-2 send-coede-frind">تایید</button><br><br>
                    </div>
                @else
                    <div class="bg-warning p-1">
                        <label for="">اگر در حوضه سیستم های امنیتی هستید کد شناسایی همکاری دریافت شده را وارد کنید:</label><br>
                        <div>
                            <input name="code" type="text"><br><br>
                            <button class="blue-btn w-100 send-coede-frind">ثبت کد</button><br><br>
                        </div>
                        نصب : <input type="checkbox" value="نصاب" disabled>
                        فروشنده : <input type="checkbox" value="فروشنده" disabled>
                        تعمیرکار : <input type="checkbox" value="تعمیرکار" disabled>
                    </div>
                @endif
            </div>
        </form>
        <form action="{{ route('editeUserInfo', ['id' => session()->get('user')]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div>
                <label for="">نام شما : </label><br>
                <input name="name" type="text" value="{{ $user->name }}">
            </div><br>
            <div>
                <label for=""> استان شما : </label><br>
                <select class="selectcity" name="city" id="">
                    <option value="">استان را انتخاب کنید</option>
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
            </div>

            <div>
                <label for="">نام شرکت یا مغازه : ( دلخواه )</label><br>
                <input type="text" name="stor" value="{{ $user->stor }}">
            </div>
            <div>
                <label for="">توضیحات درباره کسب و کار شما : ( دلخواه )</label><br>
                <textarea name="discription" id="" style="width: 100%" rows="4">{{ $user->discription }}</textarea>
            </div>
            <input class="btn-panel" type="submit" value="تغییر اطلاعات">
        </form><br>
        <a style="text-align: center;text-decoration: underline" href="{{ route('logout') }}">LOG OUT</a>
    </div>
@endsection

@section('scripts')
    @if (session('completeError'))
        <script !src="">
            alertEore('اطلاعات را صحیح وارد کنید')
        </script>
    @endif
    <script>
        var item = '{{ $user->city }}'
        $(`.selectcity option[value=${item}]`).attr('selected', 'selected');
    </script>
    <script>
        $('.changScorDisc').click(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "{{ route('changScorDisc') }}",
                success: function(response) {
                    if (response == 'scoreErr') {
                        alertEore('امتیاز شما کافی نیست')
                    } else {
                        alertSucsses("عملیات موفق");
                        $('.showPaneldiscount').text(`تخفیف شما :  ${response} هزار تومان`);
                        $('.showPanelScore').text('امتیاز شما :  0');
                    }
                }
            });
        });
    </script>
    @error('name')
        <script>
            alertEore('نام خود را صحیح وارد کنید')
        </script>
    @enderror
    @error('city')
        <script>
            alertEore('شهر خود را صحیح وارد کنید')
        </script>
    @enderror
    <script>
        $('.chang-img-user').change(function(e) {
            e.preventDefault();
            $('.loead-wait-cin').css('display', 'flex');
            $('.chang-img-form').submit()
        });
    </script>
    @if (session('Nfrind'))
        <script>
            alertEore('کد اشتباه است ، برای گرفتن کد در قسمت چت با اپراتور پیام بدهید')
        </script>
    @endif
    @if (session('frind'))
        <script>
            alertSucsses('به عنوان همکار شناسایی شدید')
        </script>
    @endif
@endsection
