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
                            <option @if($month=='07') selected @endif value="07">مهر</option>
                            <option @if($month=='08') selected @endif value="08">آبان</option>
                            <option @if($month=='09') selected @endif value="09">آذر</option>
                            <option @if($month=='10') selected @endif value="10">دی</option>
                            <option @if($month=='11') selected @endif value="11">بهمن</option>
                            <option @if($month=='12') selected @endif value="12">اسفند</option>
                            <option @if($month=='01') selected @endif value="01">فروردین</option>
                            <option @if($month=='02') selected @endif value="02">اردیبهشت</option>
                            <option @if($month=='03') selected @endif value="03">خرداد</option>
                            <option @if($month=='04') selected @endif value="04">تیر</option>
                            <option @if($month=='05') selected @endif value="05">مرداد</option>
                            <option @if($month=='06') selected @endif value="06">شهریور</option>
                        </select>

                    </div>
                    <div class="col-md-2 ">
                        <button class="btn btn-success">اعمال تاریخ</button>
                    </div>
                </div>
            </form>
        </div>

    </div>

    <div class="card">
        <div class="card-body">
            <div class="media-body table-responsive">
                <br>
                <table id="example1" class="table  table-striped table-bordered ">
                    <thead>
                    <tr class="success" style="text-align: center">
                        <th>ردیف</th>
                        <th>تصویر</th>
                        <th>نام</th>
                        @foreach($dates as $date)
                            <th style="writing-mode: vertical-rl;padding: 0.15rem">{{$date}}</th>
                        @endforeach

                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    $number = 0;
                    ?>
                    @foreach($answers as $key=>$answer)
                        <?php
                        $user = \App\Models\User::where('id', $key)->first();
                        $number += 1;
                        ?>
                        <tr style="text-align: center">
                            <td>{{$number}}</td>
                            <td>
                                <div class="gallery">
                                    <figure class="avatar avatar-sm avatar-state-success">
                                        @if(!empty($user->filename))
                                            <img class="rounded-circle"
                                                 src="{{url('uploads/'.$user->filename)}}"
                                                 alt="...">
                                        @else
                                            <img class="rounded-circle" src="/assets/profile/avatar.png"
                                                 alt="...">
                                        @endisset
                                    </figure>

                                </div>
                            </td>
                            <td>{{$user->name}}-{{$user->family}}</td>
                            @foreach($dates as $date)
                                <td style="padding: 0.15rem">
                                    {{$answer->where('date',$date)->sum('time')}}
                                </td>
                            @endforeach
                        </tr>
                    @endforeach

                    </tbody>


                </table>

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


