<!-- begin::datepicker -->
<link rel="stylesheet" href="/panel/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="/panel/assets/vendors/datepicker/daterangepicker.css">
<!-- end::datepicker -->
<div class="modal-header bg-primary white">
    <h5 class="modal-title" id="myModalLabel17">
        مالی افراد

    </h5>
    <button type="button" class="close"
            data-dismiss="modal"
            aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form action="/panel/student/serviceFinanceStore/{{$row->id}}" method="post">
    @csrf
    <div class="modal-body">
        <div class="row">
             @can('finance-student-show')
            <div class="col-md-2">
                <span>دانش آموز</span>
            </div>
            <div class="col-md-3">
                <input class="form-control" name="amount1" placeholder="مبلغ"
                       @if($financeSection->where('type_id',1)->pluck('amount')->first()) value="{{$financeSection->where('type_id',1)->pluck('amount')->first()}}"
                       @else value="{{$amount}}" @endif
                >
            </div>
            <div class="col-md-3">
                <input class="form-control" readonly name="date1" id="date-picker-shamsi-4"
                       @if($financeSection->where('type_id',1)->pluck('date')->first()) value="{{$financeSection->where('type_id',1)->pluck('date')->first()}}"
                       @else value="{{$date}}" @endif
                       value="{{$financeSection->where('type_id',1)->pluck('date')->first()}}"
                       placeholder="تاریخ پرداخت">
            </div>
            <div class="col-md-3">
                <input class="form-control" name="code1"
                       value="{{$financeSection->where('type_id',1)->pluck('code')->first()}}" placeholder="کد رهگیری">
            </div>

        </div>
        <br>
       

            <div class="row">
                <div class="col-md-2">
                    <span>مشاور</span>
                </div>
                <div class="col-md-3">
                    <input class="form-control" name="amount2" placeholder="مبلغ"
                           value="{{$financeSection->where('type_id',2)->pluck('amount')->first()}}">
                </div>
                <div class="col-md-3">
                    <input class="form-control" readonly name="date2" id="date-picker-shamsi-5"
                           placeholder="تاریخ پرداخت"
                           value="{{$financeSection->where('type_id',2)->pluck('date')->first()}}">
                </div>
                <div class="col-md-3">
                    <input class="form-control" name="code2" placeholder="کد رهگیری"
                           value="{{$financeSection->where('type_id',2)->pluck('code')->first()}}">
                </div>

            </div>
            <br>
            <div class="row">
                <div class="col-md-2">
                    <span>جذب کننده</span>
                </div>
                <div class="col-md-3">
                    <input class="form-control" name="amount3" placeholder="مبلغ"
                           value="{{$financeSection->where('type_id',3)->pluck('amount')->first()}}">
                </div>
                <div class="col-md-3">
                    <input class="form-control" readonly name="date3" id="date-picker-shamsi-6"
                           placeholder="تاریخ پرداخت"
                           value="{{$financeSection->where('type_id',3)->pluck('date')->first()}}">
                </div>
                <div class="col-md-3">
                    <input class="form-control" name="code3" placeholder="کد رهگیری"
                           value="{{$financeSection->where('type_id',3)->pluck('code')->first()}}">
                </div>

            </div>
            <br>
            <div class="row">
                <div class="col-md-2">
                    <span>مدیریت</span>
                </div>
                <div class="col-md-3">
                    <input name="amount4" class="form-control" placeholder="مبلغ"
                           value="{{$financeSection->where('type_id',4)->pluck('amount')->first()}}">
                </div>
                <div class="col-md-3">
                    <input readonly name="date4" class="form-control" id="date-picker-shamsi-7"
                           placeholder="تاریخ پرداخت"
                           value="{{$financeSection->where('type_id',4)->pluck('date')->first()}}">
                </div>
                <div class="col-md-3">
                    <input name="code4" class="form-control" placeholder="کد رهگیری"
                           value="{{$financeSection->where('type_id',4)->pluck('code')->first()}}">
                </div>
            </div>
             @endcan
            <br>
            <div class="row">
                <div class="col-md-2">
                    <span>سرمشاور</span>
                </div>
                <div class="col-md-3">
                    <input name="amount5" class="form-control" placeholder="مبلغ"
                           value="{{$financeSection->where('type_id',5)->pluck('amount')->first()}}">
                </div>
                <div class="col-md-3">
                    <input readonly name="date5" class="form-control" id="date-picker-shamsi-8"
                           placeholder="تاریخ پرداخت"
                           value="{{$financeSection->where('type_id',5)->pluck('date')->first()}}">
                </div>
                <div class="col-md-3">
                    <input name="code5" class="form-control" placeholder="کد رهگیری"
                           value="{{$financeSection->where('type_id',5)->pluck('code')->first()}}">
                </div>

            </div>
            <br>
            <div class="row">    
                <div class="col-md-2">
                    
                    <span>جریمه</span>
                </div>
                <div class="col-md-3">
                    <input name="amount6" class="form-control" placeholder="مبلغ"
                           value="{{$financeSection->where('type_id',6)->pluck('amount')->first()}}">
                </div>
                <div class="col-md-3">
                    <input readonly name="date6" class="form-control" id="date-picker-shamsi-8"
                           placeholder="تاریخ پرداخت"
                           value="{{$financeSection->where('type_id',6)->pluck('date')->first()}}">
                </div>
                <div class="col-md-3">
                    <input name="code6" class="form-control" placeholder="کد رهگیری"
                           value="{{$financeSection->where('type_id',6)->pluck('code')->first()}}">
                </div>

            </div>
        
       
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
