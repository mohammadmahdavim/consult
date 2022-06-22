@extends('layouts.panel')

@section('css')
@endsection

@section('content')
    <main class="main-content">

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">


                        <div class="card-header">

                            <h4 class="card-title">مدیریت افراد</h4>
                            <div class="heading-elements">

                                <div class="d-flex flex-row">

                                    <div class="p-2">
                                        <a href="{{url('panel/users/create')}}" class="btn  btn-success">افزودن <i
                                                class="fa fa-plus"></i></a>
                                    </div>
                                    <div class="p-2">

                                        <form method="get" action="/panel/callers/export">

                                            <button type='submit' class="btn btn-warning">
                                                دریافت فایل
                                            </button>
                                        </form>
                                    </div>
                                    <div class="p-2">
                                        <button type='button' class="btn btn-primary" onclick="hideshow()"
                                                id='hideshow'>
                                            جستجوی پیشرفته
                                        </button>
                                        <div id='search' style="display: none">
                                            <form method="get" action="/panel/users">
                                                <div class="d-flex flex-row">
                                                    <div class="p-2">
                                                        <span>نام</span>
                                                        <input class="form-control" id="name" name="name"
                                                               value="{{request()->name}}"
                                                               placeholder="نام">
                                                    </div>
                                                    <div class="p-2">
                                                        <span>کد ملی</span>
                                                        <input class="form-control" id="national_code" name="national_code"
                                                               value="{{request()->national_code}}"
                                                               placeholder="کد ملی">
                                                    </div>


                                                    <div class="p-2">
                                                        <br>
                                                        <input class="btn btn-danger" type="reset"
                                                               value="حذف فیلتر ها">

                                                    </div>
                                                    <div class="p-2">
                                                        <br>
                                                        <button type="submit" class="btn btn-info">جستجوکن</button>
                                                    </div>
                                                </div>

                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-body card-dashboard">
                                {{--                                <button type='button' class="btn btn-primary" onclick="hideshow()" id='hideshow'>--}}
                                {{--                                    جستجوی پیشرفته--}}
                                {{--                                </button>--}}
                                {{--                                <div id='search' style="display: none">--}}
                                {{--                                    <form method="get" action="/panel/users">--}}
                                {{--                                        <div class="d-flex flex-row">--}}


                                {{--                                            <div class="p-2">--}}
                                {{--                                                <label>نام </label>--}}

                                {{--                                                <input class="form-control" id="name" name="name"--}}
                                {{--                                                       value="{{request()->name}}"--}}
                                {{--                                                       placeholder="نام ">--}}
                                {{--                                            </div>--}}
                                {{--                                            <div class="p-2">--}}
                                {{--                                                <label>موبایل </label>--}}

                                {{--                                                <input class="form-control" id="mobile" name="mobile"--}}
                                {{--                                                       value="{{request()->mobile}}"--}}
                                {{--                                                       placeholder="نام ">--}}
                                {{--                                            </div>--}}
                                {{--                                            <div class="p-2">--}}
                                {{--                                                <label>کدملی </label>--}}

                                {{--                                                <input class="form-control" id="national_code" name="national_code"--}}
                                {{--                                                       value="{{request()->national_code}}"--}}
                                {{--                                                       placeholder="نام ">--}}
                                {{--                                            </div>--}}
                                {{--                                            <div class="p-2">--}}
                                {{--                                                <label>دسترسی جنسیت </label>--}}
                                {{--                                                <select class="form-control" name="gender" id="gender">--}}
                                {{--                                                    <option @if(request()->gender=='man') selected @endif value="man">man--}}
                                {{--                                                    </option>--}}
                                {{--                                                    <option @if(request()->gender=='woman') selected @endif value="woman">--}}
                                {{--                                                        woman--}}
                                {{--                                                    </option>--}}
                                {{--                                                    <option @if(request()->gender=='both') selected @endif value="both">both--}}
                                {{--                                                    </option>--}}
                                {{--                                                    <option @if(request()->gender=='nothing') selected--}}
                                {{--                                                            @endif value="nothing">--}}
                                {{--                                                        nothing--}}
                                {{--                                                    </option>--}}
                                {{--                                                    <option @if(request()->gender==null) selected @endif value="">همه--}}
                                {{--                                                    </option>--}}

                                {{--                                                </select>--}}
                                {{--                                            </div>--}}
                                {{--                                            <div class="p-2">--}}
                                {{--                                                <label>نقش ها</label>--}}
                                {{--                                                <select class="form-control select2" name="role[]" multiple id="role">--}}
                                {{--                                                    @foreach($roles as $role)--}}
                                {{--                                                        <option @if(isset(request()->role) && is_array(request()->role) && in_array($role->name, request()->role)) selected @endif>{{$role->name}}</option>--}}
                                {{--                                                    @endforeach--}}
                                {{--                                                </select>--}}
                                {{--                                            </div>--}}
                                {{--                                            <div class="p-2">--}}
                                {{--                                                <br>--}}
                                {{--                                                <input class="btn btn-danger btn-sm" type="reset" value="حذف فیلتر ها">--}}

                                {{--                                            </div>--}}
                                {{--                                            <div class="p-2">--}}
                                {{--                                                <br>--}}
                                {{--                                                <button type="submit" class="btn btn-info">جستجوکن</button>--}}
                                {{--                                            </div>--}}
                                {{--                                        </div>--}}

                                {{--                                    </form>--}}
                                {{--                                </div>--}}
                                <p class="card-text">در این قسمت می توانید افراد جدید تعریف نمایید و هم چنین تمامی افراد
                                    را
                                    مدیریت نمایید.</p>
                                <div class="table-responsive">
                                    <table class="table zero-configuration">
                                        <thead>
                                        <tr>
                                            <th>ردیف</th>
                                            <th>نام</th>
                                            <th>موبایل</th>
                                            <th>کد ملی</th>
                                            <th>نقش ها</th>
                                            <th> جنسیت</th>
                                            <th>ویرایش شده در</th>
                                            <th>عملیات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($users as $index=>$user)
                                            <tr>
                                                <th scope="row">{{ $index + $users->firstItem() }}</th>

                                                <td>{{$user->name}} {{$user->family}}</td>
                                                <td>{{$user->mobile}}</td>
                                                <td>{{$user->national_code}}</td>
                                                <td>
                                                    @foreach($user->getRoleNames() as $role)
                                                        <span>{{$role}}</span>
                                                        <br>
                                                    @endforeach
                                                </td>
                                                <td>{{$user->gender}}</td>

                                                <td>{{\Morilog\Jalali\Jalalian::forge("{$user->updated_at}")->ago()}}</td>

                                                <td>
                                                    @can('caller-finance')
                                                        <a href="/panel/caller/finance/{{$user->id}}">
                                                            <button class="btn btn-primary btn-sm" title="مالی">
                                                                <i class="icon ti-money"></i>
                                                            </button>
                                                        </a>
                                                    @endcan
                                                    <a href="/panel/users/{{$user->id}}/edit">
                                                        <button class="btn btn-success btn-sm" title="ویرایش">
                                                            <i class="icon ti-pencil"></i>
                                                        </button>
                                                    </a>

                                                    <x-destroy :id="$user->id" url="'/panel/users/userDestroy'"/>

                                                </td>

                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                {!! $users->appends(\Illuminate\Support\Facades\Request::except('page'))->render() !!}

                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </div>

    </main>
    <!--/ Zero configuration table -->
@stop

@section('js')
    <script>
        function hideshow() {
            var x = document.getElementById("search");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }

    </script>

    <script src="/js/sweet.js"></script>

    @include('sweetalert::alert')
@endsection
