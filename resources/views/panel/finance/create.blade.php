@extends('layouts.panel')
@section('css')
    <link rel="stylesheet" href="/panel/assets/vendors/select2/css/select2.min.css" type="text/css">
@endsection
@section('content')
    <main class="main-content">

        <div class="container-fluid">

            <!-- begin::page header -->
            <div class="page-header">
                <div>
                    <h3>پرداخت جدید</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/panel/home">داشبورد</a></li>
                            <li class="breadcrumb-item active" aria-current="page">پرداخت جدید</li>
                        </ol>
                    </nav>
                </div>

            </div>
            <!-- end::page header -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">پرداخت جدید</h5>
                            <form action="/panel/finance" class="needs-validation" novalidate method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                @include('errors')
                                <input name="role" value="student" type="hidden">
                                <div class="form-row">
                                    <div class="col-md-3 mb-3">
                                        <label for="price">مبلغ (ریال)</label>
                                        <input type="number" class="form-control" id="price" name="price"
                                               placeholder="مبلغ" required value="{{old('price')}}">
                                        <div class="valid-tooltip">
                                            صحیح است!
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="service_id">دانش آموز</label>
                                        <select class="form-control" name="user_id">
                                            @foreach($students as $student)
                                                <option
                                                    value="{{$student->id}}">{{$student->name}} {{$student->family}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="file">تصویر </label>
                                        <input type="file" class="form-control" id="file" name="file">

                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                        <label for="body">توضیحات</label>
                                        <textarea name="description" id="editor-demo1"></textarea>

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
    <!-- begin::select2 -->
    <script src="/panel/assets/vendors/select2/js/select2.min.js"></script>
    <script src="/panel/assets/js/examples/select2.js"></script>
    <!-- end::select2 -->
    <script src="/panel/assets/vendors/ckeditor/ckeditor.js"></script>
    <script src="/panel/assets/js/examples/ckeditor.js"></script>

    <script>
        function stateChange(value) {

            var state_id = value;

            $.ajax({
                url: "{{url('panel/state_city')}}",
                type: "POST",
                data: {
                    state_id: state_id,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                    $('#city_id').html('<option value="">Select city</option>');

                    $.each(result.city, function (key, value) {
                        $("#city_id").append('<option value="' + value.id + '">' + value.title + '</option>');
                    });
                }
            });
        }
    </script>

@endsection


