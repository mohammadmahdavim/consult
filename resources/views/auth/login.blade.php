<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>قالب مدیریتی Gramos</title>

    <!-- begin::global styles -->
    <link rel="stylesheet" href="/panel/assets/vendors/bundle.css" type="text/css">
    <!-- end::global styles -->

    <!-- begin::custom styles -->
    <link rel="stylesheet" href="/panel/assets/css/app.css" type="text/css">
    <!-- end::custom styles -->

    <!-- begin::favicon -->
    <link rel="shortcut icon" href="/panel/assets/media/image/favicon.png">
    <!-- end::favicon -->

    <!-- begin::theme color -->
    <meta name="theme-color" content="#3f51b5"/>
    <!-- end::theme color -->

</head>
<body class="bg-white h-100-vh p-t-0">

<!-- begin::page loader-->
<div class="page-loader">
    <div class="spinner-border"></div>
    <span>در حال بارگذاری ...</span>
</div>
<!-- end::page loader -->

<div class="container h-100-vh">
    <div class="row align-items-center h-100-vh">
        <div class="col-lg-6 d-none d-lg-block p-t-b-25">
            <img class="img-fluid" src="/panel/assets/media/svg/login.svg" alt="...">
        </div>
        <div class="col-lg-4 offset-lg-1 p-t-b-25">
            <div class="d-flex align-items-center m-b-20">
                <img src="/panel/assets/media/image/dark-logo.png" class="m-l-15" width="40" alt="">
                <h3 class="m-0">مدیریت گراموس</h3>
            </div>
            <p>برای ادامه وارد شوید.</p>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                @include('errors')
                <div class="form-group mb-4">
                    <input type="text" class="form-control form-control-lg" name="national_code" id="exampleInputEmail1"
                           autofocus
                           placeholder="ایمیل یا نام کاربری">
                </div>
                <div class="form-group mb-4">
                    <input type="password" class="form-control form-control-lg" name="password"
                           id="exampleInputPassword1"
                           placeholder="رمز عبور">
                </div>
                <div class="form-group mb-4">
                  <select class="form-control" name="year">
                      <option value="consult">1402</option>
                      <option value="kanoonba_consult">1401</option>
                  </select>
                </div>
                <button type="submit" class="btn btn-primary btn-lg btn-block btn-uppercase mb-4">ورود</button>
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">به خاطر سپاری</label>
                    </div>
                    <a href="#" class="auth-link text-black">فراموشی رمز عبور؟</a>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <a href="" class="btn btn-outline-facebook btn-block">
                            <i class="fa fa-facebook-square m-l-5"></i> با فیسبوک
                        </a>
                    </div>
                    <div class="col-md-6 mb-4">
                        <a href="" class="btn btn-outline-google btn-block">
                            <i class="fa fa-google m-l-5"></i> با گوگل
                        </a>
                    </div>
                </div>
                <div class="text-center">
                    حسابی ندارید؟ <a href="register.html" class="text-primary">ایجاد</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- begin::global scripts -->
<script src="/panel/assets/vendors/bundle.js"></script>
<!-- end::global scripts -->

<!-- begin::custom scripts -->
<script src="/panel/assets/js/app.js"></script>
<!-- end::custom scripts -->

</body>
</html>
