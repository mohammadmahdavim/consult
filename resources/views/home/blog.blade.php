@extends('layouts.home')
@section('css')
@endsection
@section('content')
    <!-- Main Content -->
    <main class="main-content">

        <!-- Blogs Area -->
        <div class="tm-section blogs-area bg-white tm-padding-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-12">
                        <div class="tm-blog-list sticky-sidebar">
                            <div class="row mt-30-reverse blog-masonry-active">

                                <!-- Single Blog -->
                                @foreach($blogs as $blog)
                                    <div class="col-lg-6 col-md-6 col-12 mt-30 blog-masonry-item">
                                        <div class="blog-slider-item">
                                            <div class="tm-blog wow fadeInUp">
                                                <div class="tm-blog-imageslider tm-slider-arrow tm-slider-dots">
                                                    @foreach($blog->images as $image)
                                                        <a href="blog-details-gallery.html"
                                                           class="blogitem-imageslider-image">
                                                            <img src="{{asset('blog_photos')}}/{{$image->file }}"
                                                                 alt="blog image">
                                                        </a>
                                                    @endforeach
                                                </div>
                                                <div class="tm-blog-content">
                                                    <div class="tm-blog-meta">
                                                    <span><i class="fa fa-user-o"></i>توسط<a
                                                            href="blog.html"> {{$blog->writerBlog->name}} {{$blog->writerBlog->family}} </a></span>
                                                        <span><i
                                                                class="fa fa-calendar-o"></i>{{$blog->created_at}}</span>
                                                    </div>
                                                    <h5><a href="blog-details-gallery.html">{{$blog->title}}</a>
                                                    </h5>
                                                    <p>{{$blog->little_body}}</p>
                                                    <a href="/home/blog/{{$blog->id}}" class="tm-readmore">ادامه
                                                        مطلب...</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            @endforeach
                            <!--// Single Blog -->
                            </div>

                            {{ $blogs->links() }}
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="widgets sidebar-widgets sticky-sidebar">

                            <!-- Single Widget -->
                            <div class="single-widget widget-search">
                                <h5 class="widget-title">جستجو</h5>
                                <form action="/home/search" class="widget-search-form">
                                    <input name="search" type="text" placeholder="جستجوی...">
                                    <button type="submit"><i class="fa fa-search"></i></button>
                                </form>
                            </div>
                            <!--// Single Widget -->

                            <!-- Single Widget -->
                            <div class="single-widget widget-tags">
                                <h5 class="widget-title">دسته بندی ها</h5>
                                <ul>
                                    @foreach($tags as $tag)
                                        <li><a href="/home/tagSearch/{{$tag->id}}">{{$tag->title}}</a></li>
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
@endsection
@section('js')
    @include('sweetalert::alert')

@endsection


