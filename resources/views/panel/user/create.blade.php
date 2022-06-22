@extends('layouts.panel')


@section('content')
    <main class="main-content">
        <div class="row match-height">
            <div class="col-md-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">ایجاد فرد</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-horizontal" action="/panel/users" method="post"  enctype="multipart/form-data">
                                @csrf
                                @include('errors')
                                <div class="form-body">
                                    <div class="row">

                                        <div class="col-md-3">
                                            <span>نام</span>

                                            <input type="text" id="name" class="form-control" name="name"
                                                   value="{{old('name')}}"
                                            >
                                        </div>

                                        <div class="col-md-3">
                                            <span>نام خانوادگی</span>

                                            <input type="text" id="family" class="form-control" name="family"
                                                   value="{{old('family')}}">
                                        </div>

                                        <div class="col-md-3">
                                            <span>جنسیت</span>
                                            <select name="gender" id="gender" class="form-control">
                                                <option value="1">آقا</option>
                                                <option value="0">خانم</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <span>شماره موبایل</span>

                                            <input type="text" id="mobile" class="form-control" name="mobile"
                                                   value="{{old('mobile')}}">
                                        </div>
                                        <div class="col-md-3">
                                            <span>کد ملی</span>

                                            <input type="text" id="national_code" class="form-control"
                                                   value="{{old('national_code')}}" name="national_code"
                                            >
                                        </div>

                                        <div class="col-md-3">
                                            <span>واحد</span>
                                            <select id="section" class="form-control" name="section">
                                                <option value="bartar">برترها</option>
                                                <option value="payamg">پیام دختر</option>
                                                <option value="payamb">پیام پسر</option>
                                                <option value="fays">گروه فیض</option>
                                                <option value="site">سایت</option>
                                                <option value="inst">اینستاگرام</option>
                                                <option value="other">متفرقه</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <span>نقش</span>
                                            <select id="role" class="form-control" name="role">
                                                <option value="admin">مدیر</option>
                                                <option value="caller">جذب کننده</option>
                                                <option value="semi_admin">مدیر بدون مالی</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <span >تصویر </span>
                                            <input type="file" class="form-control" id="file" name="file[]" multiple>

                                        </div>
                                    </div>

                                </div>
                                <br>
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-primary mr-1 mb-1">ثبت</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>
@stop

@section('script')
@stop
