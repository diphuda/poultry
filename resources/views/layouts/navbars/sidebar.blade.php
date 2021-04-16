<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        @if(Auth::user()->role->id == 1)
            <a class="navbar-brand pt-0" href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('argon') }}/img/brand/blue.png" class="navbar-brand-img" alt="...">
            </a>
        @elseif(Auth::user()->role->id == 2)
            <a class="navbar-brand pt-0" href="{{ route('supervisor.dashboard') }}">
                <img src="{{ asset('argon') }}/img/brand/blue.png" class="navbar-brand-img" alt="...">
            </a>
        @elseif(Auth::user()->role->id == 3)
            <a class="navbar-brand pt-0" href="{{ route('warehouse.dashboard') }}">
                <img src="{{ asset('argon') }}/img/brand/blue.png" class="navbar-brand-img" alt="...">
            </a>
        @else
            <a class="navbar-brand pt-0" href="{{ route('login') }}">
                <img src="{{ asset('argon') }}/img/brand/blue.png" class="navbar-brand-img" alt="...">
            </a>
    @endif
    <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                        <img alt="Image placeholder" src="{{ asset('argon') }}/img/theme/team-1-800x800.jpg">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('My profile') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        @if(Auth::user()->role->id == 1)
                            <a class="navbar-brand pt-0" href="{{ route('admin.dashboard') }}">
                                <img src="{{ asset('argon') }}/img/brand/blue.png" class="navbar-brand-img" alt="...">
                            </a>
                        @elseif(Auth::user()->role->id == 2)
                            <a class="navbar-brand pt-0" href="{{ route('supervisor.dashboard') }}">
                                <img src="{{ asset('argon') }}/img/brand/blue.png" class="navbar-brand-img" alt="...">
                            </a>
                        @elseif(Auth::user()->role->id == 3)
                            <a class="navbar-brand pt-0" href="{{ route('warehouse.dashboard') }}">
                                <img src="{{ asset('argon') }}/img/brand/blue.png" class="navbar-brand-img" alt="...">
                            </a>
                        @else
                            <a class="navbar-brand pt-0" href="{{ route('login') }}">
                                <img src="{{ asset('argon') }}/img/brand/blue.png" class="navbar-brand-img" alt="...">
                            </a>
                        @endif
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false"
                                aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Form -->
            <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="{{ __('Search') }}" aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            </form>


            <!--Navigation for supervisor-->
            {{--            @if(Auth::user()->role->id == 2)--}}
            {{--            @endif--}}
            <ul class="navbar-nav">
                @if(Auth::user()->role->id == 1)
                    <li class="nav-item active">
                        <a class="nav-link {{ (Request::is('admin/dashboard'))? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                            <i class="ni ni-tv-2 text-primary"></i> {{ __('Dashboard') }}
                        </a>
                    </li>
                @endif
                @if(Auth::user()->role->id == 2)
                    <li class="nav-item active">
                        <a class="nav-link {{ (Request::is('supervisor/dashboard'))? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                            <i class="ni ni-tv-2 text-primary"></i> {{ __('Dashboard') }}
                        </a>
                    </li>
                @endif
                @if(Auth::user()->role->id == 3)
                    <li class="nav-item {{ (Request::is('warehouse/dashboard'))? 'active' : '' }}">
                        <a class="nav-link {{ (Request::is('warehouse/dashboard'))? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                            <i class="ni ni-tv-2 text-primary"></i> {{ __('Dashboard') }}
                        </a>
                    </li>
                @endif
                <li class="nav-item {{ ((Request::is('raw-item')) || (Request::is('raw-item/create')))? 'active' : '' }}">
                    <a class="nav-link {{ ((Request::is('raw-item')) || (Request::is('raw-item/create')))? 'active' : '' }}" href="#raw-submenu" data-toggle="collapse" role="button"
                       aria-expanded="{{ ((Request::is('raw-item')) || (Request::is('raw-item/create')))? 'true' : 'false' }}" aria-controls="raw-submenu">
                        <i class="ni ni-atom text-green"></i>Raw Items
                    </a>
                    <div class="collapse {{ ((Request::is('raw-item')) || (Request::is('raw-item/create')))? 'show' : 'collapse' }}" id="raw-submenu">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item {{ ((Request::is('raw-item')))? 'active' : '' }}">
                                <a class="nav-link {{ (Request::is('/raw-item'))? 'active' : '' }}" href="{{ route('raw-item.index') }}">
                                    {{ __('All Raw Items') }}
                                </a>
                            </li>
                            <li class="nav-item {{ ((Request::is('raw-item/create')))? 'active' : '' }}">
                                <a class="nav-link {{ (Request::is('/raw-item/create'))? 'active' : '' }}" href="{{ route('raw-item.create') }}">
                                    {{ __('Add Raw Item') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item {{ ((Request::is('supplier')) || (Request::is('supplier/create')))? 'active' : '' }}">
                    <a class="nav-link {{ ((Request::is('supplier')) || (Request::is('supplier/create')))? 'active' : '' }}" href="#raw-submenu" data-toggle="collapse" role="button"
                       aria-expanded="{{ ((Request::is('supplier')) || (Request::is('supplier/create')))? 'true' : 'false' }}" aria-controls="raw-submenu">
                        <i class="ni ni-circle-08 text-orange"></i>Vendors
                    </a>
                    <div class="collapse {{ ((Request::is('supplier')) || (Request::is('supplier/create')))? 'show' : 'collapse' }}" id="raw-submenu">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item {{ ((Request::is('supplier')))? 'active' : '' }}">
                                <a class="nav-link {{ (Request::is('/supplier'))? 'active' : '' }}" href="{{ route('supplier.index') }}">
                                    {{ __('All Vendors') }}
                                </a>
                            </li>
                            <li class="nav-item {{ ((Request::is('supplier/create')))? 'active' : '' }}">
                                <a class="nav-link {{ (Request::is('/supplier/create'))? 'active' : '' }}" href="{{ route('supplier.create') }}">
                                    {{ __('Add Vendor') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

{{--                <li class="nav-item {{ ((Request::is('raw-entry')) || (Request::is('raw-entry/create')))? 'active' : '' }}">--}}
{{--                    <a class="nav-link {{ ((Request::is('raw-entry')) || (Request::is('raw-entry/create')))? 'active' : '' }}" href="#raw-entry-submenu" data-toggle="collapse" role="button"--}}
{{--                       aria-expanded="{{ ((Request::is('raw-entry')) || (Request::is('raw-entry/create')))? 'true' : 'false' }}" aria-controls="raw-submenu">--}}
{{--                        <i class="fas fa-asterisk text-green"></i>Raw Entry--}}
{{--                    </a>--}}
{{--                    <div class="collapse {{ ((Request::is('raw-entry')) || (Request::is('raw-entry/create')))? 'show' : 'collapse' }}" id="raw-entry-submenu">--}}
{{--                        <ul class="nav nav-sm flex-column">--}}
{{--                            <li class="nav-item {{ ((Request::is('raw-entry')))? 'active' : '' }}">--}}
{{--                                <a class="nav-link {{ (Request::is('/raw-entry'))? 'active' : '' }}" href="{{ route('raw-entry.index') }}">--}}
{{--                                    {{ __('All Entries') }}--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item {{ ((Request::is('raw-entry/create')))? 'active' : '' }}">--}}
{{--                                <a class="nav-link {{ (Request::is('/raw-entry/create'))? 'active' : '' }}" href="{{ route('raw-entry.create') }}">--}}
{{--                                    {{ __('Add Entry') }}--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </li>--}}


                <li class="nav-item">
                    <a class="nav-link " href="feed-making.html">
                        <i class="ni ni-chart-pie-35 text-teal"></i> Feed Making
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="finished-goods.html">
                        <i class="ni ni-single-02 text-orange"></i> Finished Goods
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="distribution.html">
                        <i class="ni ni-box-2 text-info"></i> Distribution
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="accounting.html">
                        <i class="ni ni-money-coins text-green"></i> Accounting
                    </a>
                </li>
                @if(Auth::user()->role->id == 1)
                    <li class="nav-item {{ (Request::is('admin/roles'))? 'active' : '' }}" href="{{ route('admin.roles.index') }}">
                        <a class="nav-link {{ (Request::is('admin/roles'))? 'active' : '' }}" href="{{ route('admin.roles.index') }}">
                            <i class="ni ni-tv-2 text-primary"></i> {{ __('Roles') }}
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="ni ni-button-power text-gray"></i> Logout
                    </a>
                </li>
            </ul>


            <!--Navigation for Warehouse-->

        </div>
    </div>
</nav>
