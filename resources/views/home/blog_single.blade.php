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
                <div class="row">
                    <div class="col-lg-8 col-12">
                        <div class="tm-blog tm-blog-details sticky-sidebar">
                            <div class="tm-blog-imageslider tm-slider-arrow tm-slider-dots">
                                @foreach($blog->images as $image)
                                    <img src="{{asset('blog_photos')}}/{{$image->file }}" id="previewImg"
                                         alt="Partner Image">
                                @endforeach
                            </div>
                            <div class="tm-blog-content">
                                <div class="tm-blog-meta">
                                    <span><i class="fa fa-user-o"></i>توسط<a
                                            href="blog.html">  {{$blog->writerBlog->name}} {{$blog->writerBlog->family}} </a></span>
                                    <span><i class="fa fa-calendar-o"></i>{{$blog->created_at->toDateString()}}</span>

                                </div>
                                <h3>{{$blog->title}}</h3>
                                {!! $blog->body !!}
                            </div>
                            <div class="tm-blog-tags">
                                    <span class="tm-blog-tags-title">
                                        <i class="fa fa-tags"></i>
                                    </span>
                                <ul>
                                    @foreach($blog->tag as $tag)
                                        <li><a href="blog.html">{{$tag->title}}</a></li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="widgets sidebar-widgets sticky-sidebar">

                            <!-- Single Widget -->
                            <div class="single-widget widget-search">
                                <h5 class="widget-title">جستجو</h5>
                                <form action="#" class="widget-search-form">
                                    <input type="text" placeholder="جستجوی...">
                                    <button type="submit"><i class="fa fa-search"></i></button>
                                </form>
                            </div>
                            <!--// Single Widget -->

                            <!-- Single Widget -->
                            <div class="single-widget widget-tags">
                                <h5 class="widget-title">دسته بندی ها</h5>
                                <ul>
                                    @foreach($tags as $tag)
                                        <li><a href="blog.html">{{$tag->title}}</a></li>
                                    @endforeach

                                </ul>
                            </div>
                            <!--// Single Widget -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--// Blogs Area -->


    </main>
    <!--// Main Content -->
    <!--// Main Content -->
@endsection
@section('js')
    @include('sweetalert::alert')

@endsection


