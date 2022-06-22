@extends('layouts.home')
@section('css')
    <style>
        * {
            padding: 0px;
            margin: 0px;
            box-sizing: border-box;
            outline: none;
        }

        #neonShadow {

            border: none;
            border-radius: 50px;
            transition: 0.3s;
            background-color: #b7b0e7;
            animation: glow 1s infinite;
            transition: 0.5s;
        }

        span:hover {
            transition: 0.3s;
            opacity: 1;
            font-weight: 700;
        }

        #neonShadow:hover {
            transform: translateX(-20px) rotate(30deg);
            border-radius: 5px;
            background-color: #04f5b1;
            transition: 0.5s;
        }

        @keyframes glow {
            0% {
                box-shadow: 5px 5px 20px rgb(93, 52, 168), -5px -5px 20px rgb(93, 52, 168);
            }

            50% {
                box-shadow: 5px 5px 20px rgb(81, 224, 210), -5px -5px 20px rgb(81, 224, 210)
            }
            100% {
                box-shadow: 5px 5px 20px rgb(93, 52, 168), -5px -5px 20px rgb(93, 52, 168)
            }
        }
    </style>
@endsection
@section('content')
    <main class="main-content">

        <!-- About Us Area -->
        <div class="tm-section about-us-area bg-white tm-padding-section">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-4">
                        <div class="tm-about-image">
                            <img class="wow fadeInLeft" style="padding-top: 100px"
                                 src="/home/assets/images/others/about.png"
                                 alt="deconsult image">
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-8">
                        <div class="tm-about-content">
                            <h2 id="neonShadow" style="text-align: center;color: #000000">
                                چرا کانون برترها ؟؟؟ <img src="/home/assets/images/logo/logo2.png" alt="deconsult logo">
                            </h2>
                            <span class="divider"><i class="fa fa-superpowers"></i></span>

                            <h4 style="text-align: center;color: #120da8">
                                <b> کانون برترها یک تیم واقعی کنارهم ـ یک دوست واقعی کنار تو
                                </b>
                            </h4>


                            <br>

                            <ul class="stylish-list">
                                <li style="font-size: x-large;color: #0d8d2d"><i class="fa fa-check-square-o"></i>

                                    <b>
                                        مشاوره با رتبه برتری که یک مشاور تمام عیار است

                                    </b>
                                </li>
                                <br>
                                <li style="font-size: x-large;color: #0b2e13"><i class="fa fa-check-square-o"></i>

                                    <b>

                                        برنامه ریزی درسی ، تحلیل کارنامه ، بازخورد عملکرد مداوم با مشاور
                                    </b>
                                </li>
                                <br>
                                <li style="font-size: x-large;color: #0d8d2d"
                                "><i class="fa fa-check-square-o"></i>
                                <b>
                                    مشاوره منابع و امکان رفع اشکال 24 ساعته با مشاور
                                </b>
                                </li>
                                <br>
                                <li style="font-size: x-large"><i class="fa fa-check-square-o"></i>
                                    <b>
                                        بانک تست و آزمونک هایی گزینش شده توسط رتبه های برتر
                                    </b>
                                </li>
                                <br>
                                <li style="font-size: x-large;color: #0d8d2d"
                                "><i class="fa fa-check-square-o"></i> <b>
                                    کلاس های نکته و تست و رفع اشکال
                                </b>
                                </li>
                                <br>
                                <li style="font-size: x-large"><i class="fa fa-check-square-o"></i> <b>همایش های رایگان
                                    </b>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('js')
    @include('sweetalert::alert')

@endsection


