@extends('layouts.home')
@section('css')
@endsection
@section('content')
    <!-- Main Content -->
    <!-- Main Content -->
    <main class="main-content">

        <!-- Blogs Area -->
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

                <div class="tm-section portfolios-area bg-white tm-padding-section">
                    <div class="container">
                        <div class="tm-portfolio-buttons text-center">
                            <button data-filter="*" class="is-active">همه</button>
                            <button data-filter=".1">برتر تجربی</button>
                            <button data-filter=".2">برتر ریاضی</button>
                            <button data-filter=".3">برتر انسانی</button>
                            <button data-filter=".4">برتر هنر</button>
                        </div>
                        <div class="row tm-portfolio-wrapper mt-30-reverse">
                            @foreach($consults as $consult)
                                <div
                                    class="col-lg-4 col-md-6 col-12 tm-portfolio-item {{$consult->field_school_id}} portfolio-filter-financial portfolio-filter-careative portfolio-filter-technology">
                                    <div class="tm-portfolio mt-30 wow fadeInUp">

                                        <div class="tm-portfolio-content">

                                            <div class="tm-blog-imageslider tm-slider-arrow tm-slider-dots">
                                                @if($consult->user->images)
                                                    @foreach($consult->user->images as $image)
                                                        <a href="/home/contact_us/{{$consult->user->id}}"
                                                           class="blogitem-imageslider-image">
                                                            <img class="rounded" src="{{asset('user_photos')}}/{{$image->file }}"
                                                                 alt="blog image"
                                                                 height="300" width="210">
                                                        </a>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="tm-blog-content">
                                                <div class="tm-blog-meta">
                                        <span><i class="fa fa-user-o"></i><a
                                                href="/home/contact_us/{{$consult->user->id}}"> {{$consult->user->name}}  {{$consult->user->family}} </a></span>
                                                    <span><i class="fa fa-calendar-o"></i>ورودی {{$consult->year->title}}</span>

                                                </div>
                                                <h5>
                                                    <a href="//home/contact_us/{{$consult->user->id}}">{{$consult->university->title}}({{$consult->field->title}})</a>
                                                </h5>

                                            </div>


                                        </div>
                                    </div>
                                </div>

                        @endforeach
                        <!-- Portfolio Single -
                                <!--// Portfolio Single -->

                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!--// Blogs Area -->

    </main>
    <!--// Main Content -->
@endsection
@section('js')
    @include('sweetalert::alert')

@endsection


