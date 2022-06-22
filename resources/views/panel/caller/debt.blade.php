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
                            <li class="breadcrumb-item active" aria-current="page">جذب کنندگان</li>
                            <li class="breadcrumb-item active" aria-current="page">بدهکاری</li>
                        </ol>
                    </nav>
                </div>

            </div>
            <!-- end::page header -->
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h5>لیست جذب کنندگان</h5>
                        <div class="heading-elements">
                            <div class="d-flex flex-row">
                                <form method="get" action="/panel/caller_debt_export">
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
                                <th>جذب کننده</th>
                                <th>دانش ‌آموز</th>
                                <th>دوره</th>
                                <th>شروع دوره</th>


                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rows as $key=>$row)

                                <tr>

                                    <td>
                                        {{$key+1}}
                                    </td>
                                    <td>
                                        <a href="/panel/caller/finance/{{$row->service->student->callerStudent->id}}">
                                            {{$row->service->student->callerStudent->name}}  {{$row->service->student->callerStudent->family}}

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
                                        {{$row->service->start}}
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


