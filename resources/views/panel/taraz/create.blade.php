@extends('layouts.panel')
@section('css')
    <link rel="stylesheet" href="/panel/assets/vendors/select2/css/select2.min.css" type="text/css">

@endsection
@section('content')
    <main class="main-content">

        <div class="container-fluid">

            <!-- begin::page header -->
            <div class="page-header">
                <div>
                    <h3>داشبورد</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">داشبورد</a></li>
                            <li class="breadcrumb-item active" aria-current="page">پیش فرض</li>
                        </ol>
                    </nav>
                </div>

            </div>
            <div class="card">
                <div class="card-body">
                    <form method="post" action="/panel/tarazStore">
                        @csrf

                        <div class="card-body" id="skill">


                            <div id="skill0">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">
                                               دانش آموز
                                            </label>
                                         <select class="form-control select2" name="fields[student_id][]">
                                             @foreach($students as $student)
                                                 <option value="{{$student->id}}">{{$student->user->name}}-{{$student->user->family}}</option>
                                             @endforeach
                                         </select>

                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">
                                            آزمون
                                            </label>
                                         <select class="form-control select2" name="fields[test_id][]">
                                             @foreach($tests as $test)
                                                 <option value="{{$test->id}}">{{$test->name}}</option>
                                             @endforeach
                                         </select>

                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">
                                                تراز کل
                                            </label>
                                          <input name="fields[all][]" id="all" class="form-control" required>

                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">
                                                تراز عمومی
                                            </label>
                                            <input name="fields[public][]" id="public" class="form-control" required>

                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">
                                                تراز اختصاصی
                                            </label>
                                            <input name="fields[special][]" id="special" class="form-control" required>

                                        </div>
                                    </div>

                                </div>
                                <hr class="new2">
                            </div>

                            <div id="skill1">
                                <div class="row" id="pluspart5">
                                    <div class="col-5"></div>
                                    <div class="col-1">
                                        <a onclick="addpart1('skill',5,1)">
                                            <div class="col-md-4 col-sm-6 col-12 fonticon-container">
                                                <div class="fonticon-wrap">
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-1">
                                        <a onclick="removepart1('skill',5,1)">
                                            <div class="col-md-4 col-sm-6 col-12 fonticon-container">
                                                <div class="fonticon-wrap">
                                                    <i class="fa fa-minus"></i>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <br>
                            <button type="submit"
                               class="btn btn-success mr-sm-1 mb-1 mb-sm-0">ثبت تغییرات
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </main>

@endsection
@section('js')
    <script>
        removepart1 = function (div, num, id) {
            if (id != 1) {
                var idminus = id - 1;
                document.getElementById(div + id).style.display = "none";
                document.getElementById(div + id).remove();
                document.getElementById(div + idminus).innerHTML = "";
                document.getElementById(div + idminus).innerHTML = "<div class=\"row\" id=\"pluspart" + num + "\">\n" +
                    "                                                        <div class=\"col-5\"></div>\n" +
                    "                                                        <div class=\"col-1\">\n" +
                    "                                                            <a onclick=\"addpart1('" + div + "'," + num + "," + idminus + ")\">\n" +
                    "                                                                <div class=\"col-md-4 col-sm-6 col-12 fonticon-container\">\n" +
                    "                                                                    <div class=\"fonticon-wrap\">\n" +
                    "                                                                        <i class=\"fa fa-plus\"></i>\n" +
                    "                                                                    </div>\n" +
                    "                                                                </div>\n" +
                    "                                                            </a>\n" +
                    "                                                        </div><div class=\"col-1\">\n" +
                    "                                                <a onclick=\"removepart1('" + div + "'," + num + "," + idminus + ")\">\n" +
                    "                                                    <div class=\"col-md-4 col-sm-6 col-12 fonticon-container\">\n" +
                    "                                                        <div class=\"fonticon-wrap\">\n" +
                    "                                                            <i class=\"fa fa-minus\"></i>\n" +
                    "                                                        </div>\n" +
                    "                                                    </div>\n" +
                    "                                                </a>\n" +
                    "                                            </div>\n" +
                    "                                                        <div class=\"col-5\"></div>\n" +
                    "                                                    </div>";
                reload_date();
            }
        };
        addpart1 = function (div, num, id) {

            var idplus = id + 1;
            document.getElementById("pluspart" + num).style.display = "none";
            document.getElementById("pluspart" + num).remove();
            document.getElementById(div + id).innerHTML += document.getElementById(div + "0").innerHTML + "<div class=\"row\" id=\"pluspart" + num + "\">\n" +
                "                                                        <div class=\"col-5\"></div>\n" +
                "                                                        <div class=\"col-1\">\n" +
                "                                                            <a onclick=\"addpart1('" + div + "'," + num + "," + idplus + ")\">\n" +
                "                                                                <div class=\"col-md-4 col-sm-6 col-12 fonticon-container\">\n" +
                "                                                                    <div class=\"fonticon-wrap\">\n" +
                "                                                                        <i class=\"fa fa-plus\"></i>\n" +
                "                                                                    </div>\n" +
                "                                                                </div>\n" +
                "                                                            </a>\n" +
                "                                                        </div><div class=\"col-1\">\n" +
                "                                                <a onclick=\"removepart1('" + div + "'," + num + "," + idplus + ")\">\n" +
                "                                                    <div class=\"col-md-4 col-sm-6 col-12 fonticon-container\">\n" +
                "                                                        <div class=\"fonticon-wrap\">\n" +
                "                                                            <i class=\"fa fa-minus\"></i>\n" +
                "                                                        </div>\n" +
                "                                                    </div>\n" +
                "                                                </a>\n" +
                "                                            </div>\n" +
                "                                                        <div class=\"col-5\"></div>\n" +
                "                                                    </div>";
            document.getElementById(div + id).insertAdjacentHTML('afterend', '<div id=\"' + div + idplus + '\"></div>');
            reload_date();
        };

        reload_date = function () {
            removeclass = document.getElementsByClassName("select2");
            for (y = 0; y < removeclass.length; y++) {
                removeclass[y].id = y;
                $(".select2").select2();
            }
            $(".select2").select2();
        }
    </script>
    <script src="/panel/assets/vendors/select2/js/select2.min.js"></script>
    <script src="/panel/assets/js/examples/select2.js"></script>
    @include('sweetalert::alert')

@endsection


