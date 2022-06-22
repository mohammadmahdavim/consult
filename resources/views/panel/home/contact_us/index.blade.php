@extends('layouts.panel')
@section('css')
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
                                <th>رسیدگی</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contacts as $row)
                                <tr @if($row->read==1) style="text-align: center;background-color: red"
                                    @else style="text-align: center" @endif>
                                    <td>{{$row->name}}</td>
                                    <td>{{$row->mobile}}</td>
                                    <td>{{$row->national_code}}</td>
                                    <td>{{$row->FieldSchool->title}}</td>
                                    <td>{{$row->payeSchool->title}}</td>
                                    <td style="text-align: center">
                                        <input style="text-align: center" type="checkbox" class="form-check-input"
                                               id="materialUnchecked"
                                               {{ $row->read ? 'checked' : '' }} onclick="changeStatus('{{$row->id}}',this) ">
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>

        </div>
        {{$contacts->links()}}
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
@endsection


