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
                <form action="/panel/students/pattern/sabt" method="post">
                    {{csrf_field()}}
                    <input name="pattern" value="{{$pattern}}" hidden>
                    <label> انتخاب تاریخ</label>

                    <div class="row text-center justify-content-md-center">
                        <div class="col-md-3 m-t-b-20">
                            <input style="text-align: center" type="text" name="date" id="date-picker-shamsi"
                                   class="form-control text-right"
                                   dir="ltr" value="{{old('date')}}" required autocomplete="off"></div>
                        <div class="col-md-2 m-t-b-20">
                            <button class="btn btn-success">اعمال روز</button>
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

    <script src="/js/sweet.js"></script>

    @include('sweetalert::alert')
@endsection('js')



