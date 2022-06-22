@extends('layouts.panel')
@section('css')
@endsection
@section('content')
    <main class="main-content">

        <div class="container-fluid">
            <!-- begin::page header -->
            <div class="page-header">
                <div>
                    <h3>وبلاگ</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/panel/home">داشبورد</a></li>
                            <li class="breadcrumb-item active" aria-current="page">وبلاگ</li>
                        </ol>
                    </nav>
                </div>

            </div>
            <!-- end::page header -->
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h5>لیست وبلاگ</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr style="text-align: center">
                                <th>عنوان</th>
                                <th>توضیح کوتاه</th>
                                <th>نویسنده</th>
                                <th>ارسال کننده</th>
                                <th>توضیحات</th>
                                <th>تصاویر</th>
                                <th>تگ ها</th>
                                <th>ویرایش</th>
                                <th>حذف</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rows as $row)
                                <tr style="text-align: center">
                                    <td>{{$row->title}}</td>
                                    <td>{{$row->little_body}}</td>
                                    <td>{{$row->writerBlog->name}} {{$row->writerBlog->family}}</td>
                                    <td>{{$row->authorBlog->name}} {{$row->authorBlog->family}}</td>
                                    <td>{!! $row->body !!}</td>
                                    <td>
                                        @foreach($row->images as $image)
                                            <img src="{{asset('blog_photos')}}/{{$image->file }}" id="previewImg"
                                                 alt="Partner Image">

                                            <x-destroy :id="$image->id" url="'/panel/deleteImage'"/>
                                            &nbsp;
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($row->tag as $tag)
                                            <span>{{$tag->title}}</span> &nbsp;
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="/panel/home/blog/{{$row->id}}/edit">
                                            <button class="btn btn-success btn-sm" title="ویرایش">
                                                <i class="icon ti-pencil"></i>
                                            </button>
                                        </a>

                                    </td>
                                    <td>
                                        <x-destroy :id="$row->id" url="'/panel/home/blog/deleteBlog'"/>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>

        </div>
        {{ $rows->links() }}
    </main>
@endsection
@section('js')

    <script src="/js/sweet.js"></script>

    @include('sweetalert::alert')
@endsection


