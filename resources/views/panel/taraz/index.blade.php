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
                    <h3>لیست ترازها</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/panel/home">داشبورد</a></li>
                            <li class="breadcrumb-item active" aria-current="page">لیست ترازها</li>
                        </ol>
                    </nav>
                </div>

            </div>
            <!-- end::page header -->
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h5>لیست ترازها</h5>

                    </div>
                    <div class="table-responsive">
                        <table id="example1" class="table table-striped table-bordered">
                            <thead>
                            <tr style="text-align: center">

                                <th>مشاور</th>
                                <th>تعداد دانش آموز</th>
                                <th>تعداد ثبت</th>


                            </tr>
                            </thead>
                            <tbody>
                            @foreach($notSendConsults as $key=>$notSendConsult)

                                <tr style="text-align: center">


                                    <td>{{$notSendConsult->user->name}} {{$notSendConsult->user->family}}</td>
                                    <td>{{count($notSendConsult['serviceActive'])}}
                                    </td>


                                    <td>0</td>


                                </tr>
                            @endforeach
                            @foreach($rows as $key=>$row)

                                <tr style="text-align: center">


                                    <td>{{$row[0]['authortaraz']->name}} {{$row[0]['authortaraz']->family}}</td>
                                    <td>{{count($row[0]['authortaraz']['consult']['serviceActive'])}}
                                    </td>


                                    <td>{{count($row)}}</td>


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
    <script src="/panel/assets/vendors/dataTable/jquery.dataTables.min.js"></script>
    <script src="/panel/assets/vendors/dataTable/dataTables.bootstrap4.min.js"></script>
    <script src="/panel/assets/vendors/dataTable/dataTables.responsive.min.js"></script>
    <script src="/panel/assets/js/examples/datatable.js"></script>
@endsection


