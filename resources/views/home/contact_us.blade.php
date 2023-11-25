@extends('layouts.home')
@section('css')
@endsection
@section('content')
    <main class="main-content">

        <!-- About Us Area -->
        <div class="tm-section callback-area bg-white tm-padding-section">
            <div class="container">
                <div class="row">
                    <form method="post" action="/home/contact/store">
                        @csrf
                        <input name="user_id" hidden value="{{$id}}">
                        <div class="col-lg-10">
                            <div class="tm-callback">
                                <h2>ارتباط با ما</h2>
                                  <p>
                                   توجه : هزینه ماهانه ثبت نام در  این طرح 
                                   800
                                   هزار تومان می باشد.
                                </p>
                                <p>
                                    شما می توانید جهت پیش ثبت نام در طرح پشتیبان ویژه اطلاعتتان را اینجا وارد کنید تا در اسرع وقت با شما تماس
                                    گرفته شود.
                                </p>
                                <form action="#" class="tm-form">
                                    <div class="tm-form-inner">
                                        <div class="tm-form-field">
                                            <input type="text" name="name" placeholder="نام و نام خانوادگی*"
                                                   required="">
                                        </div>
                                        <div class="tm-form-field tm-form-fieldhalf">
                                            <input type="text" name="mobile" placeholder="شماره تماس*" required="">
                                        </div>
                                        <div class="tm-form-field tm-form-fieldhalf">
                                            <input type="text" name="national_code" placeholder="کد ملی">
                                        </div>
                                        <div class="tm-form-field tm-form-fieldhalf">
                                            <select class="form-control" name="field">
                                                @foreach($fields as $field)
                                                    <option value="{{$field->id}}">{{$field->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="tm-form-field tm-form-fieldhalf">
                                            <select class="form-control" name="paye">
                                                @foreach($payes as $paye)
                                                    <option value="{{$paye->id}}">{{$paye->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="tm-form-field">
                                            <button type="submit" class="tm-button">ثبت</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="d-flex flex-row">
                                <div class="p-2">شماره داخلی:
                                    3125-8451-021
                                </div>
                                <div class="p-2">
                                    <i class="fa fa-phone fa-3x">

                                    </i></div>
                            </div><br>
                            <!--<div class="d-flex flex-row">-->
                            <!--    <div class="p-2">شماره واتساپ: 09210915874</div>-->
                            <!--    <div class="p-2">-->
                            <!--        <i class="fa fa-whatsapp fa-3x"></i>-->
                            <!--    </div>-->
                            <!--</div>-->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('js')
    @include('sweetalert::alert')

@endsection


