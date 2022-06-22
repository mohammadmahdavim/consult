@extends('layouts.panel')
@section('css')
    <link rel="stylesheet" href="/panel/assets/vendors/select2/css/select2.min.css" type="text/css">
    <style>

        .card {
            border: none;
            box-shadow: 5px 6px 6px 2px #e9ecef;
            border-radius: 4px
        }

        .dots {
            height: 4px;
            width: 4px;
            margin-bottom: 2px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block
        }

        .badge {
            padding: 7px;
            padding-right: 9px;
            padding-left: 16px;
            box-shadow: 5px 6px 6px 2px #e9ecef
        }

        .user-img {
            margin-top: 4px
        }

        .check-icon {
            font-size: 17px;
            color: #c3bfbf;
            top: 1px;
            position: relative;
            margin-left: 3px
        }

        .form-check-input {
            margin-top: 6px;
            margin-left: -24px !important;
            cursor: pointer
        }

        .form-check-input:focus {
            box-shadow: none
        }

        .icons i {
            margin-left: 8px
        }

        .reply {
            margin-left: 12px
        }

        .reply small {
            color: #b7b4b4
        }

        .reply small:hover {
            color: green;
            cursor: pointer
        }</style>
@endsection
@section('content')
    <main class="main-content">

        <div class="container-fluid">
            <!-- begin::page header -->
            <div class="page-header">
                <div>
                    <h3>دانش آموزان</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/panel/home">داشبورد</a></li>
                            <li class="breadcrumb-item active" aria-current="page">دانش آموزان</li>
                        </ol>
                    </nav>
                </div>

            </div>
            <!-- end::page header -->
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h5>لیست دانش آموزان</h5>
                        <div class="heading-elements">
                            @can('student-create')
                                <div class="d-flex flex-row">
                                    <div class="p-2">
                                        <a href="{{url('panel/student/create')}}" class="btn  btn-success">افزودن <i
                                                class="fa fa-plus"></i></a>
                                    </div>
                                    <div class="p-2">
                                        <button type='button' class="btn btn-primary" onclick="hideshow()"
                                                id='hideshow'>
                                            جستجوی پیشرفته
                                        </button>
                                        <div id='search' style="display: none">
                                            <form method="get" action="/panel/student">
                                                <div class="d-flex flex-row">
                                                    <div class="p-2">
                                                        <span>نام</span>
                                                        <input class="form-control" id="name" name="name"
                                                               value="{{request()->name}}"
                                                               placeholder="نام">
                                                    </div>
                                                    <div class="p-2">
                                                        <span>کد ملی</span>
                                                        <input class="form-control" id="national_code"
                                                               name="national_code"
                                                               value="{{request()->national_code}}"
                                                               placeholder="کد ملی">
                                                    </div>
                                                    <div class="p-2">
                                                        <span>رشته</span>
                                                        <select class="js-example-basic-single" dir="rtl" multiple
                                                                name="field[]">
                                                            @foreach($fields as $field)
                                                                <option value="{{$field->id}}"
                                                                        @if(isset(request()->field) && is_array(request()->field) && in_array($field->id, request()->field)) selected @endif>{{$field->title}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="p-2">
                                                        <span>وضعیت</span>
                                                        <select class="form-control" dir="rtl"
                                                                name="status">
                                                            <option selected value="">هردو</option>
                                                            <option @if(request()->status=='active') selected
                                                                    @endif value="active">فعال
                                                            </option>
                                                            <option @if(request()->status=='inactive') selected
                                                                    @endif value="inactive">غیرفعا
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="p-2">
                                                        <span>پایه</span>
                                                        <select class="js-example-basic-single" dir="rtl" multiple
                                                                name="paye[]">
                                                            @foreach($payes as $paye)
                                                                <option value="{{$paye->id}}"
                                                                        @if(isset(request()->paye) && is_array(request()->paye) && in_array($paye->id, request()->paye)) selected @endif>{{$paye->title}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="p-2">
                                                        <span>دوره</span>
                                                        <select class="form-control" dir="rtl"
                                                                name="service">
                                                            <option selected value=""></option>
                                                            @foreach($services as $service)
                                                                <option value="{{$service->id}}"
                                                                        @if($service->id==request()->service) selected @endif>{{$service->title}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="p-2">
                                                        <br>
                                                        <input class="btn btn-danger" type="reset"
                                                               value="حذف فیلتر ها">

                                                    </div>
                                                    <div class="p-2">
                                                        <br>
                                                        <button type="submit" class="btn btn-info">جستجوکن</button>
                                                    </div>
                                                </div>

                                            </form>
                                        </div>

                                    </div>
                                    <div class="p-2">

                                        <form method="get" action="/panel/students/export">
                                            <input hidden name="national_code" value="{{request()->national_code}}">
                                            <input hidden name="name" value="{{request()->name}}">
                                            <input hidden name="status" value="{{request()->status}}">
                                            <input hidden name="service" value="{{request()->service}}">
                                            <select hidden name="field[]" multiple="multiple">
                                                @foreach($fields as $field)
                                                    <option value="{{$field->id}}"
                                                            @if(isset(request()->field) && is_array(request()->field) && in_array($field->id, request()->field)) selected @endif>{{$field->title}}</option>
                                                @endforeach
                                            </select>
                                            <select hidden name="paye[]" multiple="multiple">
                                                @foreach($payes as $paye)
                                                    <option value="{{$paye->id}}"
                                                            @if(isset(request()->paye) && is_array(request()->paye) && in_array($paye->id, request()->paye)) selected @endif>{{$paye->title}}</option>
                                                @endforeach
                                            </select>
                                            <button type='submit' class="btn btn-warning">
                                                دریافت فایل
                                            </button>
                                        </form>
                                    </div>

                                </div>
                            @endcan
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr style="text-align: center">
                                <th>#</th>
                                <th>تصویر</th>
                                <th>مشاور</th>
                                <th>نام</th>
                                <th>کد ملی</th>
                                <th>شهر</th>
                                <th>رشته</th>
                                <th>پایه</th>
                                @can('student-update')
                                    <th>تاریخ ثبت نام</th>
                                    <th>تاریخ پایان دوره</th>
                                    <th>عملیات</th>
                                @endcan

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rows as $key=>$row)
                                <tr
                                    @if($row->status=='inactive') style="text-align: center;background-color: black"
                                    @elseif($row->status=='24') style="text-align: center;background-color: red"
                                    @elseif($row->status=='72') style="text-align: center;background-color: yellow"
                                    @elseif($row->status=='cancel') style="text-align: center;background-color: #918e99"
                                    @else style="text-align: center"
                                    @endif
                                >
                                    <td>{{$key+1}}</td>
                                    <td>

                                        <figure class="avatar avatar-sm">
                                            @if($row->user->images!='[]')
                                                <img src="{{asset('user_photos')}}/{{$row->user->images[0]->file }}"
                                                     class="rounded-circle">

                                            @else
                                                <img src="assets/media/image/avatar.jpg" class="rounded-circle">

                                            @endif
                                        </figure>
                                    </td>
                                    <td style="color: #0d8d2d">
                                        @if($row->serviceActive->consult!='[]')

                                            {{--                                            @dd($row->serviceActive->consult->user->name)--}}
                                            <a style="color: #0d8d2d"
                                               href="/panel/consult/finance/{{$row->serviceActive->consult->id}}">

                                                {{$row->serviceActive->consult->user->name}} {{$row->serviceActive->consult->user->family}}

                                            </a>
                                        @elseif($row->serviceLast->consult!='[]')

                                            <a style="color: #0d8d2d"
                                               href="/panel/consult/finance/{{$row->serviceLast->consult->id}}">
                                                {{$row->serviceLast->consult->user->name}} {{$row->serviceLast->consult->user->family}}

                                            </a>
                                        @else

                                            {{--                                            {{$row->service[0]->consult->user->name}} {{$row->service[0]->consult->user->family}}--}}

                                        @endif

                                    </td>
                                    <td>{{$row->user->name}} {{$row->user->family}} -
                                        @if($row->user->gender==1)
                                            آقا
                                        @else
                                            خانم
                                        @endif
                                    </td>
                                    <td>{{$row->user->national_code}}</td>

                                    <td>{{$row->state->title}} ({{$row->city->title}})</td>

                                    <td>{{$row->field->title}}</td>
                                    <td>{{$row->paye->title}}</td>
                                    @can('student-update')
                                        <td>{{$row->serviceFirst->start}}</td>
                                        <td>{{$row->serviceLast->end}}</td>
                                        <td>
                                            @can('finance-student-show')
                                                <a href="/panel/student/finance/{{$row->id}}">
                                                    <button class="btn btn-primary btn-sm" title="مالی">
                                                        <i class="icon ti-money"></i>
                                                    </button>
                                                </a>
                                            @endcan
                                            @can('service-show-student')

                                                <a href="/panel/student/service/{{$row->id}}">
                                                    <button class="btn btn-info btn-sm" title="دوره ها">
                                                        <i class="icon ti-book"></i>
                                                    </button>
                                                </a>
                                                <a href="/panel/karnameh/{{$row->user->id}}">
                                                    <button class="btn btn-primary btn-sm" title="کارنامه">
                                                        <i class="icon ti-layout-accordion-list"></i>
                                                    </button>
                                                </a>
                                                <a href="/panel/report/{{$row->id}}">
                                                    <button class="btn btn-warning btn-sm" title="گزارش">
                                                        <i class="fa fa-phone"></i>
                                                    </button>
                                                </a>
                                            @endcan
                                            @can('student-update')

                                                <a href="/panel/student/{{$row->id}}/edit">
                                                    <button class="btn btn-success btn-sm" title="ویرایش">
                                                        <i class="icon ti-pencil"></i>
                                                    </button>
                                                </a>
                                            @endcan
                                            @can('service-show-student')
                                                <button type="button" class="btn btn-warning btn-sm" title="پرونده"
                                                        onclick="modal_show('{{$row->id}}','/panel/comments');">
                                                    <i class="fa fa-file-text-o"></i>
                                                </button>
                                            @endcan
                                            @can('student-delete')
                                                <a href="/panel/student/cancel/{{$row->id}}">
                                                    <button class="btn btn-dark btn-sm" title="کنسل">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </a>
                                            @endcan
                                            @can('student-delete')

                                                <x-destroy :id="$row->id" url="'/panel/student/destroy'"/>
                                            @endcan

                                        </td>
                                    @endcan

                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>

        </div>
        {{ $rows->withQueryString()->links() }}

    </main>
    @include('include.modal.show')

@endsection
@section('js')
    <script>
        function hideshow() {
            var x = document.getElementById("search");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }

    </script>
    <script src="/js/sweet.js"></script>

    @include('sweetalert::alert')
    <script src="/panel/assets/vendors/select2/js/select2.min.js"></script>
    <script src="/panel/assets/js/examples/select2.js"></script>
    <script src="/panel/assets/vendors/ckeditor/ckeditor.js"></script>
    <script src="/panel/assets/js/examples/ckeditor.js"></script>
@endsection


