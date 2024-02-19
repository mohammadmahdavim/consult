@extends('layouts.panel')
@section('css')
@endsection
@section('content')
    <main class="main-content">

        <div class="container-fluid">

            <!-- begin::page header -->
            <div class="page-header">
                <div>
                    <h3>ویرایش خدمت </h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/panel/home">داشبورد</a></li>
                            <li class="breadcrumb-item active" aria-current="page">ویرایش خدمت جدید</li>
                        </ol>
                    </nav>
                </div>

            </div>
            <!-- end::page header -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">ویرایش خدمت </h5>
                            <form action="/panel/home/service/{{$row->id}}" class="needs-validation" novalidate
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
                                    <div class="col-md-8 mb-3">
                                        <label for="little_body">توضیحات کوتاه</label>
                                        <input type="text" class="form-control" id="little_body" name="little_body"
                                               placeholder="توضیحات کوتاه" required value="{{$row->little_body}}">
                                        <div class="valid-tooltip">
                                            صحیح است!
                                        </div>
                                    </div>

                                </div>
                                <div class="form-row">
                                    <div class="col-md-3 mb-3">
                                        <label for="title">مبلغ</label>
                                        <input type="number" class="form-control" id="price" name="price"
                                               placeholder="مبلغ" required value="{{$row->price}}">
                                        <div class="valid-tooltip">
                                            صحیح است!
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="title">تعداد ماه</label>
                                        <input type="number" class="form-control" id="month" name="month"
                                               placeholder="تعداد ماه" required value="{{$row->month}}">
                                        <div class="valid-tooltip">
                                            صحیح است!
                                        </div>
                                    </div>
                                    <div class="col-md-9 mb-3">
                                        <label for="file">تصویر</label>
                                        <input type="file" class="form-control" id="file" name="file[]" multiple>
                                        <br>
                                        @foreach($row->images as $image)
                                            <img src="{{asset('service_photos')}}/{{$image->file }}" id="previewImg"
                                                 alt="Partner Image">

                                            <x-destroy :id="$image->id" url="'/panel/deleteImage'"/>
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


