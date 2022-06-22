@extends('layouts.panel')
@section('css')
    <style>
        .my-custom-scrollbar {
            position: relative;
            height: 500px;
            overflow: auto;
        }

        .table-wrapper-scroll-y {
            display: block;
        }
    </style>
@endsection('css')

    <div class="page-header">
        <div>
            <h3>لیست الگو ها </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">الگو ها</a></li>
                    <li class="breadcrumb-item active" aria-current="page">لیست الگو ها</li>
                </ol>
            </nav>
        </div>

    </div>


@section('content')
    <main class="main-content">
    <div class="card">
        <div class="card-body">

            <br>
            <input id="myInput" type="text" placeholder="Search.." class="form-control col-md-4">
            <br>
            <div class="">
                <table class="table table-bordered table-striped mb-0 table-fixed" id="myTable">
                    <thead>
                    <tr class="success" style="text-align: center">
                        <th>شمارنده</th>
                        <th>عنوان الگو</th>
                        <th>تاریخ شروع</th>
                        <th>تاریخ پایان</th>
                        <th>عملیات</th>

                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <?php $idn = 1; ?>
                        @foreach($patterns as $row)
                            <td style="text-align: center">{{$idn}}</td>


                            <td style="text-align: center">{{$row->name}}</td>
                            <td style="text-align: center">{{$row->date_from}}</td>
                            <td style="text-align: center">{{$row->date_to}}</td>

                            <td style="text-align: center">
                                <div>
                                    <a href="/panel/students/pattern/doros/{{$row->id}}">
                                        <button type="submit" class="btn btn-success">دروس
                                        </button>
                                    </a>

                                </div>

                            </td>
                    </tr>

                    <?php $idn = $idn + 1 ?>

                    @endforeach
                    </tbody>
                </table>
            </div>
            {{ $patterns->links() }}

        </div>
    </div>
    </main>

@endsection('content')
@section('js')
    <script src="/js/sweet.js"></script>

    @include('sweetalert::alert')

@endsection




