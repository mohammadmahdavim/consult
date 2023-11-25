@extends('layouts.panel')
@section('css')

@endsection
@section('content')
    <main class="main-content">

        <div class="container-fluid">

            <!-- begin::page header -->
            <div class="page-header">
                <div>
                    <h3>مالی جذب کننده</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/panel/home">داشبورد</a></li>
                            <li class="breadcrumb-item active" aria-current="page">مالی جذب کننده</li>
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
                                <div class="p-2"><b>نام:</b> {{$user->name}} {{$user->family}}</div>
                                <div class="p-2"><b>کد ملی:</b> {{$user->national_code}}</div>

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
                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <tr style="text-align: center">
                                        <th>#</th>
                                        <th>دانش آموز</th>
                                        <th>تاریخ ثبت نام</th>
                                        <th>تاریخ پرداخت</th>
                                        <th>مبلغ</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $sum = 0;
                                    $usersList=[];
                                    ?>
                                    @foreach($rows as $key=>$row)
                                        @if(!in_array($row->service->student->id, $usersList))
                                        <tr style="text-align: center">
                                            <td>{{$key+1}}</td>
                                            <td>{{$row->service->student->user->name}} {{$row->service->student->user->family}}</td>
                                            <td>{{$row->service->start}}</td>
                                            <td>{{$row->date}}</td>
                                            <td>{{number_format($row->amount)}}</td>
                                            <?php
                                            $sum = $sum + $row->amount;
                                            $usersList[]=$row->service->student->id;
                                            ?>
                                        </tr>
                                        @endif
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

@endsection


