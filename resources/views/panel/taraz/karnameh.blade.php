@extends('layouts.panel')
@section('css')
@endsection
@section('content')
    <main class="main-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h4>نمودار رشد تراز {{$user->name}} {{$user->family}}</h4>
                    <div id="chart" style="height: 300px;"></div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr style="text-align: center">
                            <th>#</th>
                            <th>آزمون</th>
                            <th>تراز کل</th>
                            <th>تراز اختصاصی</th>
                            <th>تراز عمومی</th>
                            <th>عملیات</th>


                        </tr>
                        </thead>
                        <tbody>
                        @foreach($karnamehs as $key=>$row)
                            <tr style="text-align: center">
                                <td>{{$key+1}}</td>
                                <td>{{$row->testName->name}}</td>
                                <td>{{$row->all}}</td>
                                <td>{{$row->special}}</td>
                                <td>{{$row->public}}</td>
                                <td>
                                    <x-destroy :id="$row->id" url="'/panel/taraz/destroy'"/>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>

                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form method="post" action="/panel/tarazStore">
                        @csrf

                        <div class="card-body" id="skill">


                            <div id="skill0">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">
                                                دانش آموز
                                            </label>
                                            <select class="form-control select2" name="fields[student_id][]">
                                                @foreach($students as $student)
                                                    <option value="{{$student->id}}">{{$student->user->name}}-{{$student->user->family}}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">
                                                آزمون
                                            </label>
                                            <select class="form-control select2" name="fields[test_id][]">
                                                @foreach($tests as $test)
                                                    <option value="{{$test->id}}">{{$test->name}}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">
                                                تراز کل
                                            </label>
                                            <input name="fields[all][]" id="all" class="form-control" required>

                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">
                                                تراز عمومی
                                            </label>
                                            <input name="fields[public][]" id="public" class="form-control" required>

                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">
                                                تراز اختصاصی
                                            </label>
                                            <input name="fields[special][]" id="special" class="form-control" required>

                                        </div>
                                    </div>

                                </div>
                                <hr class="new2">
                            </div>



                        </div>
                        <div class="col-md-12">
                            <br>
                            <button type="submit"
                                    class="btn btn-success mr-sm-1 mb-1 mb-sm-0">ثبت تغییرات
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </main>
@endsection
@section('js')
    <script src="/panel/assets/vendors/select2/js/select2.min.js"></script>
    <script src="/panel/assets/js/examples/select2.js"></script>
    @include('sweetalert::alert')
    <script src="/js/sweet.js"></script>

    <script src="/panel/assets/js/chart/echarts.min.js"></script>
    <!-- Chartisan -->
    <script src="/panel/assets/js/chart/chartisan_echarts.js"></script>
    <!-- Your application script -->
    <script>
        var id = {{$user->id}};
        const chart = new Chartisan({
            el: '#chart',
            url: "@chart('taraz_chart')" + "?id=" + id,
            hooks: new ChartisanHooks()
                .datasets([{type: 'bar', fill: false}])
                .tooltip(),
        })

    </script>

@endsection


