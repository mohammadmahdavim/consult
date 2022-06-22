@extends('layouts.panel')
@section('css')
@endsection
@section('content')
    <main class="main-content">

        <div class="container-fluid">

            <!-- begin::page header -->
            <div class="page-header">
                <div>
                    <h3>ویرایش مشاور </h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/panel/home">داشبورد</a></li>
                            <li class="breadcrumb-item active" aria-current="page">ویرایش مشاور</li>
                        </ol>
                    </nav>
                </div>

            </div>
            <!-- end::page header -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">ویرایش مشاور </h5>
                            <form action="/panel/home/consult/{{$row->id}}" class="needs-validation" novalidate
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
                                        <label for="family">ایمیل</label>
                                        <input type="text" class="form-control" id="email" name="email"
                                               placeholder="ایمیل" value="{{$row->user->email}}">

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
                                        <label for="field_id">رشته مدرسه</label>
                                        <select class="form-control" name="field_school_id">
                                            @foreach($fieldschools as $fieldschool)
                                                <option @if($row->field_school_id==$fieldschool->id) selected
                                                        @endif value="{{$fieldschool->id}}">{{$fieldschool->title}}</option>
                                            @endforeach

                                        </select>

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
                                        <label for="university_id">دانشگاه</label>
                                        <select class="form-control" name="university_id">
                                            @foreach($university as $universit)
                                                <option @if($row->university_id==$universit->id) selected
                                                        @endif value="{{$universit->id}}">{{$universit->title}}</option>
                                            @endforeach

                                        </select>

                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="year_id">سال ورود</label>
                                        <select class="form-control" name="year_id">
                                            @foreach($years as $year)
                                                <option @if($row->year_id==$year->id) selected
                                                        @endif value="{{$year->id}}">{{$year->title}} </option>
                                            @endforeach

                                        </select>

                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="year_id">ظرفیت</label>
                                        <input name="capacity" class="form-control" type="number" value="{{$row->capacity}}">

                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="year_id">رتبه</label>
                                        <input name="rank" class="form-control" type="number" value="{{$row->rank}}">

                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="year_id">منطقه</label>
                                        <select class="form-control" name="area">
                                            <option @if($row->area==1) selected @endif>1</option>
                                            <option @if($row->area==2) selected @endif>2</option>
                                            <option @if($row->area==3) selected @endif>3</option>

                                        </select>

                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="sort">سورت</label>
                                        <input name="sort" class="form-control" type="number" value="{{$row->sort}}">

                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="file">تصویر </label>
                                        <input type="file" class="form-control" id="file" name="file[]" multiple>
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

@endsection


