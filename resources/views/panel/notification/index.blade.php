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
                        <div class="heading-elements">
                            <div class="d-flex flex-row">

                                <div class="p-2">
                                    <button type='button' class="btn btn-primary" onclick="hideshow()"
                                            id='hideshow'>
                                        جستجوی پیشرفته
                                    </button>
                                    <div id='search' style="display: none">
                                        <form method="get" action="/panel/notification">
                                            <div class="d-flex flex-row">
                                                <div class="p-2">
                                                    <span>نام</span>
                                                    <input class="form-control" id="name" name="name"
                                                           value="{{request()->name}}"
                                                           placeholder="نام">
                                                </div>

                                                <div class="p-2">
                                                    <span>نوع</span>
                                                    <select class="form-control" dir="rtl"
                                                            name="type_id">
                                                        <option selected value=""></option>
                                                        @foreach($types as $type)
                                                            <option value="{{$type->id}}"
                                                                    @if($type->id==request()->type_id) selected @endif>{{$type->name}}</option>
                                                        @endforeach
                                                    </select>
                                                     </div>
                                                    <div class="p-2">
                                                    <span>مدیر</span>
                                                    <select class="form-control" dir="rtl"
                                                            name="manager">
                                                        <option selected value=""></option>
                                                        @foreach($managers as $manager)
                                                            <option value="{{$manager->id}}"
                                                                    @if($manager->id==request()->manager) selected @endif>{{$manager->name}}
                                                                    {{$manager->family}}
                                                                    </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="p-2">
                                                    <br>
                                                    <button type="submit" class="btn btn-info">جستجوکن</button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr style="text-align: center">
                                <th>#</th>
                          
                                  <th>مدیر</th>
                                   <th>دانش آموز</th>
                                <th>اعلان</th>
                                <th>عملیات</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rows as $key=>$row)
                                <tr style="text-align: center">
                                    <td>{{$key+1}}</td>
  <td>
      @if($row->user->student->manager)                               
                                            {{$row->user->student->manager->name}}
                                             {{$row->user->student->manager->family}}
                                        
                                            @endif
                                       
                                    </td>
                                    <td>
                                        <a href="/panel/student/service/{{$row->user->student->id}}">
                                            {{$row->user->name}} {{$row->user->family}}
                                        </a>
                                    </td>
                                    <td>{{$row->type->name}}</td>
                                    <td style="text-align: center">
                                        <input style="text-align: center" type="checkbox" class="form-check-input"
                                            id="materialUnchecked"
                                         {{ $row->active ? 'checked' : '' }} onclick="changeStatus('{{$row->id}}',this) ">
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
                        {{ $rows->links() }}
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


