@extends('layouts.panel')
@section('css')
@endsection
@section('content')
    <main class="main-content">

        <div class="container-fluid">
            <!-- begin::page header -->
            <div class="page-header">
                <div>
                    <h3>رضایت</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/panel/home">داشبورد</a></li>
                            <li class="breadcrumb-item active" aria-current="page">رضایت</li>
                        </ol>
                    </nav>
                </div>

            </div>

            <!-- end::page header -->
            <div class="card">
                <div class="card-body">

                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#create">
                        ثبت جدید
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="create" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="/panel/satisfaction" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <label for="file">تصویر </label>
                                        <input type="file" class="form-control" id="file" name="file[]" multiple>
                                        <br>
                                        <button type="submit" class="btn btn-info btn-block">ثبت</button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="card-title">
                        <br>
                        <h5>لیست </h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr style="text-align: center">
                                <th>تصویر</th>
                                <th>حذف</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rows as $row)
                                <tr style="text-align: center">

                                    <td>
                                        @foreach($row->images as $image)
                                            <img width="200" height="300" src="{{asset('service_photos')}}/{{$image->file }}" id="previewImg"
                                                 alt="Partner Image">&nbsp;
                                        @endforeach
                                    </td>
                                    <td>
                                        <x-destroy :id="$row->id" url="'/panel/deleteSatisfaction'"/>

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
@endsection
@section('js')

    <script src="/js/sweet.js"></script>

    @include('sweetalert::alert')
@endsection


