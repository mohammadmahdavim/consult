<div class="side-menu">
    <div class="side-menu-body">
        <ul>
            <li class="side-menu-divider">فهرست</li>
            <li><a class="active" href="/panel/index"><i class="fa fa-male"></i><i class="fa fa-pho"></i>
                    <span>داشبورد</span> </a></li>
            @can('slider')
                <li><a href="#"><i class="icon ti-layers-alt"></i> <span>مدیریت سایت
                  <x-ContactUs :/>
                </span> </a>
                    <ul>

                        @can('slider')
                            <li><a href="#">اسلایدر</a>
                                <ul>
                                    <li><a href="/panel/home/slider">مشاهده </a></li>
                                    <li><a href="/panel/home/slider/create">ایجاد </a></li>
                                </ul>
                            </li>
                        @endcan
                        @can('service')
                            <li><a href="#">خدمات و تعرفه ها</a>
                                <ul>
                                    <li><a href="/panel/home/service">مشاهده </a></li>
                                    <li><a href="/panel/home/service/create">ایجاد </a></li>
                                </ul>
                            </li>
                        @endcan
                        @can('blog')

                            <li><a href="#">وبلاگ</a>
                                <ul>
                                    <li><a href="/panel/home/blog">مشاهده </a></li>
                                    <li><a href="/panel/home/blog/create">ایجاد </a></li>
                                </ul>
                            </li>
                        @endcan
                        @can('about')
                            <li><a href="/panel/home/about_us">درباره ما </a></li>
                        @endcan
                        @can('contact')
                            <li><a href="/panel/home/contact_us">تماس با ما
                              <x-ContactUs :/>
                            </a></li>

                        @endcan
                    </ul>
                </li>
            @endcan
            @can('consult-list')
                <li><a href="#"><i class="icon ti-user"></i> <span>مدیریت مشاوران
                                                    <x-DebtConsult :/>

                        </span> </a>
                    <ul>
                        <li><a href="/panel/home/consult">لیست </a></li>
                        @can('consult-create')

                            <li><a href="/panel/home/consult/create">ایجاد </a></li>
                        @endcan
                        @can('finance-consult')
                            <li><a href="/panel/home/consult_debt">بدهکاری
                                    <x-DebtConsult :/>

                                </a></li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('student-list')
                <li><a href="#"><i class="icon ti-user"></i> <span>مدیریت دانش آموزان</span> </a>
                    <ul>


                        <li><a href="/panel/student">لیست </a></li>
                        @can('student-create')

                            <li><a href="/panel/student/create">ایجاد </a></li>
                            <li><a href="#"> <span>تفکیک ماه</span> </a>
                                <ul>
                                    <li><a href="/panel/student/count/1">ثبت نامی </a></li>
                                    <li><a href="/panel/student/count/2">تمدید اول </a></li>
                                    <li><a href="/panel/student/count/3">تمدید دوم </a></li>
                                    <li><a href="/panel/student/count/4">تمدید سوم </a></li>
                                    <li><a href="/panel/student/count/5">تمدید چهارم </a></li>
                                    <li><a href="/panel/student/count/6">تمدید پنجم </a></li>
                                    <li><a href="/panel/student/count/7">تمدید ششم </a></li>
                                    <li><a href="/panel/student/count/8">تمدید هفتم </a></li>
                                    <li><a href="/panel/student/count/9">تمدید هشتم </a></li>
                                    <li><a href="/panel/student/count/10">تمدید نهم </a></li>
                                </ul>
                            </li>
                            <li><a href="#"> <span>لیست تراز </span> </a>
                                <?php
                                $tests = \Illuminate\Support\Facades\DB::table('tests')->get();
                                ?>
                                <ul>
                                    @foreach($tests as $test)
                                        <li><a href="/panel/taraz/index/{{$test->id}}">{{$test->name}}</a></li>
                                    @endforeach
                                </ul>
                            </li>


                            <li><a href="/panel/taraz">ثبت تراز </a></li>
                        @endcan
                    </ul>

                </li>
            @endcan
            @can('user-list')
                <li><a href="#"><i class="icon ti-user"></i> <span>جذب کنندگان
                                                        <x-DebtCaller :/>

                        </span> </a>
                    <ul>
                        <li><a href="/panel/users">مشاهده </a></li>
                        <li><a href="/panel/users/create">ایجاد </a></li>
                        @can('caller-finance')
                            <li><a href="/panel/caller_debt">بدهکاری
                                    <x-DebtCaller :/>

                                </a></li>
                        @endcan

                    </ul>
                </li>
                @can('finance-list')
                <li><a href="/panel/manager_debt">
                        <i class="icon ti-user"></i>
                        بدهکاری به مدیریت
                        <x-DebtorManager :/>
                    </a></li>
                           <li><a href="/panel/home/super_consult_debt">
                            <i class="icon ti-user"></i>
                            بدهکاری به سرمشاور
                            <x-DebtSuperConsult :/>
                        </a></li>
                <li><a href="/panel/financeExcel">
                        <i class="icon ti-money"></i>
                        اکسل مالی
                    </a></li>
                      <li><a href="/panel/home/contact_us_2/export">
                        <i class="icon ti-money"></i>
                        اکسل  همایش
                    </a></li>
                    <li><a href="/panel/comments">
                            <i class="icon ti-comment"></i>
                            اکسل  کامنت ها
                        </a></li>
            @endcan
            @endcan


            {{--            @can('finance')--}}
            {{--                <li><a href="#"><i class="icon ti-user"></i> <span>مدیریت مالی</span> </a>--}}
            {{--                    <ul>--}}
            {{--                        @can('finance-list')--}}
            {{--                            <li><a href="/panel/finance"> دانش آموزان</a>--}}
            {{--                                <ul>--}}
            {{--                                    @can('finance-list')--}}
            {{--                                        <li><a href="/panel/finance"><i class="icon ti-layers-alt"></i>لیست پرداخت ها--}}
            {{--                                            </a></li>--}}
            {{--                                    @endcan--}}
            {{--                                    @can('finance-create')--}}
            {{--                                        <li><a href="/panel/finance/create"><i class="icon ti-layers-alt"></i>پرداخت--}}
            {{--                                                جدید</a></li>--}}
            {{--                                    @endcan--}}
            {{--                                </ul>--}}
            {{--                            </li>--}}
            {{--                        @endcan--}}
            {{--                        @can('finance-consult')--}}
            {{--                            <li><a href="/panel/finance">مشاوران</a>--}}
            {{--                                <ul>--}}
            {{--                                    <li><a href="/panel/finance"><i class="icon ti-layers-alt"></i>لیست پرداخت ها </a>--}}
            {{--                                    </li>--}}
            {{--                                    <li><a href="/panel/finance/create"><i class="icon ti-layers-alt"></i>پرداخت--}}
            {{--                                            جدید</a>--}}
            {{--                                    </li>--}}
            {{--                                </ul>--}}
            {{--                            </li>--}}
            {{--                        @endcan--}}
            {{--                    </ul>--}}
            {{--                </li>--}}
            {{--            @endcan--}}

            {{--            @can('call-list')--}}
            {{--                <li><a href="#"><i class="icon ti-layers-alt"></i>اسکرین تماس ها</a>--}}
            {{--                    <ul>--}}
            {{--                        <li><a href="/panel/home/slider">مشاهده </a></li>--}}
            {{--                        @can('call-create')--}}
            {{--                            <li><a href="/panel/home/slider/create">آپلود </a></li>--}}
            {{--                        @endcan--}}
            {{--                    </ul>--}}
            {{--                </li>--}}
            {{--            @endcan--}}
            {{--            @can('program-list')--}}
            {{--                <li><a href="#"><i class="icon ti-layers-alt"></i> &nbsp &nbsp<span>الگو ها</span> </a>--}}
            {{--                    <ul>--}}
            {{--                        <li><a href="/panel/pattern/create">ایحاد الگو جدید</a></li>--}}
            {{--                        <li><a href="/panel/pattern">نمایش الگو ها </a></li>--}}
            {{--                        <li><a href="/panel/pattern/report/dailyReport">گزارش روزانه </a></li>--}}
            {{--                        <li><a href="/panel/pattern/report/monthReport">گزارش ماهیانه </a></li>--}}
            {{--                    </ul>--}}
            {{--                </li>--}}
            {{--            @endcan--}}

            {{--            student         --}}
            {{--            @can('service-show-student')--}}
            {{--                <li><a href="/panel/student/service"><i class="icon ti-layers-alt"></i>دوره من</a></li>--}}
            {{--            @endcan--}}
            @can('consult-show-student')
                <li><a href="/panel/students/consult/show"><i class="icon ti-layers-alt"></i>مشاور من</a></li>
            @endcan
            @can('student-finance-single')
                <li><a href="/panel/student/finance"><i class="icon ti-layers-alt"></i>مالی</a></li>
            @endcan
            @can('finance-consult-show')
                <li>
                    <a href="/panel/consult/finance/auth"><i

                            class="icon ti-layers-alt"></i>مالی</a></li>
            @endcan
            @can('caller-finance-single')
                <li><a href="/panel/caller/finance/{{auth()->user()->id}}"><i class="icon ti-layers-alt"></i>مالی</a>
                </li>
            @endcan
            {{--            <li>--}}
            {{--                <a href="/panel/students/pattern">--}}
            {{--                    <i class="fa fa-window-maximize"></i>--}}
            {{--                    &nbsp &nbsp--}}
            {{--                    <span>الگو مطالعه</span></a>--}}
            {{--            </li>--}}
            {{--            @can('content-list')--}}
            {{--                <li><a href="#"><i class="icon ti-layers-alt"></i>مطالب پیشنهادی</a>--}}
            {{--                    <ul>--}}
            {{--                        <li><a href="/panel/suggest">مشاهده </a></li>--}}
            {{--                        @can('content-create')--}}
            {{--                            <li><a href="/panel/suggest/create">آپلود </a></li>--}}
            {{--                        @endcan--}}
            {{--                    </ul>--}}
            {{--                </li>--}}
            {{--            @endcan--}}
            @can('update-site')
                <li>
                    <a href="/panel/updateSite">
                        <button class="btn btn-info">آپدیت</button>
                    </a>
                </li>
            @endcan


        </ul>
    </div>
</div>
