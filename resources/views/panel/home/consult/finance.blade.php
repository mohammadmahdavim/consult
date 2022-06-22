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
                    <h3>مالی مشاور</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/panel/home">داشبورد</a></li>
                            <li class="breadcrumb-item active" aria-current="page">مالی مشاور</li>
                        </ol>
                    </nav>
                </div>

            </div>
            <!-- end::page header -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">اطلاعات عمومی</h5>
                            <div class="d-flex flex-row">
                                <div class="p-2"><b>نام:</b> {{$consult->user->name}} {{$consult->user->family}}</div>
                                <div class="p-2"><b>کد ملی:</b> {{$consult->user->national_code}}</div>
                                <div class="p-2"><b>شهر:</b> {{$consult->state->title}} ({{$consult->city->title}})
                                </div>
                                <div class="p-2"><b>رشته:</b> {{$consult->field->title}}({{$consult->university->title}})</div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">اطلاعات مالی</h5>
                            <div class="table-responsive">
                                <table  id="example2" class="table table-striped table-bordered">
                                    <thead>
                                    <tr style="text-align: center">
                                        <th>#</th>
                                        <th>دانش آموز</th>
                                        <th>دوره</th>
                                        <th>تاریخ پرداخت</th>
                                        <th>مبلغ</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $sum = 0;
                                    ?>
                                    @foreach($consult->service as $key=>$service)
                                        <tr style="text-align: center">
                                            <td>{{$key+1}}</td>
                                            <td>{{$service->student->user->name}} {{$service->student->user->family}}</td>
                                            <td>{{$service->service->title}}
                                                @can('consult-create')
                                                ({{number_format($service->service->price)}})
                                                @endcan
                                            </td>
                                            <td>
                                                @if($service->financeConsult)

                                                    {{$service->financeConsult['date']}}

                                                @else
                                                    0
                                                @endif
                                            </td>
                                            <td>
                                                @if($service->financeConsult)
                                                    {{number_format($service->financeConsult->amount)}}
                                                    <?php
                                                    $sum = $sum + $service->financeConsult->amount;
                                                    ?>
                                                @else
                                                    0
                                                @endif
                                            </td>
                                        </tr>

                                    @endforeach
                                    <tr style="text-align: center">
                                        <td colspan="4" style="background-color: #D6EEEE">جمع پرداخت ها</td>
                                        <td>{{number_format($sum)}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

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


