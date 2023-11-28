@extends('layouts.home')
@section('css')
    <link rel="stylesheet" href="/panel/assets/vendors/select2/css/select2.min.css" type="text/css">
    <!-- end::select2 -->
@endsection
@section('content')
    <main class="main-content">

        <!-- About Us Area -->
        <div class="tm-section callback-area bg-white tm-padding-section">
            <div class="container">
                <div class="row">
                    <form method="post" action="/home/contact_2/store">
                        @csrf
                        <input name="user_id" hidden value="{{$id}}">
                        <div class="col-lg-10">
                            <div class="tm-callback">
                                <h2>ارتباط با ما</h2>
                                <p>

                                    لطفا پکیج درخواستی خود را انتخاب کنید. تا کارشناسان کانون با شما ارتباط بگیرند.
                                </p>
                                <br>
                                <br>
                                @include('errors')
                                <form action="#" class="tm-form">
                                    <div class="tm-form-inner">
                                        <lable>
                                            پکیج
                                        </lable>

                                    </div>
                                    <div class="tm-form-inner">

                                        <!--<lable>نام</lable>-->
                                        <div class="tm-form-field tm-form-fieldhalf">

                                            <select class="form-control" name="cource" required>


                                                <option>
                                                ثبت نام همايش رايگان انتخاب رشته
                                                </option>
                                              <option>

انتخاب رشته غیر حضوری
                                                </option>
                                                <option>

                                            انتخاب رشته حضوری                                            
                                                    
                                                    </option>
                                                
                                              





                                            </select>
                                        </div>
                                        <div class="tm-form-field tm-form-fieldhalf">
                                            <input type="text" name="name" placeholder="نام و نام خانوادگی*"
                                                   value="{{old('name')}}" required=""
                                            >
                                        </div>

                                        <div class="tm-form-field tm-form-fieldhalf">
                                            <input type="text" name="mobile" placeholder="شماره تماس"
                                                   value="{{old('mobile')}}" required=""

                                            >
                                        </div>
                                        <div class="tm-form-field tm-form-fieldhalf">
                                            <input type="text" name="mobile2"
                                                   placeholder="شماره تماس دوم
                                            "
                                                   value="{{old('mobile2')}}" required=""

                                            >
                                        </div>
                                        <div class="tm-form-field tm-form-fieldhalf">
                                            <input type="text" name="national_code"
                                                   value="{{old('national_code')}}" required=""

                                                   placeholder="کد ملی">
                                        </div>
                                        <div class="tm-form-field tm-form-fieldhalf">
                                            <input type="text"
                                                   value="{{old('counter')}}"
                                                   name="counter" placeholder="شمارنده در صورت کانونی بودن
                                            ">

                                        </div>
                                        <div class="tm-form-field tm-form-fieldhalf">
                                            <input type="text" name="city"
                                                   value="{{old('city')}}" required=""

                                                   placeholder="شهر">

                                        </div>
                                        <div class="tm-form-field tm-form-fieldhalf">


                                        </div>
                                        <div class="tm-form-field tm-form-fieldhalf">
                                            <lable>نوع ثبت نام در کانون</lable>
                                            <select class="form-control" name="type">


                                                <option>
                                                    عادی
                                                </option>
                                                <option>

                                                    بورسیه
                                                </option>
                                                <option>
                                                    غیر کانونی
                                                </option>
                                                <option>
                                                    طرح حکمت
                                                </option>
                                                <option>
                                                    بنیاد شهید                                                     </option>


                                            </select>
                                        </div>
                                        <div class="tm-form-field tm-form-fieldhalf">
                                            <lable>مقطع</lable>
                                            <select class="form-control" name="maghta">


                                                <option>
                                                    دوازدهم و فارغ التحصیل                  </option>
                                                <option>
                                                    یازدهم                  </option>
                                                <option>
                                                    دهم                  </option>
                                                <option>
                                                    نهم                  </option>
                                                <option>
                                                    هشتم                  </option>
                                                <option>
                                                    هفتم                  </option>
                                                <option>
                                                    ششم                  </option>
                                                <option>
                                                    پنجم                  </option>

                                            </select>
                                        </div>
                                        <div class="tm-form-field tm-form-fieldhalf">
                                            <lable>رشته</lable>
                                            <select class="form-control" name="field">

                                                @foreach($fields as $field)
                                                    <option value="{{$field->title}}">{{$field->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!--    <div  class="tm-form-field tm-form-fieldhalf">-->
                                        <!--        <lable>درس</lable>-->
                                        <!--    <select class="form-control" type="text" name="dars" >-->

                                        <!--        <option>زیست شناسی</option>   -->
                                        <!--        <option>فیزیک</option>   -->
                                        <!--    <option>شیمی</option>   -->
                                        <!--        <option>ریاضی</option>   -->
                                        <!--            <option>علوم و فنون</option>   -->
                                        <!--                <option>منطق</option>   -->
                                        <!--                    <option>فلسفه</option>   -->
                                        <!--                        <option>عربی</option>   -->
                                        <!--                            <option>ریاضی انسانی</option>   -->

                                        <!--    </select>-->

                                        <!--</div>-->
                                        <!--                                   <div class="col-md-6 tm-form-field tm-form-fieldhalf">-->
                                        <!--                                           <lable>درس</lable>-->
                                        <!--<select class="js-example-basic-single" name="dars[]" multiple dir="rtl">-->

                                        <!--                                         <option>زیست شناسی</option>   -->
                                        <!--                                         <option>فیزیک</option>   -->
                                        <!--                                     <option>شیمی</option>   -->
                                        <!--                                         <option>ریاضی</option>   -->
                                        <!--                                             <option>علوم و فنون</option>   -->
                                        <!--                                                 <option>منطق</option>   -->
                                        <!--                                                     <option>فلسفه</option>   -->
                                        <!--                                                         <option>عربی</option>   -->
                                        <!--                                                             <option>ریاضی انسانی</option> >-->
                                        <!--                     </select>-->
                                        <!--                 </div>-->

                                        <div class="tm-form-field tm-form-fieldhalf">

                                        </div>
                                        <div class="tm-form-field tm-form-fieldhalf">
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

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('js')
    <!-- begin::select2 -->
    <script src="/panel/assets/vendors/select2/js/select2.min.js"></script>
    <script src="/panel/assets/js/examples/select2.js"></script>
    <!-- end::select2 -->
    @include('sweetalert::alert')

@endsection


