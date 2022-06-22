@extends('layouts.panel')
@section('css')
    <!-- begin::datepicker -->
    <link rel="stylesheet" href="/panel/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="/panel/assets/vendors/datepicker/daterangepicker.css">
    <!-- end::datepicker -->

@endsection('css')
@section('content')
    <main class="main-content">

    <div class="card">
        <div class="card-body">
            <form action="/panel/pattern/report/month" method="post">
                {{csrf_field()}}
                <label> انتخاب ماه</label>

                <div class="row ">
                    <div class="col-md-3 ">
                        <select class="form-control" name="month">
                            <option value="07">مهر</option>
                            <option value="08">آبان</option>
                            <option value="09">آذر</option>
                            <option value="10">دی</option>
                            <option value="11">بهمن</option>
                            <option value="12">اسفند</option>
                            <option value="01">فروردین</option>
                            <option value="02">اردیبهشت</option>
                            <option value="03">خرداد</option>
                            <option value="04">تیر</option>
                            <option value="05">مرداد</option>
                            <option value="06">شهریور</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-success">اعمال تاریخ</button>
                    </div>
                </div>

            </form>
        </div>

    </div>
    </main>
@endsection('content')
@section('js')
    <!-- begin::datepicker -->
    <script src="/panel/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.js"></script>
    <script src="/panel/assets/vendors/datepicker-jalali/bootstrap-datepicker.fa.min.js"></script>
    <script src="/panel/assets/vendors/datepicker/daterangepicker.js"></script>
    <script src="/panel/assets/js/examples/datepicker.js"></script>
    <!-- end::datepicker -->

    <!-- end::select2 -->
    <script src="/js/sweet.js"></script>

    @include('sweetalert::alert')
    <script>
        function check() {
            var checkBox = document.getElementById("customSwitch");
            var selectclass = document.getElementById("selectclass");
            var selectstudent = document.getElementById("selectstudent");
            if (checkBox.checked == true) {

                selectstudent.style.display = "block";
                selectclass.style.display = "none";
            } else {
                selectstudent.style.display = "none";
                selectclass.style.display = "block";
            }
        }
    </script>
@endsection('js')


