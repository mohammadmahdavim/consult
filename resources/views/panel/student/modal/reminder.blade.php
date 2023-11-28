<link rel="stylesheet" href="/panel/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="/panel/assets/vendors/datepicker/daterangepicker.css">
<div class="modal-header bg-primary white">
    <h5 class="modal-title" id="myModalLabel17">
        یادآور برای {{$row->user->name}}
        {{$row->user->family}}

    </h5>
    <button type="button" class="close"
            data-dismiss="modal"
            aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">
    <div class="row d-flex justify-content-center">
        <div class="col-md-12">
            <div
                class="headings d-flex justify-content-between align-items-center mb-3">
            </div>
            @foreach($row->user->reminder as $key=>$reminder)
                    <div class="card p-3 mt-2">
                        <div
                            class="d-flex justify-content-between align-items-center">
                            <div
                                class="user d-flex flex-row align-items-center">
                                                                                <span>
                                                                                    <span width="30"
                                                                                          class="user-img rounded-circle mr-2">{{$key+1}}.


                            </div>
                            <small>{{ $reminder->date}}</small>
                        </div>
                        <div
                            class="action d-flex justify-content-between mt-2 align-items-center">
                            <div class="reply px-4">
                                {!! $reminder->comment !!}
                            </div>
                            <div class="icons align-items-center">
                                <x-destroy :id="$reminder->id" url="'/panel/reminder/destroy'"/>
                            </div>
                        </div>
                    </div>

            @endforeach

        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="/panel/reminder/store" method="post" class="text-right">
                @csrf
                <input type="hidden" name="user_id"
                       value="{{$row->user->id}}">
                <h4 style="text-align: center">یادآور جدید</h4>
                <div class="row">
                    <div class="col-md-5">
                        <label>تاریخ یادآوری</label>
                        <input class="form-control" name="date" id="date-picker-shamsi-4"
                               required>
                    </div>
                    <div class="col-md-12">
                        <br>
                        <label style="text-align: right">توضیحات</label>
                        <textarea rows="4" cols="95"
                                  name="comment"></textarea>
                    </div>
                    <button class="btn btn-block btn-info">ثبت</button>
                </div>
            </form>

            <br>

        </div>
    </div>
</div>


<!-- begin::datepicker -->
<script src="/panel/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.js"></script>
<script src="/panel/assets/vendors/datepicker-jalali/bootstrap-datepicker.fa.min.js"></script>
<script src="/panel/assets/vendors/datepicker/daterangepicker.js"></script>
<script src="/panel/assets/js/examples/datepicker.js"></script>
<!-- end::datepicker -->

