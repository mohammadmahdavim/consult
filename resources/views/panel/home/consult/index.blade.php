@extends('layouts.panel')
@section('css')
    <link rel="stylesheet" href="/panel/assets/vendors/dataTable/responsive.bootstrap.min.css" type="text/css">
@endsection
@section('content')
    <main class="main-content">

        <div class="container-fluid">
            <!-- begin::page header -->
            <div class="page-header">
                <div>
                    <h3>مشاوران</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/panel/home">داشبورد</a></li>
                            <li class="breadcrumb-item active" aria-current="page">مشاوران</li>
                        </ol>
                    </nav>
                </div>

            </div>
            <!-- end::page header -->
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h5>لیست مشاوران</h5>
                        <div class="heading-elements">
                            <div class="d-flex flex-row">
                                @can('consult-create')
                                <div class="p-2">
                                    <a href="{{url('panel/home/consult/create')}}" class="btn  btn-success">افزودن <i
                                            class="fa fa-plus"></i></a>
                                </div>
                                @endcan
                                <div class="p-2">

                                    <form method="get" action="/panel/home/consults/export">

                                        <button type='submit' class="btn btn-warning">
                                            دریافت فایل
                                        </button>
                                    </form>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="table-responsive">
                        <table id="example1" class="table table-striped table-bordered">
                            <thead>
                            <tr style="text-align: center">

                                <th>نام</th>
                                <th>رتبه</th>
                                <th>دانشگاه</th>
                                <th>تصویر</th>
                                <th>ظرفیت</th>
                                @can('consult-create')
                                    <th>عملیات</th>
                                    &nbsp;@endcan
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rows as $key=>$row)

                                <tr @if($row->read==1)  style="text-align: center;background-color: #000a0c;color: white"
                                    @else style="text-align: center" @endif>


                                    <td>{{$row->user->name}} {{$row->user->family}}
                                    </td>


                                    <td>{{$row->rank}}</td>
                                    <td>{{$row->university->title}}</td>
                                    <td>
                                        @foreach($row->user->images as $image)
                                            <img height="50px" width="50px"
                                                 src="{{asset('user_photos')}}/{{$image->file }}" id="previewImg"
                                                 alt="Partner Image">
                                            @can('consult-create')
                                                <x-destroy :id="$image->id" url="'/panel/deleteImage'"/>
                                                &nbsp;@endcan
                                        @endforeach

                                    </td>
                                    <td>{{$row->capacity-$row->serviceActive->count()}} از {{$row->capacity}}  </td>
                                    @can('consult-create')
                                        <td>


                                            <input style="text-align: right" type="checkbox" class="form-check-input"
                                                   id="materialUnchecked"
                                                   {{ $row->show ? 'checked' : '' }} onclick="toggless('{{$row->id}}',this) ">
                                            @can('finance-consult')
                                            <a href="/panel/consult/finance/{{$row->id}}">
                                                <button class="btn btn-primary btn-sm" title="مالی">
                                                    <i class="icon ti-money"></i>
                                                </button>
                                            </a>
                                            @endcan
                                            <button class="btn btn-info btn-sm" title="دانش آموزان"
                                                    onclick="modal_show('{{$row->id}}','/panel/consult/student');">
                                                <i class="icon ti-user"></i>
                                            </button>

                                            <a href="/panel/home/consult/{{$row->id}}/edit">
                                                <button class="btn btn-success btn-sm" title="ویرایش">
                                                    <i class="icon ti-pencil"></i>
                                                </button>
                                            </a>

                                            <x-destroy :id="$row->id" url="'/panel/home/deleteConsult'"/>
                                            <div class="accordion custom-accordion">


                                                <div class="accordion-row">
                                                    <a href="#" class="accordion-header">
                                            <span>دانش آموزان
</span>
                                                        <i class="accordion-status-icon close fa fa-chevron-up"></i>
                                                        <i class="accordion-status-icon open fa fa-chevron-down"></i>
                                                    </a>
                                                    <div class="accordion-body">
                                                        <ol>
                                                            @foreach($row->serviceActive as $service)
                                                                <li>
                                                                    <a target="_blank" href="/panel/student/service/{{$service->student->id}}">
                                                                        {{$service->student->user->name}} {{$service->student->user->family}}
                                                                    </a>
                                                                     <button type="button" class="btn btn-warning btn-sm" title="پرونده"
                                                        onclick="modal_show('{{$service->student->id}}','/panel/comments');">
                                                    <i class="fa fa-file-text-o"></i>
                                                </button>
                                                                </li>
                                                            @endforeach
                                                        </ol>
                                                    </div>
                                                </div>
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
    </main>
    @include('include.modal.show')
@endsection
@section('js')
    <!-- begin::dataTable -->
    <script src="/panel/assets/vendors/dataTable/jquery.dataTables.min.js"></script>
    <script src="/panel/assets/vendors/dataTable/dataTables.bootstrap4.min.js"></script>
    <script src="/panel/assets/vendors/dataTable/dataTables.responsive.min.js"></script>
    <script src="/panel/assets/js/examples/datatable.js"></script>
    <!-- end::dataTable -->
    <script>
        function toggless(id, obj) {
            var $input = $(obj);
            var show = 0;
            if ($input.prop('checked')) {
                var show = 1;
            }

            $.ajaxSetup({

                'headers': {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $.ajax({
                url: '{{url('/panel/home/changeStatusShowConsults')}}',
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    show: show,
                    "id": id
                },
                success: function (data) {
                    if (show == 1) {
                        swal.fire({
                            title: "وضعیت نمایش مشاور فعال شد",
                            icon: "success",

                        });
                    }
                    if (show == 0) {
                        swal.fire({
                            title: "وضعیت نمایش مشاور غیر فعال شد",
                            icon: "success",

                        });
                    }
                }
            })


        }
    </script>
    <script src="/js/sweet.js"></script>

    @include('sweetalert::alert')
@endsection


