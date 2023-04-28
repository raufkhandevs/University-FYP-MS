<div class="top_nav">
    <div class="nav_menu">
        <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>
        <nav class="nav navbar-nav">
            <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown"
                        data-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset(auth()->user()->avatar != null ? User::USER_AVATAR_PATH . auth()->user()->avatar : User::DEFAULT_AVATAR) }}"
                            alt="">
                        {{ auth()->user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="javascript:;"> Profile</a>
                        <a class="dropdown-item" href="javascript:;">
                            <span class="badge bg-red pull-right">50%</span>
                            <span>Settings</span>
                        </a>
                        <a class="dropdown-item" href="javascript:;">Contact</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"><i
                                class="fa fa-sign-out pull-right"></i>
                            Log Out
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>

                    </div>
                </li>

                {{-- notifications --}}
                <li role="presentation" class="nav-item dropdown open">
                    <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1"
                        data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-bell"></i>
                        <span class="badge bg-green">{{ auth()->user()->unreadNotifications->count() }}</span>
                    </a>
                    <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
                        @forelse (auth()->user()->unreadNotifications as $notification)
                            <li class="nav-item">
                                <a href="{{ route('notification.index') }}" class="dropdown-item">

                                    {{-- <span class="image"><img src="" alt="Profile Image" /></span> --}}
                                    <span>
                                        <span><b>{{ $notification->data['name'] }}</b></span>
                                        <span class="time">{{ $notification->created_at->diffForHumans() }}</span>
                                    </span>
                                    <span class="message">
                                        {{ $notification->data['message'] }}
                                    </span>
                                </a>
                            </li>
                        @empty
                            <li class="nav-item">
                                <a class="dropdown-item">
                                    <span class="message">
                                        No New Notifications :)
                                    </span>
                                </a>
                            </li>
                        @endforelse

                        <li class="nav-item">
                            <a href="{{ route('notification.index') }}" class="dropdown-item">
                                <span class="message">
                                    All Notifications
                                </span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>
