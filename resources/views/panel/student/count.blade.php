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
                            <div class="d-flex flex-row">
                                <div class="p-2">
                                    <a href="{{url('panel/student/create')}}" class="btn  btn-success">افزودن <i
                                            class="fa fa-plus"></i></a>
                                </div>


                            </div>
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
                                <th>تاریخ ثبت نام</th>
                                <th>عملیات</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $id = 1;
                            ?>
                            @foreach($rows as$row)
                                <tr
                                    @if($row->status=='inactive') style="text-align: center;background-color: black"
                                    @elseif($row->status=='24') style="text-align: center;background-color: red"
                                    @elseif($row->status=='72') style="text-align: center;background-color: yellow"
                                    @elseif($row->status=='cancel') style="text-align: center;background-color: #918e99"
                                    @else style="text-align: center"
                                    @endif
                                >
                                    <td>{{$id}}</td>
                                    <?php
                                    $id = $id + 1;
                                    ?>
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
                                    <td>{{\Morilog\Jalali\Jalalian::forge($row->created_at)->format('%A, %d %B %y')  }}</td>
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
                                        @endcan
                                        @can('student-update')

                                            <a href="/panel/student/{{$row->id}}/edit">
                                                <button class="btn btn-success btn-sm" title="ویرایش">
                                                    <i class="icon ti-pencil"></i>
                                                </button>
                                            </a>
                                        @endcan
                                        @can('student-delete')

                                            <a href="/panel/student/cancel/{{$row->id}}">
                                                <button class="btn btn-dark btn-sm" title="کنسل">
                                                    <i class="icon ti-desktop"></i>
                                                </button>
                                            </a>
                                        @endcan
                                        @can('student-delete')

                                            <x-destroy :id="$row->id" url="'/panel/student/destroy'"/>
                                        @endcan
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>

        </div>
        {{--        {{ $rows->withQueryString()->links() }}--}}

    </main>
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
@endsection


