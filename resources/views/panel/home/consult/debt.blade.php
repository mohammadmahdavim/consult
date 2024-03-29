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
                            <li class="breadcrumb-item active" aria-current="page">بدهکاری</li>
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
                                <form method="get" action="/panel/home/consult_debt_export">
                                    @csrf
                                    <button type='submit' class="btn btn-warning">
                                        دریافت فایل
                                    </button>
                                </form>

                            </div>
                        </div>

                    </div>
                    <div class="table-responsive">
                        <table id="example1" class="table table-striped table-bordered">
                            <thead>
                            <tr style="text-align: center">


                                <th>#</th>
                                <th>مدیر</th>
                                <th>سرمشاور</th>
                                <th>مشاور</th>
                                <th>دانش‌آموز</th>
                                <th>دوره</th>
                                <th>پایان دوره</th>


                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rows as $key=>$row)

                                <tr>

                                    <td>
                                        {{$key+1}}
                                    </td>
                                    <td>
                                        {{$row->service->student->manager->name}}  {{$row->service->student->manager->family}}

                                    </td>
                                    <td>
                                        {{$row->service->student->super_consult->name}}  {{$row->service->student->super_consult->family}}

                                    </td>
                                    <td>
                                        <a href="/panel/consult/finance/{{$row->service->consult->id}}">
                                            {{$row->service->consult->user->name}}  {{$row->service->consult->user->family}}

                                        </a>
                                    </td>
                                    <td>
                                        <a href="/panel/student/finance/{{$row->service->student->id}}">

                                            {{$row->service->student->user->name}}  {{$row->service->student->user->family}}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="/panel/student/service/{{$row->service->student->id}}">

                                            {{$row->service->service->title}} ( {{$row->service->service->price}})
                                        </a>
                                    </td>
                                    <td>
                                        {{$row->service->end}}
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
    @include('include.modal.show')
@endsection
@section('js')
    <!-- begin::dataTable -->
    <script src="/panel/assets/vendors/dataTable/jquery.dataTables.min.js"></script>
    <script src="/panel/assets/vendors/dataTable/dataTables.bootstrap4.min.js"></script>
    <script src="/panel/assets/vendors/dataTable/dataTables.responsive.min.js"></script>
    <script src="/panel/assets/js/examples/datatable.js"></script>
    <!-- end::dataTable -->
    <script src="/js/sweet.js"></script>

    @include('sweetalert::alert')
@endsection


