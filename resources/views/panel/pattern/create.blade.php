@extends('layouts.panel')
@section('css')
    <!-- begin::datepicker -->
    <link rel="stylesheet" href="/panel/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="/panel/assets/vendors/datepicker/daterangepicker.css">
    <!-- end::datepicker -->

@endsection('css')



@section('content')
    <main class="main-content">
        <div class="container-fluid">
            <div class="page-header">
                <div>
                    <h3>ایجاد الگو</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/panel/index">داشبورد</a></li>
                            <li class="breadcrumb-item"><a href="#">الگو</a></li>
                            <li class="breadcrumb-item active" aria-current="page">ایجاد</li>
                        </ol>
                    </nav>
                </div>

            </div>
            <div class="card">
                <div class="card-body">

                    <form action="/panel/pattern" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        @include('errors')
                        <div style="text-align: center">
                            <h3 class="panel-title" style="padding-top: 40px;font-size: large;font-family: 'B Titr' ">
                                ایجاد الگو
                            </h3>
                        </div>
                        <div class="panel-heading">
                            <div class="heading-elements">
                                <ul class="icons-list">
                                    <li><a data-action="collapse"></a></li>
                                    <li><a data-action="close"></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <br>

                                <label>عنوان </label>
                                <br>
                                <input style="text-align: center" type="text" id="name" name="name"
                                       class="form-control" value="{{old('name')}}">
                            </div>
                            <div class=" col-md-2" id="selectclass">
                                <br>
                                <label> مشاور </label>
                                <select id="rowteacher" name="class_id"
                                        class="form-control">
                                    @foreach($allclas as $allclass)
                                        <option style="text-align: right" value="{{$allclass->id}}">
                                            {{$allclass->user->name}} {{$allclass->user->family}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <br>
                            <div class="col-md-3">
                                <br>

                                <label>تاریخ شروع</label>
                                <input style="text-align: center" type="text" name="date_from" id="date-picker-shamsi"
                                       class="form-control text-right"
                                       dir="ltr" value="{{old('date_from')}}" required autocomplete="off">
                            </div>
                            <div class="col-md-3">
                                <br>

                                <label>تاریخ پایان</label>
                                <input style="text-align: center" type="text" name="date-picker-shamsi-list" id=""
                                       class="form-control text-right"
                                       dir="ltr" value="{{old('date-picker-shamsi-list')}}" required autocomplete="off">
                            </div>
                            <div class="col-md-12 ">
                                <br>
                                <button class="btn btn-block btn-info">ایجاد الگو</button>
                            </div>
                        </div>
                    </form>
                </div>
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

