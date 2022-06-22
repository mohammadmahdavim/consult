@extends('layouts.panel')
@section('css')
    <!-- begin::datepicker -->
    <link rel="stylesheet" href="/panel/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="/panel/assets/vendors/datepicker/daterangepicker.css">
    <!-- end::datepicker -->
@endsection
@section('content')
    <main class="main-content">

        <div class="container-fluid">
            <!-- begin::page header -->
            <div class="page-header">
                <div>
                    <h3>دوره های {{$student->user->name}} {{$student->user->family}}</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/panel/home">داشبورد</a></li>
                            <li class="breadcrumb-item active" aria-current="page">دوره
                                های {{$student->user->name}} {{$student->user->family}}</li>
                        </ol>
                    </nav>
                </div>

            </div>
            <!-- end::page header -->
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h5>لیست دوره های {{$student->user->name}} {{$student->user->family}}</h5>
                        <!-- Button trigger modal -->
                        @can('service-create-student')
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#exampleModal">
                                ایجاد دوره جدید
                            </button>
                    @endcan
                    <!-- Modal -->
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr style="text-align: center">
                                <th>#</th>
                                <th>مشاور</th>
                                <th>دوره</th>
                                <th>تاریخ شروع</th>
                                <th>تاریخ پایان</th>
                                <th>وضعیت</th>
                                @can('service-create-student')

                                    <th>عملیات</th>
                                @endcan
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($student->service as $key=>$row)
                                <tr style="text-align: center">
                                    <td>{{$key+1}}</td>

                                    <td>

                                        <a href="/panel/consult/finance/{{$row->consult->id}}">
                                           <span class="badge badge-info">

                                        {{$row->consult->user->name}} {{$row->consult->user->family}}
                                         </span>
                                        </a>

                                    </td>
                                    <td>
                                        <span class="badge badge-success">
                                             {{$row->service->title}}
                                        </span>
                                    </td>

                                    <td>{{$row->start}}</td>
                                    <td>{{$row->end}}</td>
                                    <td>
                                        @if($row->active==1)
                                            فعال
                                        @else
                                            غیر فعال
                                        @endif
                                    </td>
                                    @can('service-create-student')

                                        <td>
                                            <div class="modal-dark mr-1 mb-1 d-inline-block">
                                                <!-- Button trigger modal -->

                                                <button class="btn btn-success btn-sm" title="ویرایش"
                                                        onclick="modal_show('{{$row->id}}','/panel/student/serviceShow');">
                                                    <i class="icon ti-pencil"></i>
                                                </button>
                                                <!-- Modal -->
                                                <!-- end modal -->
                                            </div>
                                            <div class="modal-dark mr-1 mb-1 d-inline-block">
                                                <!-- Button trigger modal -->
                                                <button
                                                    onclick="modal_show('{{$row->id}}','/panel/student/serviceFinance');"
                                                    class="btn btn-primary btn-sm" title="مالی">
                                                    <i class="icon ti-money"></i>
                                                </button>

                                            </div>

                                            <x-destroy :id="$row->id" url="'/panel/student/service/destroy'"/>

                                        </td>
                                    @endcan
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <form action="/panel/student/service/store" method="post">
                                @csrf
                                <input type="hidden" value="{{$student->id}}" name="student_id">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">ایجاد دوره</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <span>مشاور</span>
                                                <select class="form-control" name="consult_id">
                                                    @foreach($consults as $consult)
                                                        <option @if($student->service!='[]') @if($row->consult->id==$consult->id) selected @endif @endif
                                                            value="{{$consult->id}}">{{$consult->user->name}} {{$consult->user->family}}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                            <div class="col-6">
                                                <span>دوره</span>

                                                <select class="form-control" name="service_id">
                                                    @foreach($services as $service)
                                                        <option
                                                            value="{{$service->id}}">{{$service->title}}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                            <div class="col-6">
                                                <br>

                                                <span>تاریخ شروع</span>

                                                <input class="form-control" name="start" id="date-picker-shamsi"
                                                       autocomplete="off" required>

                                            </div>
                                            <div class="col-6">
                                                <br>

                                                <span>تاریخ پایان</span>

                                                <input class="form-control" name="end" id="date-picker-shamsi-new"
                                                       autocomplete="off" required>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">بستن
                                        </button>
                                        <button type="submit" class="btn btn-primary">ثبت</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </main>
    @include('include.modal.show')

@endsection
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
@endsection


