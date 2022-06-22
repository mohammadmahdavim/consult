@extends('layouts.panel')
@section('css')
@endsection
@section('content')
    <main class="main-content">

        <div class="container-fluid">
            <!-- begin::page header -->
            <div class="page-header">
                <div>
                    <h3>مطالب پیشنهادی</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/panel/home">داشبورد</a></li>
                            <li class="breadcrumb-item active" aria-current="page">مطالب پیشنهادی</li>
                        </ol>
                    </nav>
                </div>

            </div>
            <!-- end::page header -->
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h5>لیست مطالب پیشنهادی</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr style="text-align: center">
                                <th>عنوان</th>
                                <th>لینک</th>
                                <th>توضیحات</th>
                                <th>فایل</th>
                                <th>ویرایش</th>
                                <th>حذف</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rows as $row)
                                <tr style="text-align: center">
                                    <td>{{$row->title}}</td>
                                    <td><a href="{{$row->link}}">{{$row->link}}</a></td>
                                    <td>{!! $row->body !!}</td>
                                    <td>
                                        @foreach($row->images as $image)
                                            <a href="/download/Suggest_photos/{{$image->file}}"   class="btn btn-outline-dark">
                                                <i class="icon-download"></i> دانلود </a>

                                            <x-destroy :id="$image->id" url="'/panel/deleteImage'"/>
                                            &nbsp;
                                        @endforeach
                                    </td>
                                    <td>

                                        <a href="/panel/suggest/{{$row->id}}/edit">
                                            <button class="btn btn-success btn-sm" title="ویرایش">
                                                <i class="icon ti-pencil"></i>
                                            </button>
                                        </a>

                                    </td>
                                    <td>
                                        <x-destroy :id="$row->id" url="'/panel/deleteSuggest'"/>

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


