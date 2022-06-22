<!-- begin::datepicker -->
<link rel="stylesheet" href="/panel/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="/panel/assets/vendors/datepicker/daterangepicker.css">
<!-- end::datepicker -->
<div class="modal-header bg-primary white">
    <h5 class="modal-title" id="myModalLabel17">
        ویرایش دوره

    </h5>
    <button type="button" class="close"
            data-dismiss="modal"
            aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form action="/panel/student/service/update/{{$row->id}}" method="post">
    @csrf
    <div class="modal-body">
        <div class="row">
            <div class="col-6">
                <span>مشاور</span>
                <select class="form-control" name="consult_id">
                    @foreach($consults as $consult)
                        <option @if($row->consult_id==$consult->id) selected @endif
                        value="{{$consult->id}}">{{$consult->user->name}} {{$consult->user->family}}</option>
                    @endforeach
                </select>

            </div>
            <div class="col-6">
                <span>دوره</span>

                <select class="form-control" name="service_id">
                    @foreach($services as $service)
                        <option @if($row->service_id==$service->id) selected @endif
                        value="{{$service->id}}">{{$service->title}}</option>
                    @endforeach
                </select>

            </div>
            <div class="col-6">
                <br>

                <span>تاریخ شروع</span>

                <input class="form-control" name="start" id="date-picker-shamsi-3"
                       autocomplete="off" required value="{{$row->start}}">

            </div>
            <div class="col-6">
                <br>

                <span>تاریخ پایان</span>

                <input class="form-control" name="end" id="date-picker-shamsi-2"
                       autocomplete="off" required value="{{$row->end}}">

            </div>
        </div>
        <br>
        <button type="button" class="btn btn-danger"
                data-dismiss="modal"
                aria-label="Close">
            <span aria-hidden="true">بستن</span>
        </button>
        <button type="submit" class=" btn btn-success">ثبت</button>
    </div>
</form>
<!-- begin::datepicker -->
<script src="/panel/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.js"></script>
<script src="/panel/assets/vendors/datepicker-jalali/bootstrap-datepicker.fa.min.js"></script>
<script src="/panel/assets/vendors/datepicker/daterangepicker.js"></script>
<script src="/panel/assets/js/examples/datepicker.js"></script>
<!-- end::datepicker -->
