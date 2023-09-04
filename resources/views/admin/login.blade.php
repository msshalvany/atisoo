<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="img/favicon.html">

    <title>FlatLab - Flat & Responsive Bootstrap Admin Template</title>

    <!-- Bootstrap core CSS -->
    <link href="/admin/css/bootstrap.min.css" rel="stylesheet">
    <!--external css-->
    <link href="/admin/assets/font-awesome/css/font-awesome.css" rel="stylesheet"/>
    <!-- Custom styles for this template -->
    <link href="/admin/css/style.css" rel="stylesheet">
    <script src="/flash/js/jquery.js"></script>
    <script src="/flash/js/function.js"></script>
</head>

<body class="login-body">

<div class="container">
    <form class="form-signin" action="{{ route('loginAdmin') }}" method="post">
        @csrf
        <h2 class="form-signin-heading">همین حالا وارد شوید</h2>
        <div class="login-wrap">
            <input type="text" class="form-control" autocomplete="off" placeholder="نام کاربری" name="username"
                   autofocus>
            <input type="password" class="form-control" name="password" placeholder="کلمه عبور">
            <label class="checkbox">
                <input type="checkbox" value="remember-me"> مرا به خاطر بسپار
            </label>
            <button class="btn btn-lg btn-login btn-block" type="submit" name="btn">ورود</button>
        </div>
        @if(session('eroore'))
            <script>
                alertEore('نام کاربری یا رمز اشتباه است')
            </script>
        @endif
    </form>

</div>
</body>
</html>



