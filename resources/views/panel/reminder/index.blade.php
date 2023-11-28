@extends('layouts.panel')
@section('css')
@endsection
@section('content')
    <main class="main-content">

        <div class="container-fluid">
            <!-- begin::page header -->
            <div class="page-header">
                <div>
                    <h3>اعلان ها</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/panel/home">داشبورد</a></li>
                            <li class="breadcrumb-item active" aria-current="page">اعلان ها</li>
                        </ol>
                    </nav>
                </div>

            </div>
            <!-- end::page header -->
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h5>لیست اعلان ها</h5>

                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr style="text-align: center">
                                <th>#</th>
                                <th>دانش آموز</th>
                                <th>عملیات</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rows as $key=>$row)
                                <tr style="text-align: center">
                                    <td>{{$key+1}}</td>

                                    <td>
                                        <a href="/panel/student/service/{{$row->user->student->id}}">
                                            {{$row->user->name}} {{$row->user->family}}
                                        </a>
                                    </td>
                                    <td style="text-align: center">
                                        <x-destroy :id="$row->id" url="'/panel/reminder/destroy'"/>

                                    @can('service-show-student')
                                            <button type="button" class="btn btn-warning btn-sm" title="پرونده"
                                                    onclick="modal_show('{{$row->user->student->id}}','/panel/comments');">
                                                <i class="fa fa-file-text-o"></i>
                                                </button>
                                        @endcan
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
    @include('include.modal.show')

@endsection
@section('js')
    <script src="/js/sweet.js"></script>

    @include('sweetalert::alert')
    <script>
        function changeStatus(id, obj) {
            var $input = $(obj);
            var active = 0;
            if ($input.prop('checked')) {
                var active = 1;
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
                            url: "/panel/notification/changeStatus" + '/' + id + '/' + active,
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


