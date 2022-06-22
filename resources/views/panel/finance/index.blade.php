@extends('layouts.panel')
@section('css')
    <style>
        #wrapper {
            margin: 0 auto;
            display: block;
            width: 960px;
        }

        #border-pagination {
            margin: 0 auto;
            padding: 0;
            text-align: center
        }

        #border-pagination li {
            display: inline;

        }

        #border-pagination li a {
            display: block;
            text-decoration: none;
            color: #000;
            padding: 5px 10px;
            border: 1px solid #ddd;
            float: left;

        }

        #border-pagination li a {
            -webkit-transition: background-color 0.4s;
            transition: background-color 0.4s
        }

        #border-pagination li a.active {
            background-color: #4caf50;
            color: #fff;
        }

        #border-pagination li a:hover:not(.active) {
            background: #ddd;
        }
    </style>
@endsection
@section('content')
    <main class="main-content">

        <div class="container-fluid">
            <!-- begin::page header -->
            <div class="page-header">
                <div>
                    <h3>پرداخت ها</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/panel/home">داشبورد</a></li>
                            <li class="breadcrumb-item active" aria-current="page">پرداخت ها</li>
                        </ol>
                    </nav>
                </div>

            </div>
            <!-- end::page header -->
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h5>لیست پرداخت ها</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr style="text-align: center">
                                <th>#</th>
                                <th>تصویر</th>
                                <th>آپلود کننده</th>
                                <th>دانش آموز</th>
                                <th>وضعیت</th>
                                <th>مبلغ</th>
                                <th>تاریخ ثبت</th>
                                <th>توضیحات</th>
                                <th>عملیات</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rows as $key=>$row)
                                <tr style="text-align: center">
                                    <td>{{$key+1}}</td>
                                    <td>
                                        @if($row->images!='[]')
                                            <img src="{{asset('finance_photos')}}/{{$row->images[0]->file }}"
                                                 width="100" height="100">
                                            <a href="/download/finance_photos/{{$row->images[0]->file}}"   class="btn btn-outline-dark">
                                                <i class="icon-download"></i> دانلود </a>
                                        @endif
                                    </td>
                                    <td>{{$row->authorRow->name}} {{$row->authorRow->family}}  </td>
                                    <td>{{$row->user->name}} {{$row->user->family}}  </td>
                                    <td style="text-align: center">
                                        <input style="text-align: center" type="checkbox" class="form-check-input"
                                               id="materialUnchecked"
                                               {{ $row->status ? 'checked' : '' }} onclick="changeStatus('{{$row->id}}',this) ">
                                    </td>
                                    <td>{{number_format($row->price)}}</td>
                                    <td>{{\Morilog\Jalali\Jalalian::forge($row->created_at)->format('%A, %d %B %y')  }}</td>

                                    <td>{!! $row->description !!}</td>
                                    <td>
                                        <x-destroy :id="$row->id" url="'/panel/deleteFinance'"/>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                        {{ $rows->links() }}
                    </div>

                </div>

            </div>

        </div>


    </main>
@endsection
@section('js')
    <script src="/js/sweet.js"></script>

    @include('sweetalert::alert')
    <script>
        function changeStatus(id, obj) {
            var $input = $(obj);
            var status = 0;
            if ($input.prop('checked')) {
                var status = 1;
            }
            swal.fire({
                title: "آیا از عملیات مطمئن هستید؟",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                showCancelButton: true,
                cancelButtonColor: '#d33',
            })
                .then((result) => {
                    if (result.value) {

                        $.ajax({
                            url: "/panel/finance/changeStatus" + '/' + id + '/' + status,
                            type: "GET",
                            success: function () {
                                swal.fire({
                                    title: "عملیات موفق",
                                    text: "عملیات  با موفقیت انجام گردید",
                                    icon: "success",
                                    timer: '3500'

                                });
                                window.location.reload(true);
                            },
                            error: function () {
                                swal.fire({
                                    title: "خطا...",
                                    // text: data.message,
                                    type: 'error',
                                    timer: '3500'
                                })

                            }
                        });
                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swal.fire(
                            'لغو',
                            'عملیات لغو گردید:)',
                            'error'
                        )

                        window.location.reload(true);
                    }
                });

        }
    </script>
@endsection


