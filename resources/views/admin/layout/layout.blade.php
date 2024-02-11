<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="img/favicon.html">

    <title>atisoo Admin</title>
    <link href="/admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="/admin/css/bootstrap-reset.css" rel="stylesheet">
    <link href="/admin/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/admin/css/style.css') }}?t={{ time() }}" />
    <link href="/admin/css/style-responsive.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css" rel="stylesheet" />
    @yield('css')
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    @php
        $admin = \App\Models\admin::find(session()->get('admin'))->first();
    @endphp
    <div class="ask-online">
        <p>شما انلاین نیستسد می خواهید خود را انلاین کنید</p>
        <div>
            <button class="btn set-ofline">کنسل</button>
            <button class="btn set-online">انلاین شدن</button>
        </div>
    </div>
    <div class="conf-cont">
        <p>ایا از انجام این عملیات مطمعن هستید</p>
        <div>
            <button class="cancel btn-danger">کنسل</button>
            <button class="submit btn-success">مطمعن</button>
        </div>
    </div>
    <section id="container" class="">
        <!--header start-->
        <header class="header white-bg">
            <div class="sidebar-toggle-box">
                <div class="icon-reorder tooltips"></div>
            </div>
            <div class="top-nav">
                <ul class="nav pull-right top-menu">
                    <li class="dropdown" style="margin: 14px 0 0 0;display: flex">
                        <a href="{{ route('logoutAdmin') }}"><i class="icon-key"></i> خروج</a>
                        @if (session()->get('onlin') == 0)
                            <button onclick="set_online()" class="btn btn-danger set-online">شما افلاین هستید</button>
                        @else
                            <button onclick="set_ofline()" class="btn btn-success set-ofline">شما انلاین هستید</button>
                        @endif

                    </li>
                </ul>
            </div>
        </header>
        <aside>
            <div id="sidebar" class="nav-collapse ">
                <!-- sidebar menu start-->
                <ul class="sidebar-menu">
                    <li class="">
                        <a href="{{ route('chatlist') }}">
                            <i class="icon-comments-alt"></i>
                            <span>چت با کابران</span>
                        </a>
                    </li>
                    @if (session()->get('level') <= 2)
                        <li class="sub-menu">
                            <a href="#" class="">
                                <i class="icon-suitcase"></i>
                                <span>ریست رمز DVR NVR</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub">
                                <li><a class="" href="{{ route('resetDevicelist') }}">لیست موارد</a></li>
                                <li><a class="" href="{{ route('resetDevicelistAddV') }}">اضافه کردن مورد</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="#" class="">
                                <i class="icon-suitcase"></i>
                                <span>پکیج های اموزشی </span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub">
                                <li><a class="" href="{{ route('packegelist') }}">لیست موارد</a></li>
                                <li><a class="" href="{{ route('packegeUpdatAddV') }}">اضافه کردن مورد</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="#" class="">
                                <i class="icon-suitcase"></i>
                                <span>ریست رمز camera</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub">
                                <li><a class="" href="{{ route('resetCamlist') }}">لیست موارد</a></li>
                                <li><a class="" href="{{ route('resetCamUpdatAddV') }}">اضافه کردن مورد</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="#">
                                <i class="icon-suitcase"></i>
                                <span>لیست فایل های اپدیت</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub">
                                <li><a class="" href="{{ route('fileUpdateList') }}">لیست موارد</a></li>
                                <li><a class="" href="{{ route('loadFileUpdate') }}">اضافه کردن</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="#" class="">
                                <i class="icon-suitcase"></i>
                                <span>کاتالوگ ها</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub">
                                <li><a class="" href="{{ route('kataloglist') }}">لیست موارد</a></li>
                                <li><a class="" href="{{ route('katalogUpdatAddV') }}">اضافه کردن مورد</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="#">
                                <i class="icon-suitcase"></i>
                                <span>لیست فایل ها</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub">
                                <li><a class="" href="{{ route('flashList') }}">لیست موارد</a></li>
                                <li><a class="" href="{{ route('loadFlash') }}">اضافه کردن</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="#" class="">
                                <i class="icon-suitcase"></i>
                                <span>خرید از شما</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub">
                                <li><a class="" href="{{ route('byForYouList') }}">لیست موارد</a></li>
                                <li><a class="" href="{{ route('byForYouInsertViwe') }}">اضافه کردن مورد</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="#" class="">
                                <i class="icon-suitcase"></i>
                                <span> خرید از شما(اپدیت)</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub">
                                <li><a class="" href="{{ route('byForYouUpdateFileList') }}">لیست موارد</a>
                                </li>
                                <li><a class="" href="{{ route('byForYouUpdateFileInsertViwe') }}">اضافه کردن
                                        مورد</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="#" class="">
                                <i class="icon-suitcase"></i>
                                <span>همکاری با ما</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub">
                                <li><a class="" href="{{ route('cooperatelist') }}">لیست موارد</a></li>
                                <li><a class="" href="{{ route('cooperateUpdatAddV') }}">اضافه کردن مورد</a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    @if (session()->get('level') <= 1)
                        <li class="">
                            <a class="" href="{{ route('userList') }}">
                                <i class="icon-user"></i>
                                <span>لیست کاربران</span>
                            </a>
                        </li>
                        <li class="sub-menu">
                            <a href="#">
                                <i class="icon-user"></i>
                                <span>ادمین ها</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub">
                                <li><a class="" href="{{ route('adminList') }}">لیست ادمین</a></li>
                                <li><a class="" href="{{ route('adminAddV') }}">اضافه کردن</a></li>
                            </ul>
                        </li>
                        <li class="">
                            <a href="{{ route('commentList') }}">
                                <i class="icon-comment"></i>
                                <span>اخرین کامنت ها</span>
                            </a>
                        </li>

                        <li class="">
                            <a href="{{ route('infoVwie') }}">
                                <i class="icon-info"></i>
                                <span>اطلاعات وب سایت</span>
                            </a>
                        </li>
                        <li class="">
                            <a class="" href="/dashbord">
                                <i class="icon-inbox"></i>
                                <span>تعیر قیمت</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </aside>
        <section id="main-content">
            <section class="wrapper">
                @yield('content')
            </section>
        </section>
    </section>
</body>





</html>
<script src='/admin/js/jquery.js'></script>
<script src={{ asset('/admin/js/script.js') }}?t={{ time() }}></script>
<script src={{ asset('/flash/js/function.js') }}?t={{ time() }}></script>
@yield('js')
<script>
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    function set_online() {
        $.ajax({
            type: "post",
            url: "/dashbord/setOnline ",
            success: function(response) {
                $(".ask-online").animate({
                    "margin-top": "-700px",
                });
                $(".dropdown button").remove();
                $(".dropdown").append(
                    `<button onclick="set_ofline()" class="btn btn-success set-ofline">شما انلاین هستید</button>`
                );
            },
        });
    }

    function set_ofline() {
        $.ajax({
            type: "post",
            url: "/dashbord/setOfline ",
            success: function(response) {
                $(".ask-online").animate({
                    "margin-top": "-700px",
                });
                $(".dropdown button").remove();
                $(".dropdown").append(
                    `<button onclick="set_online()" class="btn btn-danger set-online">شما افلاین هستید</button>`
                );
            },
        });
    }
</script>
