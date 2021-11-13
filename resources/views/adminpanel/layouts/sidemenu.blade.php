<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse slimscrollsidebar">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search hidden-sm hidden-md hidden-lg">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button"> <i class="fa fa-search"></i> </button>
                    </span>
                </div>
            </li>

            <li class="user-pro">
                <a href="#" class="waves-effect">
                    <img src="{{ asset('content/images/user.png') }}" alt="user-img" class="img-circle"> <span
                        class="hide-menu"><span class="fa arrow">

                        </span>
                    </span>
                </a>
                <ul class="nav nav-second-level collapse">
                    @if(auth()->user()->user_role == 'Admin')
                        <li>
                            <a href="{{ route('manageUser.index') }}">{{ locale_words('ManageUser') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('register',app()->getLocale()) }}">Register New User</a>
                        </li>
                    @endif
                    <li>
                        <a href="{{ route('password.request',app()->getLocale()) }}">{{ locale_words('ChangePass') }}</a>
                    </li>
                </ul>
            </li>
            @foreach($sideMenus as $menu)
                @if(isset($menu->submenus))
                    <li><a href="/adminpanel/{{ $menu->menu_link }}"><i class="{{ $menu->menu_icon }}"></i>
                            {{ $menu->menu_name }}
                            <span class="label label-rouded label-success pull-right"></span>
                        </a></li>
                @else
                    <li>
                        <a href="#" class="waves-effect"><i data-icon="" class="{{ $menu->menu_icon }}"></i> <span
                                class="hide-menu">{{ $menu->menu_name }}
                                <span class="tooltipim" data-toggle="tooltip" title=""
                                      data-original-title="Edit other pages except tours."><i
                                        class="fa fa-question-circle"></i></span>
                                <span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level collapse">
                            @foreach($menu->submenus as $sub)
                                <li><a href="{{ $menu->menu_link }}/{{ $sub->menu_link }}" class="waves-effect"><i
                                            class="fa fa-file"></i>
                                        <span class="hide-menu">{{ $sub->menu_name }}<span class="tooltipim"
                                                                                           data-toggle="tooltip"
                                                                                           title=""
                                                                                           data-original-title="Edit the title, description and keywords for your {{ $sub->menu_name }} content and search engine"><i
                                                    class="fa fa-question-circle"></i></span></span></a></li>
                            @endforeach
                        </ul>
                    </li>
                @endif
            @endforeach
            <li class="text-center">
                    <form id="logout-form" action="{{ route('logout',app()->getLocale()) }}" method="POST">
                        @csrf
                        <button class="btn btn-danger" type="submit"><i
                                class="fa fa-power-off"></i> {{ locale_words('Logout') }}</button>
                    </form>
            </li>
        </ul>
    </div>
</div>
