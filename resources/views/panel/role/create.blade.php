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
                        <h4 class="card-title">ایجاد نقش</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-horizontal" id="saveForm" onsubmit="return false;">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-md-4">
                                                    <span>عنوان نقش</span>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" id="label" class="form-control" name="label"
                                                           placeholder="بطور مثال: مدیر کارمندان">
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
                                                           name="name" placeholder="For example: admin-work">
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
                                                                value="{{$permission->id}}">{{$permission->label}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8 offset-md-4">
                                            <button onclick="saveForm();" class="btn btn-primary mr-1 mb-1">ثبت</button>
                                            <button type="reset" class="btn btn-outline-warning mr-1 mb-1">پاک کردن
                                            </button>
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
        saveForm = function () {
            $('#loading').show();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            var data = $('#saveForm').serialize();
            $.ajax({
                url: '{{ url('/panel/roles') }}',
                type: 'POST',
                data: data,
                success: function (response) {
                    $('#loading').hide();
                    toastr.success(response.message);
                    document.getElementById('saveForm').reset();
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
