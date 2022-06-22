@extends('layouts.panel')

@section('head')

@stop

@section('content')
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">مدیریت نقش ها</h4>
                        <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a href="{{url('panel/roles/create')}}" class="btn btn-sx btn-success">افزودن <i
                                                class="fa fa-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <p class="card-text">در این قسمت می توانید نقش های جدید تعریف نمایید و هم چنین تمامی نقش ها
                                را مدیریت نمایید.</p>
                            <div class="table-responsive">
                                <table class="table zero-configuration">
                                    <thead>
                                    <tr>
                                        <th>ردیف</th>
                                        <th>نقش</th>
                                        <th>نام</th>
                                        <th>ویرایش شده در</th>
                                        <th>عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($roles as$index=> $role)
                                        <tr>
                                            <th scope="row">{{ $index + $roles->firstItem() }}</th>
                                            <td>{{$role->name}}</td>
                                            <td>{{$role->label}}</td>
                                            <td>{{\Morilog\Jalali\Jalalian::forge("{$role->updated_at}")->ago()}}</td>
                                            <td>
                                                <a href="{{url("panel/roles/{$role->id}/edit")}}"
                                                   class="btn btn-icon btn-icon rounded-circle btn-info mr-1 mb-1 waves-effect waves-light"><i
                                                            class="fa fa-pencil"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ Zero configuration table -->
@stop

@section('script')

@stop
