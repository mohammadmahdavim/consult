@extends('layouts.home')
@section('css')
@endsection
@section('content')
    <!-- Main Content -->
    <!-- Main Content -->
    <main class="main-content">

        <!-- Blogs Area -->
        <div class="tm-section services-area bg-grey tm-padding-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-6 col-lg-7 col-md-10 col-12">
                        <div class="tm-section-title text-center">
                            <h2>خدمات ما</h2>
                            <span class="divider"><i class="fa fa-superpowers"></i></span>
                            <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک
                                است. چاپگرها و متون بلکه روزنامه و مجله </p>
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
        <!--// Blogs Area -->
    </main>
    <!--// Main Content -->
@endsection
@section('js')
    @include('sweetalert::alert')

@endsection


