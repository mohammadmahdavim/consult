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
                    <h3>ویرایش دانش آموز </h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/panel/home">داشبورد</a></li>
                            <li class="breadcrumb-item active" aria-current="page">ویرایش دانش آموز</li>
                        </ol>
                    </nav>
                </div>

            </div>
            <!-- end::page header -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">ویرایش دانش آموز </h5>
                            <form action="/panel/student/{{$row->id}}" class="needs-validation" novalidate
                                  method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                @include('errors')
                                <div class="form-row">
                                    <div class="col-md-3 mb-3">
                                        <label for="name">نام</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               placeholder="نام" required value="{{$row->user->name}}">
                                        <div class="valid-tooltip">
                                            صحیح است!
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="family">نام خانوادگی</label>
                                        <input type="text" class="form-control" id="family" name="family"
                                               placeholder="نام خانوادگی" required value="{{$row->user->family}}">
                                        <div class="valid-tooltip">
                                            صحیح است!
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="gender">جنسیت</label>
                                        <select name="gender" id="gender" class="form-control">
                                            <option @if($row->user->gender==1) selected @endif  value="1">آقا</option>
                                            <option @if($row->user->gender==0) selected @endif value="0">خانم</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="family">کد ملی</label>
                                        <input type="text" class="form-control" id="national_code" name="national_code"
                                               placeholder="کد ملی" required value="{{$row->user->national_code}}">

                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label for="state_id">استان</label>
                                        <select class="form-control" name="state_id" id="state_id"
                                                onchange="stateChange(this.value)">>
                                            @foreach($states as $state)
                                                <option @if($row->state_id==$state->id) selected
                                                        @endif value="{{$state->id}}">{{$state->title}}</option>
                                            @endforeach

                                        </select>

                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="city_id">شهر</label>
                                        <select name="city_id" class="form-control" id="city_id" required>
                                            <option value="{{$row->city_id}}">{{$row->city->title}}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="city_id">شماره موبایل</label>
                                        <input class="form-control" name="mobile" required value="{{$row->mobile}}">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="city_id">شماره موبایل2</label>
                                        <input class="form-control" name="mobile2" value="{{$row->mobile2}}">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="field_id">رشته</label>
                                        <select class="form-control" name="field_id">
                                            @foreach($fields as $field)
                                                <option @if($row->field_id==$field->id) selected
                                                        @endif value="{{$field->id}}">{{$field->title}}</option>
                                            @endforeach

                                        </select>

                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="paye_id">پایه</label>
                                        <select class="form-control" name="paye_id">
                                            @foreach($payes as $paye)
                                                <option @if($row->paye_id==$paye->id) selected
                                                        @endif value="{{$paye->id}}">{{$paye->title}}</option>
                                            @endforeach

                                        </select>

                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="file">تصویر </label>
                                        <input type="file" class="form-control" id="file" name="file[]" multiple>
                                        <figure class="avatar avatar-sm">
                                            @if($row->user->images!='[]')
                                                <img src="{{asset('user_photos')}}/{{$row->user->images[0]->file }}"
                                                     class="rounded-circle">

                                            @else
                                                <img src="assets/media/image/avatar.jpg" class="rounded-circle">

                                            @endif
                                        </figure>

                                    </div>

                                    @can('finance-student-show')
                                        <div class="col-md-3 mb-3">
                                            <label for="consult_id">جذب کننده</label>
                                            <select class="form-control" name="caller">
                                                @foreach($callers as $caller)
                                                    <option @if($row->caller==$caller->id) selected
                                                            @endif
                                                            value="{{$caller->id}}">{{$caller->name}} {{$caller->family}}</option>
                                                @endforeach

                                            </select>

                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="consult_id">مدیر</label>
                                            <select class="form-control" name="manager_id">
                                                @foreach($callers as $caller)
                                                    <option
                                                        @if($row->manager_id==$caller->id) selected
                                                        @endif
                                                        value="{{$caller->id}}">{{$caller->name}} {{$caller->family}}</option>
                                                @endforeach

                                            </select>

                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="consult_id">سرمشاور</label>
                                            <select class="form-control" name="super_consult_id">
                                                @foreach($callers as $caller)
                                                    <option
                                                        @if($row->super_consult_id==$caller->id) selected
                                                        @endif
                                                        value="{{$caller->id}}">{{$caller->name}} {{$caller->family}}</option>
                                                @endforeach

                                            </select>

                                        </div>
                                    @endcan

                                </div>
                                <div class="form-row">
                                    <div class="col-md-3 mb-3">
                                        <label for="city_id">کانونی می باشد؟</label>
                                        <input class="form-control" name="kanoon" type="checkbox"
                                               @if($row->kanoon==1) checked @endif>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="city_id">شمارنده</label>
                                        <input class="form-control" name="counter" type="number"
                                               value="{{$row->counter}}">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                        <label for="body">توضیحات</label>
                                        <textarea name="description"
                                                  id="editor-demo1">{!! $row->description !!}</textarea>

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
    <!-- begin::select2 -->
    <script src="/panel/assets/vendors/select2/js/select2.min.js"></script>
    <script src="/panel/assets/js/examples/select2.js"></script>
    <!-- end::select2 -->
@endsection


