@extends('layouts.panel')
@section('css')

@endsection
@section('content')
    <main class="main-content">

        <div class="container-fluid">

            <!-- begin::page header -->
            <div class="page-header">
                <div>
                    <h3>مالی دانش آموز</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/panel/home">داشبورد</a></li>
                            <li class="breadcrumb-item active" aria-current="page">مالی دانش آموز</li>
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
                                <div class="p-2"><b>نام:</b> {{$student->user->name}} {{$student->user->family}}</div>
                                <div class="p-2"><b>کد ملی:</b> {{$student->user->national_code}}</div>
                                <div class="p-2"><b>شهر:</b> {{$student->state->title}} ({{$student->city->title}})
                                </div>
                                <div class="p-2"><b>پایه:</b> {{$student->paye->title}}</div>
                                <div class="p-2"><b>رشته:</b> {{$student->field->title}}</div>
                                <div class="p-2"><b>تاریخ ثبت
                                        نام:</b> {{\Morilog\Jalali\Jalalian::forge($student->created_at)->format('%A, %d %B %y')  }}
                                </div>
                            </div>
                            @if($student->user->transaction)
                                <div class="d-flex flex-row">
                                    <div class="p-2"><b>کل
                                            مالی:</b> {{number_format($student->user->transaction->total)}}</div>
                                    <div class="p-2"><b>کل
                                            پرداختی:</b>{{number_format($student->user->transaction->paid)}}</div>
{{--                                    <div class="p-2">--}}
{{--                                        <b>مانده:</b> {{number_format($student->user->transaction->remaining)}}</div>--}}
                                </div>
                            @endif
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
                                    <colgroup>
                                        <col span="3" style="background-color: #D6EEEE">
                                    </colgroup>
                                    <tr style="text-align: center">
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th colspan="10" scope="colgroup">مالی</th>

                                    </tr>
                                    <tr style="text-align: center">
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th colspan="2" scope="colgroup">دانش آموز</th>
                                        <th colspan="2" scope="colgroup">مشاور</th>
                                        <th colspan="2" scope="colgroup">مدیر</th>
                                        <th colspan="2" scope="colgroup">جذب</th>


                                    </tr>
                                    <tr style="text-align: center">
                                        <th>#</th>
                                        <th>مشاور</th>
                                        <th>دوره</th>
                                        <th>مبلغ</th>
                                        <th>تاریخ</th>
                                        <th>مبلغ</th>
                                        <th>تاریخ</th>
                                        <th>مبلغ</th>
                                        <th>تاریخ</th>
                                        <th>مبلغ</th>
                                        <th>تاریخ</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $student = 0;
                                    $consult = 0;
                                    $caller = 0;
                                    $manager = 0;
                                    $site = 0;
                                    ?>
                                    @foreach($services as $key=>$service)
                                        <tr style="text-align: center">
                                            <td>{{$key+1}}</td>
                                            <td>
                                                <a href="/panel/consult/finance/{{$service->consult->id}}">

                                                {{$service->consult->user->name}} {{$service->consult->user->family}}
                                                </a>
                                            </td>
                                            <td>{{$service->service->title}}</td>
                                            <td>{{number_format($service->finance->where('type_id',1)->pluck('amount')->first())}}</td>
                                            <td>{{$service->finance->where('type_id',1)->pluck('date')->first()}}</td>
                                            <td>{{number_format($service->finance->where('type_id',2)->pluck('amount')->first())}}</td>
                                            <td>{{$service->finance->where('type_id',2)->pluck('date')->first()}}</td>
                                            <td>{{number_format($service->finance->where('type_id',4)->pluck('amount')->first())}}</td>
                                            <td>{{$service->finance->where('type_id',4)->pluck('date')->first()}}</td>
                                            @if($key==0)
                                            <td style="text-align: center" rowspan="{{$services->count()}}">{{number_format($service->finance->where('type_id',3)->pluck('amount')->first())}}</td>
                                            <td rowspan="{{$services->count()}}">{{$service->finance->where('type_id',3)->pluck('date')->first()}}</td>

                                            @endif
                                            <?php
                                            $student = $student + $service->finance->where('type_id', 1)->pluck('amount')->first();
                                            $consult = $consult + $service->finance->where('type_id', 2)->pluck('amount')->first();
                                            $caller = $caller + $service->finance->where('type_id', 3)->pluck('amount')->first();
                                            $manager = $manager + $service->finance->where('type_id', 4)->pluck('amount')->first();
                                            $site = $site + $service->finance->where('type_id', 5)->pluck('amount')->first();
                                            ?>
                                        </tr>
                                    @endforeach

                                    <tr style="text-align: center">
                                        <td colspan="3" scope="colgroup">جمع پرداخت ها</td>
                                        <td colspan="2">{{number_format($student)}}</td>
                                        <td colspan="2">{{number_format($consult)}}</td>
                                        <td colspan="2">{{number_format($manager)}}</td>
                                        <td colspan="2">{{number_format($caller)}}</td>

                                    </tr>
                                    <tr style="text-align: center">
                                        <td colspan="3" scope="colgroup">مانده</td>
                                        <td colspan="10">{{number_format($student-$consult-$caller-$manager-$site)}}</td>
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


