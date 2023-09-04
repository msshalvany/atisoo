<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="img/favicon.html">

    <title>atisoo Admin</title>
    <link href="/admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="/admin/css/bootstrap-reset.css" rel="stylesheet">
    <link href="/admin/assets/font-awesome/css/font-awesome.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('/admin/css/style.css') }}?t={{ time() }}" />
    <link href="/admin/css/style-responsive.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css" rel="stylesheet"/>
    <script src="/admin/js/jquery.js"></script>
    <script src="/flash/js/function.js"></script>
    @yield('css')
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<section id="container" class="">
    <!--header start-->
    <header class="header white-bg">
        <div class="sidebar-toggle-box">
            <div class="icon-reorder tooltips"></div>
        </div>
        <div class="top-nav">
            <ul class="nav pull-right top-menu">
                <li class="dropdown" style="margin: 14px 0 0 0;">
                    <a href="{{route('logoutAdmin')}}"><i class="icon-key"></i> خروج</a>
                </li>
            </ul>
        </div>
    </header>
    <aside>
        <div id="sidebar" class="nav-collapse ">
            <!-- sidebar menu start-->
            <ul class="sidebar-menu">
                <li class="">
                    <a class="" href="/dashbord">
                        <i class="icon-inbox"></i>
                        <span>صفحه اصلی</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a  href="#">
                        <i class="icon-suitcase"></i>
                        <span>لیست فایل ها</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub">
                        <li><a class="" href="{{route('flashList')}}">لیست موارد</a></li>
                        <li><a class="" href="{{ route('loadFlash') }}">اضافه کردن</a></li>
                    </ul>
                </li>
                <li class="">
                    <a class="" href="{{route('userList')}}">
                        <i class="icon-user"></i>
                        <span>لیست کاربران</span>
                    </a>
                </li>
                <li class="">
                    <a href="{{route('infoVwie')}}">
                        <i class="icon-info"></i>
                        <span>اطلاعات وب سایت</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="#" class="">
                        <i class="icon-suitcase"></i>
                        <span>خرید از شما</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub">
                        <li><a class="" href="{{ route('byForYouList') }}">لیست موارد</a></li>
                        <li><a class="" href="{{ route('byForYouInsertViwe') }}">اضافه کردن مورد</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="#" class="">
                        <i class="icon-suitcase"></i>
                        <span>ریست رمز camera</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub">
                        <li><a class="" href="{{route('resetCamlist')}}">لیست موارد</a></li>
                        <li><a class="" href="{{ route('resetCamUpdatAddV') }}">اضافه کردن مورد</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="#" class="">
                        <i class="icon-suitcase"></i>
                        <span>ریست رمز DVR NVR</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub">
                        <li><a class="" href="{{route('resetDevicelist')}}">لیست موارد</a></li>
                        <li><a class="" href="{{ route('resetDevicelistAddV') }}">اضافه کردن مورد</a></li>
                    </ul>
                </li>
                <li class="">
                    <a href="{{route('commentList')}}">
                        <i class="icon-comment"></i>
                        <span>اخرین کامنت ها</span>
                    </a>
                </li>
                <li class="">
                    <a href="{{route('chatlist')}}">
                        <i class="icon-comments-alt"></i>
                        <span>چت با کابران</span>
                    </a>
                </li>
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
<script src={{ asset("/admin/js/script.js") }}></script>
