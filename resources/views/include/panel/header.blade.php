<nav class="navbar">
    <div class="container-fluid">


            <a href="#">
                <img src="/home/assets/images/logo/logo2.png">

            </a>


        <div class="header-body">
            <ul class="navbar-nav">
                <li class="nav-item dropdown d-none d-lg-block">
                    <a href="#" class="nav-link" data-toggle="dropdown">
                        <i class="fa fa-th-large"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-nav-grid">
                        <div class="dropdown-menu-title">منوی سریع</div>
                        <div class="dropdown-menu-body">
                            <div class="nav-grid">
                                <div class="nav-grid-row">
                                    <a href="#" class="nav-grid-item">
                                        <i class="fa fa-address-book-o"></i>
                                        <span>نرم افزار</span>
                                    </a>
                                    <a href="#" class="nav-grid-item">
                                        <i class="fa fa-envelope-o"></i>
                                        <span>ایمیل</span>
                                    </a>
                                </div>
                                <div class="nav-grid-row">
                                    <a href="#" class="nav-grid-item">
                                        <i class="fa fa-sticky-note"></i>
                                        <span>گفتگو</span>
                                    </a>
                                    <a href="#" class="nav-grid-item">
                                        <i class="fa fa-dashboard"></i>
                                        <span>داشبورد</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
            <form class="search">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="جستجو ..." aria-label="Recipient's username"
                           aria-describedby="button-addon2">
                    <div class="input-group-append">
                        <button class="btn" type="button" id="button-addon2">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="#" class="d-lg-none d-sm-block nav-link search-panel-open">
                        <i class="fa fa-search"></i>
                    </a>
                </li>
            
                @can('notif-student')
                <li class="nav-item">
                    <a href="/panel/notification" class="nav-link nav-link-notify " >
                        <i class="fa fa-bell">
                            <x-NotificationComponent :/>
                        </i>
                    </a>
                </li>
                    <li class="nav-item">
                        <a href="/panel/reminder/list" class="nav-link nav-link-notify" title="reminder">
                            <i class="fa fa-bell-o">
                                <x-Reminder :/>
                            </i>
                        </a>
                    </li>
                @endcan
                <li style="color:#000;">
                    {{auth()->user()->name}} -
                    {{auth()->user()->family}}
                </li>
                <li class="nav-item dropdown">
                    <a href="#" data-toggle="dropdown">
                        <figure class="avatar avatar-sm avatar-state-success">
                            <img class="rounded-circle" src="/panel/assets/media/image/avatar.jpg" alt="...">
                        </figure>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="/profile" class="dropdown-item">پروفایل</a>
                        <div class="dropdown-divider"></div>
                        <a href="/logout" class="text-danger dropdown-item">خروج</a>
                    </div>
                </li>
                <li class="nav-item d-lg-none d-sm-block">
                    <a href="#" class="nav-link side-menu-open">
                        <i class="ti-menu"></i>
                    </a>
                </li>
            </ul>
        </div>

    </div>
</nav>
