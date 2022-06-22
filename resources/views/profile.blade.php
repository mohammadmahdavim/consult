@extends('layouts.panel')
@section('css')
    <link rel="stylesheet" href="/panel/assets/vendors/select2/css/select2.min.css" type="text/css">

@endsection
@section('content')
    <main class="main-content">
        <div class="container-fluid">
            @if(auth()->user()->role=='consult')
    <div class="card">
        <div class="card-body">
            <form action="/profileUpdate/{{$row->id}}" class="needs-validation" novalidate
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



                </div>

                <button class="btn btn-primary" type="submit">ثبت فرم</button>
            </form>
        </div>
    </div>
            @endif
    <div class="card">
        <div class="card-body">
            <div style="text-align: center">
                <h4 class="panel-title" style="padding-top: 40px ">تغییر رمز عبور</h4>
            </div>
            <div class="panel-body">

                <form action="/profile/updatepassword/{{auth()->user()->id}}">

                    @method('put')

                    {{csrf_field()}}
                    @include('errors')
                    <div class="row">


                        <div class=" col-md-6">

                            <br>
                            <label>نام کاربری</label>
                            <input class="form-control" type="text" id="national_code" name="national_code"
                                  @if(auth()->user()->role=='consult') value="{{$row->user->national_code}}" @else value="{{auth()->user()->national_code}}" @endif readonly>
                            <br>
                            <label>رمز عبور قبلی</label>
                            <input type="password" name="old_password" placeholder="" class="form-control" autocomplete="off">

                        </div>

                        <div class="col-md-6">
                            <br>
                            <label>رمز جدید</label>
                            <input type="password" name="new_password" placeholder="" class="form-control" autocomplete="off">
                            <br>
                            <label>تکرار رمز جدید</label>
                            <input type="password" name="confirm_password" placeholder="" class="form-control" autocomplete="off">

                        </div>

                        <div class="form-group">
                            <br>
                            <div class="col-md-12 col-lg-12">
                                <br>
                                <button class="btn btn-primary btn-block">ذخیره و ارسال</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
        </div>
    </main>
@endsection
@section('js')

    <script src="/js/sweet.js"></script>

    @include('sweetalert::alert')
@endsection


