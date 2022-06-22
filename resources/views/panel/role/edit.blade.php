@extends('layouts.panel')

@section('head')
<link rel="stylesheet" type="text/css" href="{{url('/css/bootstrap-duallistbox.css')}}">
@stop

@section('content')
<section id="basic-horizontal-layouts">
    <div class="row match-height">
        <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">بروزرسانی نقش - {{$role->label}} </h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form form-horizontal" id="updateForm" onsubmit="return false;">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group row">
                                            <div class="col-md-4">
                                                <span>عنوان نقش</span>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" id="label" class="form-control" name="label"
                                                     value="{{$role->label}}"  placeholder="بطور مثال: مدیر کارمندان">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group row">
                                            <div class="col-md-4">
                                                <span>نام لاتین نقش</span>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" id="name" dir="ltr" class="form-control"
                                                       name="name" placeholder="For example: admin-work"  value="{{$role->name}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group row">
                                            <div class="col-md-4">
                                                <span>مجوز ها</span>
                                            </div>
                                            <div class="col-md-8">
                                                <select multiple="multiple" size="{{$permissions->count()}}"
                                                        name="permissions[]" title="مجوز ها">
                                                    @foreach($permissions as $permission)
                                                    <option
                                                        value="{{$permission->id}}" @if($role->hasPermissionTo($permission->name)) selected @endif>{{$permission->label}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8 offset-md-4">
                                        <button onclick="updateForm('{{$role->id}}');" class="btn btn-primary mr-1 mb-1">بروزرسانی</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop

@section('script')
<script src="{{url('js/jquery.bootstrap-duallistbox.js')}}"></script>
<script>
    var permissions = $('select[name="permissions[]"]').bootstrapDualListbox({
        nonSelectedListLabel: 'لیست مجوز ها',
        selectedListLabel: 'مجوزهای انتخاب شده',
        preserveSelectionOnMove: 'moved',
    });
</script>
<script>
    updateForm = function (id) {
        $('#loading').show();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        var data = $('#updateForm').serialize();
        $.ajax({
            url: '{{ url("/panel/roles/") }}/' + id,
            type: 'PUT',
            data: data,
            success: function (response) {
                $('#loading').hide();
                toastr.success(response.message);
                setTimeout(function () {
                    window.location.replace('{{url('/panel/roles')}}');
                }, 2000);
            },
            error: function (xhr) {
                $('#loading').hide();
                if (xhr.status === 422) {
                    jQuery.each(xhr.responseJSON.errors, function (key, value) {
                        toastr.error(value);
                    });
                }
                if (xhr.status !== 422) {
                    toastr.warning(xhr.responseJSON.errors);
                }
            }
        });
    }
</script>
@stop
