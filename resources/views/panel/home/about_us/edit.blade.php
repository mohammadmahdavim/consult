@extends('layouts.panel')
@section('css')
@endsection
@section('content')
    <main class="main-content">

        <div class="container-fluid">

            <!-- begin::page header -->
            <div class="page-header">
                <div>
                    <h3>ویرایش درباره ما </h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/panel/home">داشبورد</a></li>
                            <li class="breadcrumb-item active" aria-current="page">ویرایش درباره ما</li>
                        </ol>
                    </nav>
                </div>

            </div>
            <!-- end::page header -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">ویرایش درباره ما </h5>
                            <form action="/panel/home/about_us/{{$row->id}}" class="needs-validation" novalidate
                                  method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                @include('errors')
                                <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                        <label for="title">عنوان</label>
                                        <input type="text" class="form-control" id="title" name="title"
                                               placeholder="عنوان" required value="{{$row->title}}">
                                        <div class="valid-tooltip">
                                            صحیح است!
                                        </div>
                                    </div>


                                </div>
                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                        <label for="file">تصویر</label>
                                        <input type="file" class="form-control" id="file" name="file[]" multiple>
                                        <br>
                                        @foreach($row->images as $image)
                                            <img src="{{asset('about_us_photos')}}/{{$image->file }}" id="previewImg"
                                                 alt="Partner Image">

                                            <x-destroy :id="$row->id" url="'panel/image/destroy'"/>
                                            &nbsp;
                                        @endforeach
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                        <label for="body">توضیحات</label>
                                        <textarea name="body" id="editor-demo1" required>

                                            {!! $row->body !!}
                                        </textarea>

                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit">ثبت فرم</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
@section('js')
    @include('sweetalert::alert')
    <script src="/panel/assets/vendors/ckeditor/ckeditor.js"></script>
    <script src="/panel/assets/js/examples/ckeditor.js"></script>
@endsection


