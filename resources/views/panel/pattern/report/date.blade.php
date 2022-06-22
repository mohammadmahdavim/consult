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
            <form action="/panel/pattern/report/daily" method="post">
                {{csrf_field()}}
                <label> انتخاب تاریخ</label>

                <div class="row ">
                    <div class="col-md-3 ">
                        <input style="text-align: center" type="text" name="date_from" id="date-picker-shamsi"
                               class="form-control text-right"
                               dir="ltr" value="{{old('date_from')}}" required autocomplete="off">
                    </div>

                    <div class="col-md-3 ">

                        <input style="text-align: center" type="text" name="date_to" id="date-picker-shamsi-new"
                               class="form-control text-right"
                               dir="ltr" value="{{old('date_to')}}" required autocomplete="off">
                    </div>
                </div>
                <div class="col-md-2 m-t-b-20">
                    <button class="btn btn-success">اعمال تاریخ</button>
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


