@extends('layouts.panel')
@section('css')
@endsection
@section('content')
    <main class="main-content">

        <div class="container-fluid">

            <!-- begin::page header -->
            <div class="page-header">
                <div>
                    <h3>داشبورد</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">داشبورد</a></li>
                            <li class="breadcrumb-item active" aria-current="page">پیش فرض</li>
                        </ol>
                    </nav>
                </div>

            </div>
            <!-- end::page header -->
            @if(auth()->user()->role=='consult')
                <div class="row">
                    <div class="col-lg-4 col-sm-12">

                        <div class="card overflow-hidden">
                            <div class="card-body text-center">
                                <div class="d-flex align-items-center justify-content-center m-b-10">
                                    <div class="icon-block icon-block-outline-primary icon-block-floating m-l-20">
                                        <i class="ti-user"></i>
                                    </div>
                                    <h2 class="m-b-0 text-primary font-weight-800 primary-font">{{$studentsActive}}</h2>
                                </div>
                                <p>تعداد دانش آموز فعال</p>
                            </div>
                            <div class="sparkline-demo1" style="margin: 0 -2px -3px -2px"></div>
                        </div>

                    </div>
                    <div class="col-lg-4 col-md-12">

                        <div class="card overflow-hidden">
                            <div class="card-body text-center">
                                <div class="d-flex align-items-center justify-content-center m-b-10">
                                    <div class="icon-block icon-block-outline-danger icon-block-floating m-l-20">
                                        <i class="ti-user"></i>
                                    </div>
                                    <h2 class="m-b-0 text-danger font-weight-800 primary-font">{{$studentsDeactive}}</h2>
                                </div>
                                <p>تعداد دانش آموز غیرفعال</p>
                            </div>
                            <div class="sparkline-demo2" style="margin: 0 -2px -3px -2px"></div>
                        </div>

                    </div>
                    <div class="col-lg-4 col-md-12">

                        <div class="card overflow-hidden">
                            <div class="card-body text-center">
                                <div class="d-flex align-items-center justify-content-center m-b-10">
                                    <div class="icon-block icon-block-outline-success icon-block-floating m-l-20">
                                        <i class="ti-server"></i>
                                    </div>
                                    <h2 class="m-b-0 text-success font-weight-800 primary-font">{{number_format($amount)}}</h2>
                                </div>
                                <p>درآمد شما </p>
                            </div>
                            <div class="sparkline-demo3" style="margin: 0 -2px -3px -2px"></div>
                        </div>

                    </div>
{{--                    <div class="col-lg-4 col-md-12">--}}

{{--                        <div class="card overflow-hidden">--}}
{{--                            <div class="card-body text-center">--}}
{{--                                <div class="d-flex align-items-center justify-content-center m-b-10">--}}
{{--                                    <div class="icon-block icon-block-outline-warning icon-block-floating m-l-20">--}}
{{--                                        <i class="ti-server"></i>--}}
{{--                                    </div>--}}
{{--                                    <h2 class="m-b-0 text-warning font-weight-800 primary-font">1200000</h2>--}}
{{--                                </div>--}}
{{--                                <p>درآمد که میتوانستید داشته باشید. </p>--}}
{{--                            </div>--}}
{{--                            <div class="sparkline-demo4" style="margin: 0 -2px -3px -2px"></div>--}}
{{--                        </div>--}}

{{--                    </div>--}}
                </div>
            @endif

            {{--            <div class="card">--}}
            {{--                <div class="card-body">--}}
            {{--                    <form class="form-control" method="post" enctype="multipart/form-data" action="/panel/uploadExcel">--}}
            {{--                        @csrf--}}
            {{--                        <div class="row">--}}
            {{--                            <div class="col-md-12"> <input name="import_file" class="form-control" type="file"></div>--}}
            {{--                            <div class="col-md-12">                        <button type="submit" class="btn btn-block btn-success">submit</button>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}

            {{--                    </form>--}}
            {{--                </div>--}}
            {{--            </div>--}}


        </div>

    </main>

@endsection
@section('js')
    @include('sweetalert::alert')

@endsection


