{{-- <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow erpnewsidemenu"
data-scroll-to-active="true">

<div class="shadow-bottom"></div>
<div class="main-menu-content newmodulleftmenu">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">


        <li class="nav-item"><a class="d-flex align-items-center" href="{{url('sport-master')}}"><i
                    data-feather="grid"></i><span class="menu-title text-truncate">Sports Master</span></a>
        </li>

        <li class="nav-item"><a class="d-flex align-items-center" href="{{url('sports-fee-schedule')}}"><i
                    data-feather="file-text"></i><span class="menu-title text-truncate">Fee Master</span></a>
        </li>

        <li class="nav-item"><a class="d-flex align-items-center" href="{{url('sports-students')}}"><i
                    data-feather="users"></i><span class="menu-title text-truncate">Student</span></a>
        </li>

        <li class="nav-item"><a class="d-flex align-items-center" href="index.html"><i
                    data-feather="activity"></i><span class="menu-title text-truncate"
                    data-i18n="Dashboards">Activity</span></a>
            <ul class="menu-content">
                <li><a class="d-flex align-items-center" href="{{url('activity-master')}}"><i
                            data-feather="circle"></i><span class="menu-item text-truncate">Master</span></a>
                </li>
                <li><a class="d-flex align-items-center" href="{{url('activity-scheduler')}}"><i
                            data-feather="circle"></i><span
                            class="menu-item text-truncate">Scheduler</span></a></li>
                <li><a class="d-flex align-items-center" href="#"><i
                            data-feather="circle"></i><span
                            class="menu-item text-truncate">Attendance</span></a></li>
                <li><a class="d-flex align-items-center" href="#"><i
                            data-feather="circle"></i><span
                            class="menu-item text-truncate">Assessment</span></a></li>
            </ul>
        </li>


    </ul>
</div>

</div> --}}

<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow erpnewsidemenu"
data-scroll-to-active="true">

<div class="shadow-bottom"></div>
<div class="main-menu-content newmodulleftmenu">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">


        <li class="nav-item"><a class="d-flex align-items-center" href="{{url('sport-master')}}"><i
                    data-feather="grid"></i><span class="menu-title text-truncate">Sports Master</span></a>
        </li>

        <li class="nav-item"><a class="d-flex align-items-center" href="{{url('sports-fee-schedule')}}"><i
                    data-feather="file-text"></i><span class="menu-title text-truncate">Fee Master</span></a>
        </li>

        <li class="nav-item"><a class="d-flex align-items-center" href="{{url('sports-students')}}"><i
                    data-feather="users"></i><span class="menu-title text-truncate">Student</span></a>
        </li>

        <li class="{{ Route::currentRouteName() == 'book' || Route::currentRouteName() == 'book_create' || Route::currentRouteName() == 'bookEdit' ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('book') }}"><i
                            data-feather="circle"></i><span class="menu-item text-truncate">Series</span></a>
            </li>


        <li class="nav-item"><a class="d-flex align-items-center" href=""><i
                    data-feather="activity"></i><span class="menu-title text-truncate"
                    data-i18n="Dashboards">Activity</span></a>
            <ul class="menu-content">
                <li><a class="d-flex align-items-center" href="{{url('activity-master')}}"><i
                            data-feather="circle"></i><span class="menu-item text-truncate">Master</span></a>
                </li>
                <li><a class="d-flex align-items-center" href="{{url('activity-scheduler')}}"><i
                            data-feather="circle"></i><span
                            class="menu-item text-truncate">Scheduler</span></a></li>
                <li><a class="d-flex align-items-center" href="#"><i
                            data-feather="circle"></i><span
                            class="menu-item text-truncate">Attendance</span></a></li>
                <li><a class="d-flex align-items-center" href="#"><i
                            data-feather="circle"></i><span
                            class="menu-item text-truncate">Assessment</span></a></li>
            </ul>
        </li>



 <li class="nav-item"><a class="d-flex align-items-center" href="index.html"><i
                    data-feather="file-text"></i><span class="menu-title text-truncate"
                    data-i18n="Dashboards">Master</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="{{url('sport-type')}}"><i
                            data-feather="circle"></i><span
                            class="menu-item text-truncate">Sports Type Master</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="{{url('quota-master')}}"><i
                            data-feather="circle"></i><span
                            class="menu-item text-truncate">Quota Master</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="{{url('master-batches')}}"><i
                            data-feather="circle"></i><span
                            class="menu-item text-truncate">Batch  Master</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="{{url('section-master')}}"><i
                            data-feather="circle"></i><span
                            class="menu-item text-truncate">Section Master</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="{{url('group-master')}}"><i
                            data-feather="circle"></i><span
                            class="menu-item text-truncate">Group Master</span></a>
                        </li>
                    </ul>

 </li>
    </ul>
</div>

</div>
