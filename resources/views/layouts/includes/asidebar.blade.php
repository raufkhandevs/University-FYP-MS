<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title mb-2" style="border: 0;">
            <a href="{{ auth()->user()->hasRole(Role::ROLE_STUDENT)? route('dashboard'): route('faculty.dashboard') }}"
                class="site_title">
                <img src="{{ asset('assets/images/imgs/' . $setting->header_logo) }}" width="50px" alt="">
                <span class="ml-2">
                    {{ $setting->main_title }}
                </span>
            </a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix ml-2">
            <div class="profile_pic">
                <img src="{{ asset(auth()->user()->avatar != null ? User::USER_AVATAR_PATH . auth()->user()->avatar : User::DEFAULT_AVATAR) }}"
                    alt="..." class="img-circle mt-2" width="100%">
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{ auth()->user()->name }}</h2>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                    @can('view_usersmanagements')
                        <li><a><i class="fa fa-male"></i> Role Managment <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="{{ route('faculty.roles.index') }}">Roles</a></li>
                                <li><a href="{{ route('faculty.permissions.index') }}">Permissions</a></li>
                                <li><a href="{{ route('faculty.users.index') }}">Users</a></li>
                            </ul>
                        </li>
                    @endcan

                    @can('view_students')
                        <li><a><i class="fa fa-graduation-cap"></i> Students Management <span
                                    class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="{{ route('faculty.students.index') }}">All Students</a></li>
                            </ul>
                        </li>
                    @endcan

                    @can('view_fypregistrationnumbers')
                        <li><a><i class="fa fa-desktop"></i> FYP Registrations <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                @if (auth()->user()->hasRole(Role::ROLE_STUDENT))
                                    <li><a href="{{ route('registration.create') }}">Registration Form</a></li>
                                    <li><a href="{{ route('project.allocation.create') }}">Allocation Form</a></li>
                                @endif

                                @can('update_fypregistrationnumbers')
                                    <li><a href="{{ route('faculty.fyp-registration.index') }}">Registration Requests</a></li>
                                    <li><a href="{{ route('faculty.project.allocation.index') }}">Allocation Requests</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endcan

                    @can('view_projects')
                        <li><a><i class="fa fa-list"></i> Projects <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="{{ route('faculty.projects.index') }}">All Projects</a></li>
                            </ul>
                        </li>
                    @endcan

                    @can('view_meetups')
                        <li><a><i class="fa fa-table"></i> Meetups <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="{{ route('faculty.meetups.index') }}">My Meetups</a></li>
                                <li><a href="{{ route('faculty.meetups.index.requests') }}">Meetups Requests</a></li>
                            </ul>
                        </li>
                    @endcan

                    @can('view_panels')
                        <li><a><i class="fa fa-cubes"></i>Panels <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="{{ route('faculty.panels.index') }}">All Panels</a></li>
                            </ul>
                        </li>
                    @endcan

                    <li><a><i class="fa fa-bar-chart-o"></i>Results <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="javascript:void(0)">Coming Soon</a></li>
                        </ul>
                    </li>

                    @can('view_groups')
                        <li><a><i class="fa fa-group"></i>Groups <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                @if (auth()->user()->hasRole(Role::ROLE_STUDENT))
                                    <li><a href="{{ route('groups.index') }}">Group Making</a></li>
                                @endif
                                <li><a href="{{ route('faculty.groups.index-all') }}">Groups </a></li>
                            </ul>
                        </li>
                    @endcan

                    @can('view_submissions')
                        <li><a><i class="fa fa-paperclip"></i>Submissions <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="{{ route('faculty.submission-types.index') }}">Types</a></li>
                                <li><a href="{{ route('faculty.submissions.index') }}">Submissions</a></li>
                            </ul>
                        </li>
                    @endcan

                    <li><a><i class="fa fa-list-alt"></i>Fields <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="javascript:void(0)">Coming Soon</a></li>
                        </ul>
                    </li>
                    @can('view_defenses')
                        <li><a><i class="fa fa-university"></i>Defense <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="{{ route('faculty.defense-types.index') }}">Types</a></li>
                                <li><a href="{{ route('faculty.defenses.index') }}">All Defenses</a></li>
                                <li><a href="{{ route('faculty.pre-defenses.index') }}">Pre Defense Evaluation</a></li>
                                <li><a href="{{ route('faculty.defenses.final.index') }}">Final Defense Evaluation</a></li>
                            </ul>
                        </li>
                    @endcan

                    @can('view_finalgrades')
                        <li><a><i class="fa fa-calculator"></i>Grades <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="{{ route('faculty.final-grades.index') }}">Mark Grades</a></li>
                            </ul>
                        </li>
                    @endcan

                    <li><a><i class="fa fa-wechat"></i>General Chat <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="javascript:void(0)">Coming Soon</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small" style="background: #172D44 !important;">
            @if (auth()->user()->hasRole(Role::ROLE_SUPER_ADMIN))
                <a data-toggle="tooltip" data-placement="top" title="Settings">
                    <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                </a>
                <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                    <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                </a>
                <a data-toggle="tooltip" data-placement="top" title="Lock">
                    <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                </a>
            @endif
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{ route('logout') }}"
                onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>
