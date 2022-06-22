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

@section('content')
    <main class="main-content">
    <div class="card">
        <div class="card-body">
            <a href="/panel/students/pattern/date/{{$pattern->id}}">
                <button class="btn btn-warning">ثبت ساعت مطالعه</button>
            </a>
            <br>
            <br>
            <input id="myInput" type="text" placeholder="Search.." class="form-control col-md-4">
            <br>
            <div class="">
                <input type="hidden" name="pattern" value="{{$pattern->id}}">
                <table class="table table-responsive table-bordered table-striped mb-0 table-fixed" id="myTable">
                    <thead>
                    <tr class="success" style="text-align: center">
                        <th>درس</th>
                        @foreach($days as $day)
                            <th>{{$day->name}}</th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($doros as $dars)

                        <tr style="text-align: center">
                            <td>{{$dars->name}}</td>

                            @foreach($patternItems as $key=>$patternItem)
                                <td><input style="text-align: center" class="form-control"
                                           name="time[{{$key}}][{{$dars->id}}]" disabled
                                           value="{{$patternItem->where('dars_id',$dars->id)->pluck('time')->first()}}"
                                    >
                                    <select class="form-control" name="status[{{$key}}][{{$dars->id}}]" disabled>
                                        @foreach($statuses as $status)
                                            <option
                                                @if($patternItem->where('dars_id',$dars->id)->pluck('status')->first()==$status->id) selected
                                                @endif value="{{$status->id}}">{{$status->name}}</option>
                                        @endforeach
                                    </select>

                                    <input style="text-align: center" class="form-control"
                                           name="description[{{$key}}][{{$dars->id}}]" disabled
                                           value="{{$patternItem->where('dars_id',$dars->id)->pluck('description')->first()}}"
                                    >
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <br>
            </div>

        </div>
    </div>
    </main>

@endsection('content')
@section('js')
    <script src="/js/sweet.js"></script>

    @include('sweetalert::alert')
@endsection



