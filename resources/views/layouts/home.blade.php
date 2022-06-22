<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>مشاوره برترها</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" href="/home/assets/images/favicon.png">
    <link rel="shortcut icon" href="/home/assets/images/favicon.ico">
    <link rel="stylesheet" href="/home/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/home/assets/css/plugins.css">
    <link rel="stylesheet" href="/home/assets/css/style.css">
    <link rel="stylesheet" href="/home/assets/css/custom.css">
</head>
@yield('css')

<body>

<!-- Preloader -->
<div class="tm-preloader">
    <span class="tm-preloader-box"></span>
    <button class="tm-button tm-button-sm tm-button-white">لغو پیش بارگیری<b></b></button>
</div>
<!--// Preloader -->

<!-- Wrapper -->
<div id="wrapper" class="wrapper">

    <!-- Header -->
    <div class="header sticky-header">

    @include('include.home.header')
    <!-- Header Top Area -->
        <!--// Header Top Area -->

        <!-- Header Bottom Area -->
        <!--// Header Bottom Area -->
        @include('include.home.menu')
    </div>
    <!--// Header -->
    <!-- content -->

@yield('content')
<!--// content -->


    <!-- Footer Area -->
@include('include.home.footer')

<!--// Footer Area -->
    <!-- Login Register Popup -->
    <div class="tm-loginregister-popup modal fade" id="tm-loginregister-popup" role="dialog" aria-hidden="true">
        <div class="container">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="row justify-content-center">
                        <div class="col-xl-8 col-lg-9 col-md-10 col-sm-10 col-12">
                            <div class="tm-loginregister">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <i class="fa fa-times"></i>
                                </button>
                                <ul class="nav tm-tabgroup" id="bstab1" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="bstab1-area1-tab" data-toggle="tab"
                                           href="#bstab1-area1" role="tab" aria-controls="bstab1-area1"
                                           aria-selected="true">ورود</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="bstab1-area2-tab" data-toggle="tab" href="#bstab1-area2"
                                           role="tab" aria-controls="bstab1-area2" aria-selected="false">ثبت نام</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="bstab1-ontent">
                                    <div class="tab-pane fade show active" id="bstab1-area1" role="tabpanel"
                                         aria-labelledby="bstab1-area1-tab">

                                        <form action="#" class="tm-form tm-login-form tm-form-bordered">
                                            <h4>ورود</h4>
                                            <div class="tm-form-inner">
                                                <div class="tm-form-field">
                                                    <label for="login-email">نام کاربری یا آدرس ایمیل *</label>
                                                    <input type="email" id="login-email" required="required">
                                                </div>
                                                <div class="tm-form-field">
                                                    <label for="login-password">کلمه عبور*</label>
                                                    <input type="password" id="login-password" required="required">
                                                </div>
                                                <div class="tm-form-field">
                                                    <input type="checkbox" name="login-remember" id="login-remember">
                                                    <label for="login-remember">مرا به خاطر بسپار</label>
                                                </div>
                                                <div class="tm-form-field">
                                                    <button type="submit" class="tm-button">ورود<b></b></button>
                                                </div>
                                                <div class="tm-form-field">
                                                    <a href="#">رمز عبور خود را فراموش کرده اید؟</a>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                    <div class="tab-pane fade" id="bstab1-area2" role="tabpanel"
                                         aria-labelledby="bstab1-area2-tab">

                                        <form action="#" class="tm-form tm-register-form tm-form-bordered">
                                            <h4>ایجاد یک حساب کاربری</h4>
                                            <div class="tm-form-inner">
                                                <div class="tm-form-field">
                                                    <label for="register-username">نام کاربری</label>
                                                    <input type="text" id="register-username" required="required">
                                                </div>
                                                <div class="tm-form-field">
                                                    <label for="register-email">آدرس ایمیل</label>
                                                    <input type="email" id="register-email" required="required">
                                                </div>
                                                <div class="tm-form-field">
                                                    <label for="register-password">رمز عبور</label>
                                                    <input type="password" id="register-password" required="required">
                                                </div>
                                                <div class="tm-form-field">
                                                    <input type="checkbox" id="register-terms">
                                                    <label for="register-terms">من شرایط و ضوابط سایت را خواند و موافق
                                                        هستم</label>
                                                </div>
                                                <div class="tm-form-field">
                                                    <button type="submit" class="tm-button">ثبت نام<b></b></button>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--// Login Register Popup -->
</div>
<!--// Wrapper -->

<!-- Js Files -->
<script src="/home/assets/js/modernizr-3.6.0.min.js"></script>
<script src="/home/assets/js/jquery.min.js"></script>
<script src="/home/assets/js/popper.min.js"></script>
<script src="/home/assets/js/bootstrap.min.js"></script>
<script src="/home/assets/js/plugins.js"></script>
<script src="/home/assets/js/chart.min.js"></script>
<script src="/home/assets/js/chart-active.js"></script>
<script src="/home/assets/js/main.js"></script>
<!---start GOFTINO code--->
<script type="text/javascript">
    !function(){var i="qMaeKQ",a=window,d=document;function g(){var g=d.createElement("script"),s="https://www.goftino.com/widget/"+i,l=localStorage.getItem("goftino_"+i);g.async=!0,g.src=l?s+"?o="+l:s;d.getElementsByTagName("head")[0].appendChild(g);}"complete"===d.readyState?g():a.attachEvent?a.attachEvent("onload",g):a.addEventListener("load",g,!1);}();
</script>
<!---end GOFTINO code--->
<!--// Js Files -->
@yield('js')
</body>

</html>
