@extends('layouts.panel')
@section('css')
@endsection
@section('content')
    <main class="main-content">

        <div class="container-fluid">
            <!-- begin::page header -->
            <div class="page-header">
                <div>
                    <h3>مشاور</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/panel/home">داشبورد</a></li>
                            <li class="breadcrumb-item active" aria-current="page">مشاور</li>
                        </ol>
                    </nav>
                </div>

            </div>
            <!-- end::page header -->


                <div class="container-fluid">

                    <!-- end::page header -->

                    <div class="row">
                        <div class="col-md-4">

                            <div class="card">
                                <img src="/panel/assets/media/image/photo9.jpg" class="card-img-top" alt="...">
                                <div class="card-body text-center m-t-70-minus">
                                    <figure class="avatar avatar-xl m-b-20">
                                        <img src="/panel/assets/media/image/avatar.jpg" class="rounded-circle" alt="...">
                                    </figure>
                                    <h5>جان اسنو</h5>
                                    <p class="text-muted small">طراح وب</p>
                                    <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و</p>
                                    <a href="#" class="btn btn-outline-primary">
                                        <i class="fa fa-pencil m-l-5"></i> ویرایش پروفایل
                                    </a>
                                    <div class="row m-t-30">
                                        <div class="col-4 text-info">
                                            <h5 class="primary-font">5896</h5>
                                            <span>مطلب</span>
                                        </div>
                                        <div class="col-4 text-success">
                                            <h5 class="primary-font">1596</h5>
                                            <span>دنبال کننده</span>
                                        </div>
                                        <div class="col-4 text-warning">
                                            <h5 class="primary-font">7896</h5>
                                            <span>لایک</span>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title d-flex justify-content-between align-items-center">
                                        اطلاعات
                                        <a href="#" class="btn-sm primary-font">
                                            <i class="ti-pencil m-l-5"></i> ویرایش
                                        </a>
                                    </h5>
                                    <div class="row mb-2">
                                        <div class="col-6 text-muted">نام:</div>
                                        <div class="col-6">جان</div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-6 text-muted">نام خانوادگی:</div>
                                        <div class="col-6">اسنو</div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-6 text-muted">سن:</div>
                                        <div class="col-6">26</div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-6 text-muted">شغل:</div>
                                        <div class="col-6">طراح وب</div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-6 text-muted">شهر:</div>
                                        <div class="col-6">تبریز، ایران</div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-6 text-muted">آدرس:</div>
                                        <div class="col-6">چهارراه آبرسان، برج بلور، طبقه 455</div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-6 text-muted">تلفن:</div>
                                        <div class="col-6">+1-202-555-0134</div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-6 text-muted">ایمیل:</div>
                                        <div class="col-6">johnsnow@sample.com</div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">مهارت ها</h5>
                                    <div class="mb-4">
                                        <div class="text-muted mb-2">نرم افزار</div>
                                        <div class="d-flex align-items-center">
                                            <div class="progress flex-grow-1">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: 42%;" aria-valuenow="42" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <span class="h6 mb-0 mr-3 primary-font">42%</span>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="text-muted mb-2">طراحی</div>
                                        <div class="d-flex align-items-center">
                                            <div class="progress flex-grow-1">
                                                <div class="progress-bar bg-danger" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <span class="h6 mb-0 mr-3 primary-font">75%</span>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="text-muted mb-2">بهینه سازی سئو</div>
                                        <div class="d-flex align-items-center">
                                            <div class="progress flex-grow-1">
                                                <div class="progress-bar bg-warning" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <span class="h6 mb-0 mr-3 primary-font">50%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-8">

                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title m-b-15">اشتراک گذاری فعالیت</h6>
                                    <form>
                                        <div class="form-group">
                                            <textarea rows="3" class="form-control" placeholder="یک چیزی ایجاد کنید"></textarea>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <button class="btn btn-primary">ثبت</button>
                                            <div>
                                                <a href="#" data-toggle="tooltip" title="افزودن تصویر" class="btn btn-light btn-icon">
                                                    <i class="ti-image"></i>
                                                </a>
                                                <a href="#" data-toggle="tooltip" title="افزودن ویدئو" class="btn btn-light btn-icon m-r-5">
                                                    <i class="ti-video-camera"></i>
                                                </a>
                                                <a href="#" data-toggle="tooltip" title="افزودن فایل" class="btn btn-light btn-icon m-r-5">
                                                    <i class="ti-file"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body">

                                    <ul class="nav nav-pills flex-column flex-sm-row" id="myTab" role="tablist">
                                        <li class="flex-sm-fill text-sm-center nav-item">
                                            <a class="nav-link active" id="hometimeline-tab" data-toggle="tab" href="#timeline" role="tab" aria-controls="home" aria-selected="true">خط زمانی</a>
                                        </li>
                                        <li class="flex-sm-fill text-sm-center nav-item">
                                            <a class="nav-link" id="photos-tab" data-toggle="tab" href="#photos" role="tab" aria-controls="profile" aria-selected="false">تصاویر</a>
                                        </li>
                                        <li class="flex-sm-fill text-sm-center nav-item">
                                            <a class="nav-link" id="followers-tab1" data-toggle="tab" href="#followers" role="tab" aria-controls="followers" aria-selected="false">
                                                دنبال کنندگان <span class="badge badge-light">6</span>
                                            </a>
                                        </li>
                                        <li class="flex-sm-fill text-sm-center nav-item">
                                            <a class="nav-link" id="earnings-tab" data-toggle="tab" href="#earnings" role="tab" aria-controls="earnings" aria-selected="false">درآمد</a>
                                        </li>
                                    </ul>

                                    <div class="tab-content p-t-30" id="myTabContent">

                                        <div class="tab-pane fade show active" id="timeline" role="tabpanel" aria-labelledby="timeline-tab">
                                            <div class="timeline">
                                                <div class="timeline-item">
                                                    <div>
                                                        <figure class="avatar avatar-sm m-l-15 bring-forward">
                                                            <img src="/panel/assets/media/image/avatar.jpg" class="rounded-circle">
                                                        </figure>
                                                    </div>
                                                    <div>
                                                        <h6 class="primary-font">لورم ایپسوم متن ساختگی</h6>
                                                        <p class="m-b-5">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان</p>
                                                        <small class="text-muted">
                                                            <i class="fa fa-clock-o m-l-5"></i> دیروز
                                                        </small>
                                                    </div>
                                                </div>
                                                <div class="timeline-item">
                                                    <div>
                                                        <figure class="avatar avatar-sm m-l-15 bring-forward">
                                                            <span class="avatar-title bg-danger rounded-circle">ک</span>
                                                        </figure>
                                                    </div>
                                                    <div>
                                                        <h6 class="primary-font">لورم ایپسوم متن</h6>
                                                        <p class="m-b-5">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان</p>
                                                        <p class="m-b-5">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه</p>
                                                        <small class="text-muted">
                                                            <i class="fa fa-clock-o m-l-5"></i> 20.10.2018
                                                        </small>
                                                    </div>
                                                </div>
                                                <div class="timeline-item">
                                                    <div>
                                                        <figure class="avatar avatar-sm m-l-15 bring-forward">
                                            <span class="avatar-title bg-warning rounded-circle">
                                                <i class="ti-image"></i>
                                            </span>
                                                        </figure>
                                                    </div>
                                                    <div>
                                                        <div class="row m-b-5">
                                                            <div class="col-md-6">
                                                                <img src="/panel/assets/media/image/portfolio-five.jpg" alt="" class="w-25">
                                                                <img src="/panel/assets/media/image/portfolio-one.jpg" alt="" class="w-25">
                                                                <img src="/panel/assets/media/image/portfolio-three.jpg" alt="" class="w-25">
                                                            </div>
                                                        </div>
                                                        <small class="text-muted">
                                                            <i class="fa fa-clock-o m-l-5"></i> 20.10.2018
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="photos" role="tabpanel" aria-labelledby="photos-tab">
                                            <div class="row">
                                                <div class="col-lg-4 mb-3"><img class="img-fluid rounded" src="/panel/assets/media/image/portfolio-one.jpg" alt="image"></div>
                                                <div class="col-lg-4 mb-3"><img class="img-fluid rounded" src="/panel/assets/media/image/portfolio-two.jpg" alt="image"></div>
                                                <div class="col-lg-4 mb-3"><img class="img-fluid rounded" src="/panel/assets/media/image/portfolio-three.jpg" alt="image"></div>
                                                <div class="col-lg-4 mb-3"><img class="img-fluid rounded" src="/panel/assets/media/image/portfolio-four.jpg" alt="image"></div>
                                                <div class="col-lg-4 mb-3"><img class="img-fluid rounded" src="/panel/assets/media/image/portfolio-five.jpg" alt="image"></div>
                                                <div class="col-lg-4 mb-3"><img class="img-fluid rounded" src="/panel/assets/media/image/portfolio-six.jpg" alt="image"></div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="followers" role="tabpanel" aria-labelledby="followers-tab">
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item d-flex align-items-center p-l-r-0">
                                                    <figure class="avatar avatar-sm m-l-15">
                                                        <a href="#">
                                                            <span class="avatar-title rounded-circle">V</span>
                                                        </a>
                                                    </figure>
                                                    <div>
                                                        <h6 class="m-b-0 primary-font">جان اسنو</h6>
                                                        <small class="text-muted">مهندس</small>
                                                    </div>
                                                    <a href="#" class="btn btn-success btn-sm mr-auto">دنبال کننده</a>
                                                </li>
                                                <li class="list-group-item d-flex align-items-center p-l-r-0">
                                                    <figure class="avatar avatar-sm m-l-15">
                                                        <a href="#">
                                                            <img src="/panel/assets/media/image/avatar.jpg" class="rounded-circle" alt="image">
                                                        </a>
                                                    </figure>
                                                    <div>
                                                        <h6 class="m-b-0 primary-font">تونی استارک</h6>
                                                        <small class="text-muted">منابع انسانی</small>
                                                    </div>
                                                    <a href="#" class="btn btn-light btn-outline-light btn-sm mr-auto">دنبال کردن</a>
                                                </li>
                                                <li class="list-group-item d-flex align-items-center p-l-r-0">
                                                    <figure class="avatar avatar-sm m-l-15">
                                                        <a href="#">
                                                            <span class="avatar-title rounded-circle">M</span>
                                                        </a>
                                                    </figure>
                                                    <div>
                                                        <h6 class="m-b-0 primary-font">استیو راجرز</h6>
                                                        <small class="text-muted">مشاور املاک</small>
                                                    </div>
                                                    <a href="#" class="btn btn-success btn-sm mr-auto">دنبال کننده</a>
                                                </li>
                                                <li class="list-group-item d-flex align-items-center p-l-r-0">
                                                    <figure class="avatar avatar-sm m-l-15">
                                                        <a href="#">
                                                            <span class="avatar-title rounded-circle">ک</span>
                                                        </a>
                                                    </figure>
                                                    <div>
                                                        <h6 class="m-b-0 primary-font">پیتر پارکر</h6>
                                                        <small class="text-muted">مهندس</small>
                                                    </div>
                                                    <a href="#" class="btn btn-success btn-sm mr-auto">دنبال کننده</a>
                                                </li>
                                                <li class="list-group-item d-flex align-items-center p-l-r-0">
                                                    <figure class="avatar avatar-sm m-l-15">
                                                        <a href="#">
                                                            <span class="avatar-title rounded-circle">V</span>
                                                        </a>
                                                    </figure>
                                                    <div>
                                                        <h6 class="m-b-0 primary-font">جان اسنو</h6>
                                                        <small class="text-muted">مهندس</small>
                                                    </div>
                                                    <a href="#" class="btn btn-success btn-sm mr-auto">دنبال کننده</a>
                                                </li>
                                                <li class="list-group-item d-flex align-items-center p-l-r-0">
                                                    <figure class="avatar avatar-sm m-l-15">
                                                        <a href="#">
                                                            <img src="/panel/assets/media/image/avatar.jpg" class="rounded-circle" alt="image">
                                                        </a>
                                                    </figure>
                                                    <div>
                                                        <h6 class="m-b-0 primary-font">تونی استارک</h6>
                                                        <small class="text-muted">منابع انسانی</small>
                                                    </div>
                                                    <a href="#" class="btn btn-light btn-outline-light btn-sm mr-auto">دنبال کردن</a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="tab-pane fade" id="earnings" role="tabpanel" aria-labelledby="earnings-tab">
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th>تاریخ</th>
                                                        <th>تعداد فروش</th>
                                                        <th>درآمد</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td>لورم ایپسوم</td>
                                                        <td>
                                                            3
                                                        </td>
                                                        <td>400,000 تومان</td>
                                                    </tr>
                                                    <tr>
                                                        <td>لورم ایپسوم</td>
                                                        <td>
                                                            2
                                                        </td>
                                                        <td>400,000 تومان</td>
                                                    </tr>
                                                    <tr>
                                                        <td>لورم ایپسوم متن</td>
                                                        <td>
                                                            3
                                                        </td>
                                                        <td>420,000 تومان</td>
                                                    </tr>
                                                    <tr>
                                                        <td>لورم ایپسوم متن</td>
                                                        <td>
                                                            5
                                                        </td>
                                                        <td>500,000 تومان</td>
                                                    </tr>
                                                    <tr>
                                                        <td>لورم ایپسوم</td>
                                                        <td>
                                                            3
                                                        </td>
                                                        <td>400,000 تومان</td>
                                                    </tr>
                                                    <tr>
                                                        <td>لورم ایپسوم متن</td>
                                                        <td>
                                                            3
                                                        </td>
                                                        <td>400,000 تومان</td>
                                                    </tr>
                                                    <tr>
                                                        <td>لورم ایپسوم</td>
                                                        <td>
                                                            3
                                                        </td>
                                                        <td>400,000 تومان</td>
                                                    </tr>
                                                    <tr>
                                                        <td>لورم ایپسوم</td>
                                                        <td>
                                                            3
                                                        </td>
                                                        <td>500,000 تومان</td>
                                                    </tr>
                                                    <tr>
                                                        <td>لورم ایپسوم</td>
                                                        <td>
                                                            3
                                                        </td>
                                                        <td>400,000 تومان</td>
                                                    </tr>
                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <th colspan="2">جمع کل:</th>
                                                        <th>3,720,000 تومان</th>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                </div>



        </div>

    </main>
@endsection
@section('js')
    <script src="/js/sweet.js"></script>

    @include('sweetalert::alert')
@endsection


