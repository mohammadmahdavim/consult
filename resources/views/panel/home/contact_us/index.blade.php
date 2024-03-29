@extends('layouts.panel')
@section('css')
    <link rel="stylesheet" href="/panel/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="/panel/assets/vendors/datepicker/daterangepicker.css">
@endsection
@section('content')
    <main class="main-content">

        <div class="container-fluid">
            <!-- begin::page header -->
            <div class="page-header">
                <div>
                    <h3>لیست درخواست تماس ها</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/panel/home">داشبورد</a></li>
                            <li class="breadcrumb-item active" aria-current="page">لیست درخواست تماس ها</li>
                        </ol>
                    </nav>
                </div>

            </div>
            <!-- end::page header -->
            <div class="card">
                <div class="card-body">
                    <button type='button' class="btn btn-primary" onclick="hideshow()"
                            id='hideshow'>
                        جستجوی پیشرفته
                    </button>
                    <div id='search' style="display: none">
                        <form method="get" action="/panel/home/contact_us">
                            <div class="d-flex flex-row">
                                <div class="p-2">
                                    <span>نام</span>
                                    <input class="form-control" id="name" name="name"
                                           value="{{request()->name}}"
                                           placeholder="نام">
                                </div>
                                <div class="p-2">
                                    <span> انتخاب پایه</span>
                                    <select class="form-control" dir="rtl"
                                            name="paye">
                                        <option></option>
                                        @foreach($payes as $paye)
                                            <option value="{{$paye->id}}"
                                                    @if(request()->paye==$paye->id) selected @endif>{{$paye->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="p-2">
                                    <span> انتخاب وضعیت</span>
                                    <select class="form-control" dir="rtl"
                                            name="status">
                                        <option></option>
                                        <option
                                            @if(request()->status=='ثبت نام شد') selected @endif>
                                            ثبت نام شد
                                        </option>
                                        <option
                                            @if(request()->status=='ثبت نام نمیکنه') selected @endif>
                                            ثبت نام نمیکنه
                                        </option>
                                        <option
                                            @if(request()->status=='نیاز به پیگیری مجدد') selected @endif>
                                            نیاز به پیگیری مجدد
                                        </option>
                                        <option
                                            @if(request()->status=='تکراری') selected @endif>
                                            تکراری
                                        </option>
                                    </select>
                                </div>
                                <div class="p-2">
                                    <br>
                                    <button type="submit" class="btn btn-info">جستجوکن</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <a href="/panel/home/contact_us/export">
                        <button class="btn btn-danger">خروجی اکسل</button>
                    </a>
                    <div class="card-title">
                        <h5>لیست درخواست تماس ها</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr style="text-align: center">
                                <th>نام</th>
                                <th>شماره موبایل</th>
                                <th>کد ملی</th>
                                <th>رشته</th>
                                <th>پایه</th>
                                <th>
                                    تاریخ ثبت دانش آموز
                                </th>
                                <th>کامنت</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contacts as $row)
                                <tr @if($row->status=='ثبت نام شد' and $row->last_call_date) style="text-align: center;background-color:green"
                                    @elseif($row->status=='ثبت نام نمیکنه' and $row->last_call_date) style="text-align: center;background-color: red"
                                    @elseif($row->status=='نیاز به پیگیری مجدد' and $row->last_call_date) style="text-align: center;background-color:yellow"
                                    @elseif($row->status=='تکراری' and $row->last_call_date) style="text-align: center;background-color:grey"
                                    @else style="text-align: center"
                                    @endif
                                >
                                    <td>{{$row->name}}</td>
                                    <td>{{$row->mobile}}</td>
                                    <td>{{$row->national_code}}</td>
                                    <td>{{$row->FieldSchool->title}}</td>
                                    <td>{{$row->payeSchool->title}}</td>
                                    <td>
                                        {{\Morilog\Jalali\Jalalian::forge($row->created_at)}}

                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#exampleModalLong{{$row->id}}">
                                            ثبت وضعیت
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalLong{{$row->id}}" tabindex="-1"
                                             role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="exampleModalLongTitle">{{$row->name}}</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="/panel/home/contact/update/{{$row->id}}"
                                                              method="post">
                                                            @csrf
                                                            <div class="row">

                                                                <div class="col-md-3">
                                                                    <label>تاریخ آخرین تماس</label>
                                                                    <input name="date-picker-shamsi"
                                                                           class="form-control"
                                                                           value="{{$row->last_call_date}}">
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label>وضعیت</label>
                                                                    <select name="status" class="form-control">
                                                                        <option></option>
                                                                        <option
                                                                            @if($row->status=='ثبت نام شد') selected @endif>
                                                                            ثبت نام شد
                                                                        </option>
                                                                        <option
                                                                            @if($row->status=='ثبت نام نمیکنه') selected @endif>
                                                                            ثبت نام نمیکنه
                                                                        </option>
                                                                        <option
                                                                            @if($row->status=='نیاز به پیگیری مجدد') selected @endif>
                                                                            نیاز به پیگیری مجدد
                                                                        </option>
                                                                        <option
                                                                            @if($row->status=='تکراری') selected @endif>
                                                                            تکراری
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row">

                                                                <div class="col-md-9">
                                                                    <label>کامنت</label>
                                                                    <textarea name="description" class="form-control">
                                                               {!! $row->description !!}
                                                            </textarea>
                                                                </div>

                                                            </div>
                                                            <br>
                                                            <button class="btn btn-block btn-success">submit</button>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    {{--                                    <td style="text-align: center">--}}


                                    {{--                                        <input style="text-align: center" type="checkbox" class="form-check-input"--}}
                                    {{--                                               id="materialUnchecked"--}}
                                    {{--                                               {{ $row->read ? 'checked' : '' }} onclick="changeStatus('{{$row->id}}',this) ">--}}
                                    {{--                                    </td>--}}
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>

        </div>
        {{$contacts->withQueryString()->links()}}
    </main>
@endsection
@section('js')
    <script src="/js/sweet.js"></script>

    @include('sweetalert::alert')
    <script>
        function changeStatus(id, obj) {
            var $input = $(obj);
            var read = 0;
            if ($input.prop('checked')) {
                var read = 1;
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
                            url: "/panel/home/contact_us/changeStatus" + '/' + id + '/' + read,
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
    <!-- begin::datepicker -->
    <script src="/panel/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.js"></script>
    <script src="/panel/assets/vendors/datepicker-jalali/bootstrap-datepicker.fa.min.js"></script>
    <script src="/panel/assets/vendors/datepicker/daterangepicker.js"></script>
    <script src="/panel/assets/js/examples/datepicker.js"></script>
    <!-- end::datepicker -->
    <script>
        function hideshow() {
            var x = document.getElementById("search");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }

    </script>
@endsection


