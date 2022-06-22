@extends('layouts.panel')
@section('css')
@endsection
@section('content')
    <main class="main-content">

        <div class="container-fluid">
            <!-- begin::page header -->
            <div class="page-header">
                <div>
                    <h3>خدمات</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/panel/home">داشبورد</a></li>
                            <li class="breadcrumb-item active" aria-current="page">خدمات</li>
                        </ol>
                    </nav>
                </div>

            </div>
            <!-- end::page header -->
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h5>لیست خدمات</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr style="text-align: center">
                                <th>عنوان</th>
                                <th>مبلغ</th>
                                <th>توضیح کوتاه</th>
                                <th>توضیحات</th>
                                <th>تصاویر</th>
                                <th>نمایش</th>
                                <th>ویرایش</th>
                                <th>حذف</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rows as $row)
                                <tr style="text-align: center">
                                    <td>{{$row->title}}</td>
                                    <td>{{$row->price}}</td>
                                    <td>{{$row->little_body}}</td>
                                    <td>{!! $row->body !!}</td>
                                    <td>
                                        @foreach($row->images as $image)
                                            <img src="{{asset('service_photos')}}/{{$image->file }}" id="previewImg"
                                                 alt="Partner Image">

                                            <x-destroy :id="$image->id" url="'/panel/deleteImage'"/>
                                            &nbsp;
                                        @endforeach
                                    </td>
                                    <td>

                                        <input style="text-align: right" type="checkbox" class="form-check-input"
                                               id="materialUnchecked"
                                               {{ $row->active ? 'checked' : '' }} onclick="toggless('{{$row->id}}',this) ">
                                    </td>
                                    <td>

                                        <a href="/panel/home/service/{{$row->id}}/edit">
                                            <button class="btn btn-success btn-sm" title="ویرایش">
                                                <i class="icon ti-pencil"></i>
                                            </button>
                                        </a>

                                    </td>
                                    <td>
                                        <x-destroy :id="$row->id" url="'/panel/home/deleteService'"/>

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
    <script>
        function toggless(id, obj) {
            var $input = $(obj);
            var active = 0;
            if ($input.prop('checked')) {
                var active = 1;
            }

            $.ajaxSetup({

                'headers': {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $.ajax({
                url: '{{url('/panel/home/service/changeStatus')}}',
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    active: active,
                    "id": id
                },
                success: function (data) {
                    if (active == 1) {
                        swal.fire({
                            title: "وضعیت نمایش دوره فعال شد",
                            icon: "success",

                        });
                    }
                    if (active == 0) {
                        swal.fire({
                            title: "وضعیت نمایش دوره غیر فعال شد",
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


