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
    <!-- Heroslider -->
    <div class="heroslider">
        <div class="heroslider-slider heroslider-animted tm-slider-arrow">

            <!-- Heroslider Item -->
            @foreach($sliders as $slider)
                <div class="heroslider-wrapper">
                    @if($slider->images)
                        <div class="heroslider-single"
                             data-bgimage="{{asset('slider_photos')}}/{{$slider->images[0]->file}}"
                             data-black-overlay="8">
                            @endif
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-xl-8 col-lg-10">
                                        <div class="heroslider-content text-center">
                                            <div class="heroslider-animatebox">
                                                <h1>
                                                    <span>{{$slider->title}}</span>
                                                    <b>{{$slider->little_body}}</b>
                                                </h1>
                                            </div>
                                            <div class="heroslider-animatebox">
                                           <span style="color: red">
                                            {!! $slider->body !!}
                                           </span>
                                            </div>
                                            <div class="heroslider-animatebox">
                                                <div class="tm-buttongroup">
                                                    <a href="/home/contact_us" id="neonShadow" class="tm-button">درباره
                                                        ی ما<b></b></a>
                                                    <a href="/home/service" class="tm-button tm-button-white">خدمات
                                                        ما<b></b></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
        @endforeach
        <!--// Heroslider Item -->

        </div>
        <div class="heroslider-slidecounter"></div>
    </div>
    <!--// Heroslider -->

    <!-- Main -->
    <main class="page-content">

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
        <!--// About Us Area -->

        <!-- Services Area -->
        <div class="tm-section services-area bg-grey tm-padding-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-6 col-lg-7 col-md-10 col-12">
                        <div class="tm-section-title text-center">
                            <h2>خدمات ما</h2>
                            <span class="divider"><i class="fa fa-superpowers"></i></span>
                            <p>

                            </p>
                        </div>
                    </div>
                </div>
                <div class="row mt-30-reverse">

                    <!-- Single Service -->
                    @foreach($services as $service)
                        <div class="col-lg-4 col-md-6 col-12 mt-30">
                            <div class="tm-service text-center wow fadeInUp">

                                <span class="tm-service-icon">
                                    @if($service->images!='[]')

                                        <img src="{{asset('service_photos')}}/{{$service->images[0]->file }}"
                                             id="previewImg"
                                             alt="Partner Image">
                                    @endif
                                </span>
                                <div class="tm-service-content">
                                    <h5><a href="service-details.html">{{$service->title}}</a></h5>
                                    {{$service->little_body}}
                                </div>
                            </div>
                        </div>
                @endforeach
                <!--// Single Service -->


                </div>
            </div>
        </div>
        <!--// Services Area -->

        <!-- Request Callback Area -->
        <div class="tm-section callback-area bg-white tm-padding-section">
            <div class="container">
                <div class="row">
                    <form method="post" action="/home/contact/store">
                        @csrf
                        <div class="col-lg-10">
                            <div class="tm-callback">
                                <h2>ارتباط با ما</h2>
                                <p>
                                    شما می توانید اطلاعتتان را برای ما در اینجا وارد کنید تا در اسرع وقت با شما تماس
                                    گرفته شود.
                                </p>
                                <form action="#" class="tm-form">
                                    <div class="tm-form-inner">
                                        <div class="tm-form-field">
                                            <input type="text" name="name" placeholder="نام و نام خانوادگی*"
                                                   required="">
                                        </div>
                                        <div class="tm-form-field tm-form-fieldhalf">
                                            <input type="text" name="mobile" placeholder="شماره تماس*" required="">
                                        </div>
                                        <div class="tm-form-field tm-form-fieldhalf">
                                            <input type="text" name="national_code" placeholder="کد ملی">
                                        </div>
                                        <div class="tm-form-field tm-form-fieldhalf">
                                            <select class="form-control" name="field">
                                                @foreach($fields as $field)
                                                    <option value="{{$field->id}}">{{$field->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="tm-form-field tm-form-fieldhalf">
                                            <select class="form-control" name="paye">
                                                @foreach($payes as $paye)
                                                    <option value="{{$paye->id}}">{{$paye->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="tm-form-field">
                                            <button type="submit" class="tm-button">ثبت</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="d-flex flex-row">
                                <div class="p-2">شماره داخلی:
                                    3125-8451-021
                                </div>
                                <div class="p-2">
                                    <i class="fa fa-phone fa-3x">

                                    </i></div>
                            </div><br>
                            <div class="d-flex flex-row">
                                <div class="p-2">شماره واتساپ: 09210915874</div>
                                <div class="p-2">
                                    <i class="fa fa-whatsapp fa-3x"></i>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--// Request Callback Area -->

        <!-- Funfact Area -->
        <div class="tm-section funfact-area tm-padding-section tm-parallax"
             data-bgimage="/home/assets/images/bg/bg-image-1.jpg" data-overlay="9">
            <div class="container">
                <div class="row tm-funfact-wrapper">


                </div>
            </div>
        </div>
        <!--// Funfact Area -->

        <!-- Team Area -->
        <div class="tm-section blogs-area bg-white tm-padding-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-6 col-lg-7 col-md-10 col-12">
                        <div class="tm-section-title text-center">
                            <h2>مشاوران ما</h2>
                            <span class="divider"><i class="fa fa-superpowers"></i></span>
                            <p style="font-size: large">
                                <b>
                                    مشاورین کانون برترها شامل رتبه های برتر کنکورهای 1397 تا 1400 هستند.
                                    <span style="font-size: x-large">
                                        <br>
                                        <br>
                                با برترها همراه باش و برتر شو
                                    </span>
                                </b>


                            </p>
                        </div>
                    </div>
                </div>
                <div class="row mt-30-reverse">

                    <!-- Single Service -->

                    <div class="col-lg-3 col-md-6 col-12 mt-30">
                        <div class="tm-service text-center wow fadeInUp">
                            <a href="/home/consultSingle/1">
                                <span class="tm-service-icon">


                                        <img src="/images/taj.jpg"
                                             id="previewImg"
                                             alt="Partner Image">

                                </span>
                            </a>
                            <div class="tm-service-content">
                                <h5><a href="/home/consultSingle/1">مشاوران تجربی</a></h5>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12 mt-30">
                        <div class="tm-service text-center wow fadeInUp">
                            <a href="/home/consultSingle/2">
                                <span class="tm-service-icon">


                                        <img src="/images/re.jpg"
                                             id="previewImg"
                                             alt="Partner Image">

                                </span>
                            </a>
                            <div class="tm-service-content">
                                <h5><a href="/home/consultSingle/2">مشاوران ریاضی</a></h5>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12 mt-30">
                        <div class="tm-service text-center wow fadeInUp">
                            <a href="/home/consultSingle/3">
                                <span class="tm-service-icon">
                                        <img src="/images/en.jpg"
                                             id="previewImg"
                                             alt="Partner Image">
                                </span>
                            </a>
                            <div class="tm-service-content">
                                <h5><a href="/home/consultSingle/3">مشاوران انسانی</a></h5>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12 mt-30">
                        <div class="tm-service text-center wow fadeInUp">
                            <a href="/home/consultSingle/4">
                                <span class="tm-service-icon">


                                        <img src="/images/honar.jpeg"
                                             id="previewImg"
                                             alt="Partner Image">

                                </span>
                            </a>
                            <div class="tm-service-content">
                                <h5><a href="/home/consultSingle/4">مشاوران هنر</a></h5>

                            </div>
                        </div>
                    </div>
                    <!--// Single Service -->


                </div>

                <!--// Single Blog -->
            </div>
        </div>

        <!--// Team Area -->

        <!-- Our Portfolios -->
        <!--// Our Portfolios -->

        <!-- Testimonial Area -->
        <div class="tm-section testimonial-area tm-padding-section tm-parallax" data-overlay="9"
             data-bgimage="/home/assets/images/bg/bg-image-2.jpg">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-6 col-lg-7 col-md-10 col-12">
                        <div class="tm-section-title tm-section-title-white text-center">
                            <h2>آنچه دانش آموزان می گویند</h2>
                            <span class="divider"><i class="fa fa-superpowers"></i></span>
                            <p>

                            </p>
                        </div>
                    </div>
                </div>
                <div class="row testimonial-slider-active">

                    <!-- Testimonial -->
                    <div class="col-lg-6">
                        <div class="tm-testimonial">
                            <div class="tm-testimonial-content">
                                <i class="fa fa-quote-left"></i>
                                <p>
                                </p>
                            </div>
                            <div class="tm-testimonial-bottom">
                                <div class="tm-testimonial-authorimage">
                                    <img src="/home/assets/images/authors/author-image-4.jpg" alt="author image">
                                </div>
                                <div class="tm-testimonial-authorcontent">
                                    <h5>سیسیلیا ماس</h5>
                                    <p>رهبر تیم</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--// Testimonial -->

                    <!-- Testimonial -->
                    <div class="col-lg-6">
                        <div class="tm-testimonial">
                            <div class="tm-testimonial-content">
                                <i class="fa fa-quote-left"></i>
                                <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان
                                    گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و</p>
                            </div>
                            <div class="tm-testimonial-bottom">
                                <div class="tm-testimonial-authorimage">
                                    <img src="/home/assets/images/authors/author-image-3.jpg" alt="author image">
                                </div>
                                <div class="tm-testimonial-authorcontent">
                                    <h5>سیسیلیا ماس</h5>
                                    <p>رهبر تیم</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--// Testimonial -->

                    <!-- Testimonial -->
                    <div class="col-lg-6">
                        <div class="tm-testimonial">
                            <div class="tm-testimonial-content">
                                <i class="fa fa-quote-left"></i>
                                <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان
                                    گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و
                                    برای شرایط فعل</p>
                            </div>
                            <div class="tm-testimonial-bottom">
                                <div class="tm-testimonial-authorimage">
                                    <img src="/home/assets/images/authors/author-image-2.jpg" alt="author image">
                                </div>
                                <div class="tm-testimonial-authorcontent">
                                    <h5>سیسیلیا ماس</h5>
                                    <p>رهبر تیم</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--// Testimonial -->

                </div>
            </div>
        </div>
        <!--// Testimonial Area -->

        <!-- Blogs Area -->
        <div class="tm-section blogs-area bg-white tm-padding-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-6 col-lg-7 col-md-10 col-12">
                        <div class="tm-section-title text-center">
                            <h2>آخرین مطالب</h2>
                            <span class="divider"><i class="fa fa-superpowers"></i></span>
                            <p>

                            </p>
                        </div>
                    </div>
                </div>
                <div class="blog-slider-active tm-slider-arrow tm-slider-arrow-hovervisible">
                    <!-- Single Blog -->
                    @foreach($blogs as $blog)
                        <div class="blog-slider-item">
                            <div class="tm-blog wow fadeInUp">
                                <div class="tm-blog-imageslider tm-slider-arrow tm-slider-dots">
                                    @foreach($blog->images as $image)
                                        <img src="{{asset('blog_photos')}}/{{$image->file }}" id="previewImg"
                                             alt="Partner Image">
                                    @endforeach
                                </div>
                                <div class="tm-blog-content">
                                    <div class="tm-blog-meta">
                                        <span><i class="fa fa-user-o"></i>توسط<a
                                                href="blog.html"> {{$blog->writerBlog->name}} {{$blog->writerBlog->family}} </a></span>
                                        <span><i
                                                class="fa fa-calendar-o"></i>{{$blog->created_at->toDateString()}}</span>
                                    </div>
                                    <h5><a href="blog-details-gallery.html">{{$blog->little_body}}</a></h5>
                                    {!!  \Illuminate\Support\Str::limit($blog->body, 80); !!}
                                    <br>
                                    <a href="blog-details-gallery.html" class="tm-readmore">ادامه مطلب...</a>
                                </div>
                            </div>
                        </div>
                @endforeach
                <!--// Single Blog -->
                </div>
            </div>
        </div>
        <!--// Blogs Area -->

        <!-- Brandlogo Area -->
        <!--// Brandlogo Area -->

        <!-- Call To Action Area -->
        <div class="tm-section call-to-action-area bg-theme">
            <div class="container">
                <div class="row align-items-center tm-cta">
                    <div class="col-lg-9 col-md-8 col-12">
                        <div class="tm-cta-content">
                            <h3>آیا نگران مشاور خوب هستید؟</h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-12">
                        <div class="tm-cta-button">
                            <a href="/home/contact_us" class="tm-button tm-button-white">تماس با ما<b></b></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--// Call To Action Area -->

    </main>
    <!--// Main -->

@endsection
@section('js')
    @include('sweetalert::alert')
@endsection


