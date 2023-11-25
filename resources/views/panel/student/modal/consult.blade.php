<!-- begin::datepicker -->
<link rel="stylesheet" href="/panel/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="/panel/assets/vendors/datepicker/daterangepicker.css">
<!-- end::datepicker -->
<div class="modal-header bg-primary white">
    <h5 class="modal-title" id="myModalLabel17">
        لیست دانش آموزان

    </h5>
    <button type="button" class="close"
            data-dismiss="modal"
            aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
        <tr style="text-align: center">
            <th>#</th>
            <th>نام</th>

            <th>کد ملی</th>
            <th>پایه</th>
            <th>رشته</th>
            <th>شهر</th>

        </tr>
        </thead>
        <tbody>
        <?php
        $key = 1;
        ?>
        @foreach($studentsActive as $row)
            <tr style="text-align: center">
                <td>{{$key}}</td>
                <td>{{$row->user->name}} {{$row->user->family}}</td>
                <td>{{$row->user->national_code}}</td>
                <td>{{$row->field->title}}</td>
                <td>{{$row->paye->title}}</td>
                <td>{{$row->state->title}} ({{$row->city->title}})</td>
                 <td>
                                     <button type="button" class="btn btn-warning btn-sm" title="پرونده"
                                                        onclick="modal_show('{{$row->id}}','/panel/comments');">
                                                    <i class="fa fa-file-text-o"></i>
                                                </button>
                        
                    </td>
            </tr>
            <?php
            $key = $key + 1;
            ?>
        @endforeach
        @foreach($studentsDeactive as $row)
            <tr style="text-align: center;background-color: black">
                <td>{{$key}}</td>
                <td>{{$row->user->name}} {{$row->user->family}}</td>
                <td>{{$row->user->national_code}}</td>
                <td>{{$row->field->title}}</td>
                <td>{{$row->paye->title}}</td>
                <td>{{$row->state->title}} ({{$row->city->title}})</td>
                    <td>
                                     <button type="button" class="btn btn-warning btn-sm" title="پرونده"
                                                        onclick="modal_show('{{$row->id}}','/panel/comments');">
                                                    <i class="fa fa-file-text-o"></i>
                                                </button>
                        
                    </td>
            </tr>
            <?php
            $key = $key + 1;
            ?>
        @endforeach
        </tbody>
    </table>
    @include('include.modal.show')

</div>
</div>
<!-- begin::datepicker -->
<script src="/panel/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.js"></script>
<script src="/panel/assets/vendors/datepicker-jalali/bootstrap-datepicker.fa.min.js"></script>
<script src="/panel/assets/vendors/datepicker/daterangepicker.js"></script>
<script src="/panel/assets/js/examples/datepicker.js"></script>
<!-- end::datepicker -->
