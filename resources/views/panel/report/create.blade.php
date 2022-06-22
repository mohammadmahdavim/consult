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
            @if($role!='admin')

                <div class="card">
                    <div class="card-body">
                        <form method="post" action="/panel/reportStore">
                            @csrf
                            <input hidden name="student_id" value="{{$id}}">
                            <div class="card-body" id="skill">


                                <div id="skill0">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">
                                                    نوع کار
                                                </label>
                                                <select class="js-example-basic-single" name="task_id[]" multiple>
                                                    @foreach($tasks as $task)
                                                        <option value="{{$task->id}}">{{$task->name}}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">
                                                    دسته بندی
                                                </label>
                                                <select class="form-control select2" name="type_id">
                                                    @foreach($types as $type)
                                                        <option value="{{$type->id}}">{{$type->name}}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">
                                                    هدفگذاری قبل از تماس
                                                </label>
                                                <textarea name="before" id="before " class="form-control"
                                                ></textarea>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">
                                                    بعد از تماس
                                                </label>
                                                <textarea name="after" id="after" class="form-control"
                                                ></textarea>

                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">
                                                    زمان تماس(دقیقه)
                                                </label>
                                                <input type="number" name="time" id="public"
                                                       class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">
                                                    نمره به تماس </label>
                                                <input type="number" min="0" max="20" name="mark" id="special"
                                                       class="form-control">

                                            </div>
                                        </div>

                                    </div>
                                    <hr class="new2">
                                </div>

                                <div id="skill1">
                                    <div class="row" id="pluspart5">
                                        <div class="col-5"></div>
{{--                                        <div class="col-1">--}}
{{--                                            <a onclick="addpart1('skill',5,1)">--}}
{{--                                                <div class="col-md-4 col-sm-6 col-12 fonticon-container">--}}
{{--                                                    <div class="fonticon-wrap">--}}
{{--                                                        <i class="fa fa-plus"></i>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </a>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-1">--}}
{{--                                            <a onclick="removepart1('skill',5,1)">--}}
{{--                                                <div class="col-md-4 col-sm-6 col-12 fonticon-container">--}}
{{--                                                    <div class="fonticon-wrap">--}}
{{--                                                        <i class="fa fa-minus"></i>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </a>--}}
{{--                                        </div>--}}
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
            @endif
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr style="text-align: center">
                                <th>#</th>
                                <th>کار</th>
                                <th>دسته</th>
                                <th>هدفگذاری</th>
                                <th>انجام</th>
                                <th>زمان</th>
                                <th>نمره</th>
                                <th>تاریخ ثبت</th>
                                @if($role=='admin')
                                    <th>نمره دانش آموز</th>
                                    <th>کامنت دانش آموز</th>
                                @endif
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($reports as $key=>$row)
                                <tr style="text-align: center">
                                    <td>{{$key+1}}</td>
                                    <td>{{$row->task->name}}</td>
                                    <td>{{$row->type->name}}</td>
                                    <td>{{$row->before}}</td>
                                    <td>{{$row->after}}</td>
                                    <td>{{$row->time}}</td>
                                    <td>{{$row->mark}}</td>
                                    <td>{{\Morilog\Jalali\Jalalian::forge($row->created_at)->format('%B %d، %Y')}} </td>

                                @if($role=='admin')

                                        <td>{{$row->mark_student}}</td>
                                    @endif
                                    <td>
                                        <!-- Large modal -->
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                                data-target=".bd-example-modal-lg{{$row->id}}"><i
                                                class="fa fa-pencil"></i></button>

                                        <div class="modal fade bd-example-modal-lg{{$row->id}}" tabindex="-1"
                                             role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary white">
                                                        <h5 class="modal-title" id="myModalLabel17">
                                                            ویرایش دوره

                                                        </h5>
                                                        <button type="button" class="close"
                                                                data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="/panel/report/update/{{$row->id}}"
                                                          method="post">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <span>نوع کار</span>
                                                                    <select class="form-control select2" name="task_id">
                                                                        @foreach($tasks as $task)
                                                                            <option
                                                                                @if($row->task_id==$task->id) selected
                                                                                @endif value="{{$task->id}}">{{$task->name}}</option>
                                                                        @endforeach
                                                                    </select>

                                                                </div>
                                                                <div class="col-6">
                                                                    <span>دسته بندی</span>

                                                                    <select class="form-control select2" name="type_id">
                                                                        @foreach($types as $type)
                                                                            <option       @if($row->type_id==$type->id) selected @endif value="{{$type->id}}">{{$type->name}}</option>
                                                                        @endforeach
                                                                    </select>

                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="">
                                                                            هدفگذاری قبل از تماس
                                                                        </label>
                                                                        <textarea name="before" id="before " class="form-control"
                                                                        >{!! $row->before !!}</textarea>

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="">
                                                                            بعد از تماس
                                                                        </label>
                                                                        <textarea name="after" id="after" class="form-control"
                                                                        >{!! $row->after !!}</textarea>

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="">
                                                                            زمان تماس(دقیقه)
                                                                        </label>
                                                                        <input type="number" name="time" id="public" value="{{$row->time}}"
                                                                               class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="">
                                                                            نمره به تماس </label>
                                                                        <input type="number" min="0" max="20" name="mark" id="special" value="{{$row->mark}}"
                                                                               class="form-control">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <button type="submit" class=" btn btn-success">ثبت</button>

                                                            <button type="button" class="btn btn-danger"
                                                                    data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">بستن</span>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>


                                        <x-destroy :id="$row->id" url="'/panel/report/destroy'"/>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>

                    </div>

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
    <script src="/js/sweet.js"></script>

@endsection


