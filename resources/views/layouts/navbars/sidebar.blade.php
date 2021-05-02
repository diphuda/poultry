<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        @if(Gate::check('app.dashboard'))
            <a class="navbar-brand pt-0" href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('argon') }}/img/brand/blue.png" class="navbar-brand-img" alt="...">
            </a>
    @endif
    <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                        <img alt="Image placeholder" src="{{ asset('argon') }}/img/user.png">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
                    </div>
{{--                    <a href="{{ route('profile.edit') }}" class="dropdown-item">--}}
{{--                        <i class="ni ni-single-02"></i>--}}
{{--                        <span>{{ __('My profile') }}</span>--}}
{{--                    </a>--}}
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
                        @if(Gate::check('app.dashboard'))
                            <a class="navbar-brand pt-0" href="{{ route('admin.dashboard') }}">
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
            <!-- Form
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
            -->

            <ul class="navbar-nav">
                @if(Gate::check('app.dashboard'))
                    <li class="nav-item {{ (Request::is('dashboard'))? 'active' : '' }}">
                        <a class="nav-link {{ (Request::is('dashboard'))? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                            <i class="ni ni-tv-2 text-warning"></i> {{ __('Dashboard') }}
                        </a>
                    </li>
                @endif
                @if(Gate::check('app.raw.index') || Gate::check('app.raw.create') || Gate::check('app.raw.edit') || Gate::check('app.raw.destroy'))
                    <li class="nav-item {{ ((Request::is('raw-item')) || (Request::is('raw-item/create')))? 'active' : '' }}">
                        <a class="nav-link {{ ((Request::is('raw-item')) || (Request::is('raw-item/create')))? 'active' : '' }}" href="#raw-submenu" data-toggle="collapse" role="button"
                           aria-expanded="{{ ((Request::is('raw-item')) || (Request::is('raw-item/create')))? 'true' : 'false' }}" aria-controls="raw-submenu">
                            <i class="ni ni-atom text-primary"></i>Raw Items
                        </a>
                        <div class="collapse {{ ((Request::is('raw-item')) || (Request::is('raw-item/create')))? 'show' : 'collapse' }}" id="raw-submenu">
                            <ul class="nav nav-sm flex-column">
                                @if(Gate::check('app.raw.index'))
                                    <li class="nav-item {{ ((Request::is('raw-item')))? 'active' : '' }}">
                                        <a class="nav-link {{ (Request::is('/raw-item'))? 'active' : '' }}" href="{{ route('raw-item.index') }}">
                                            {{ __('All Raw Items') }}
                                        </a>
                                    </li>
                                @endif
                                @if(Gate::check('app.raw.create'))
                                    <li class="nav-item {{ ((Request::is('raw-item/create')))? 'active' : '' }}">
                                        <a class="nav-link {{ (Request::is('/raw-item/create'))? 'active' : '' }}" href="{{ route('raw-item.create') }}">
                                            {{ __('Add Raw Item') }}
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </li>
                @endif

                @if(Gate::check('app.vendor.index') || Gate::check('app.vendor.create') || Gate::check('app.vendor.edit') || Gate::check('app.vendor.destroy'))
                    <li class="nav-item {{ ((Request::is('supplier')) || (Request::is('supplier/create')))? 'active' : '' }}">
                        <a class="nav-link {{ ((Request::is('supplier')) || (Request::is('supplier/create')))? 'active' : '' }}" href="#vendor" data-toggle="collapse" role="button"
                           aria-expanded="{{ ((Request::is('supplier')) || (Request::is('supplier/create'))) ? 'true' : 'false' }}" aria-controls="raw-submenu">
                            <i class="ni ni-circle-08 text-info"></i>Vendors
                        </a>
                        <div class="collapse {{ ((Request::is('supplier')) || (Request::is('supplier/create')))? 'show' : 'collapse' }}" id="vendor">
                            <ul class="nav nav-sm flex-column">
                                @if(Gate::check('app.vendor.index'))
                                    <li class="nav-item {{ ((Request::is('supplier')))? 'active' : '' }}">
                                        <a class="nav-link {{ (Request::is('/supplier'))? 'active' : '' }}" href="{{ route('supplier.index') }}">
                                            {{ __('All Vendors') }}
                                        </a>
                                    </li>
                                @endif

                                @if(Gate::check('app.vendor.create'))
                                    <li class="nav-item {{ ((Request::is('supplier/create')))? 'active' : '' }}">
                                        <a class="nav-link {{ (Request::is('/supplier/create'))? 'active' : '' }}" href="{{ route('supplier.create') }}">
                                            {{ __('Add Vendor') }}
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </li>
                @endif

                @if(Gate::check('app.entry.index') || Gate::check('app.entry.edit'))
                    <li class="nav-item {{ (request()->is('ingredient*')) ? 'active' : '' }}">
                        <a class="nav-link {{ (request()->is('ingredient*')) ? 'active' : '' }}" href="#ingredient-submenu" data-toggle="collapse" role="button"
                           aria-expanded="{{ (request()->is('ingredient*')) ? 'true' : 'false' }}" aria-controls="ingredient-submenu">
                            <i class="fas fa-asterisk text-green"></i>Raw Entry
                        </a>
                        <div class="collapse {{ (request()->is('ingredient*')) ? 'show' : 'collapse' }}" id="ingredient-submenu">
                            <ul class="nav nav-sm flex-column">
                                @if(Gate::check('app.entry.index'))
                                    <li class="nav-item {{ (request()->is('ingredient')) ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('ingredient.index') }}">
                                            {{ __('All Entries') }}
                                        </a>
                                    </li>
                                @endif

                                @if(Gate::check('app.entry.create'))
                                    <li class="nav-item {{ (request()->is('ingredient/create')) ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('ingredient.create') }}">
                                            {{ __('Add Entry') }}
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </li>
                @endif

                @if(Gate::check('app.entry.approve'))
                    <li class="nav-item {{ (Request::is('pending'))? 'active' : '' }}">
                        <a class="nav-link {{ (Request::is('pending'))? 'active' : '' }}" href="{{ route('ingredient.pending') }}">
                            <i class="fas fa-exclamation-triangle text-warning"></i> {{ __('Pending Approvals') }}
                            @if($pendingCount)
                                <span class="badge badge-warning ml-2">{{ $pendingCount }}</span>
                            @else
                                <span class="badge badge-success ml-2">0</span>
                            @endif
                        </a>
                    </li>
                @endif

                @if(Gate::check('app.feed.index') || Gate::check('app.feed.create'))
                    <li class="nav-item {{ (request()->is('feed*')) ? 'active' : '' }}">
                        <a class="nav-link {{ (request()->is('feed*')) ? 'active' : '' }}" href="#feed" data-toggle="collapse" role="button"
                           aria-expanded="{{ (request()->is('ingredient*')) ? 'true' : 'false' }}" aria-controls="feed">
                            <i class="fa fa-pie-chart text-primary"></i>Feed
                        </a>
                        <div class="collapse {{ (request()->is('feed*')) ? 'show' : 'collapse' }}" id="feed">
                            <ul class="nav nav-sm flex-column">
                                @if(Gate::check('app.feed.index'))
                                    <li class="nav-item {{ (request()->is('feed')) ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('feed.index') }}">
                                            {{ __('Feed List') }}
                                        </a>
                                    </li>
                                @endif

                                @if(Gate::check('app.feed.create'))
                                    <li class="nav-item {{ (request()->is('feed/create')) ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('feed.create') }}">
                                            {{ __('Make Feed') }}
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </li>
                @endif

                @if(Gate::check('app.dist.index') || Gate::check('app.dist.create') || Gate::check('app.dist.edit') || Gate::check('app.dist.destroy'))
                    <li class="nav-item {{ (request()->is('distribution*')) ? 'active' : '' }}">
                        <a class="nav-link {{ (request()->is('distribution*')) ? 'active' : '' }}" href="#distribution" data-toggle="collapse" role="button"
                           aria-expanded="{{ (request()->is('distribution*')) ? 'true' : 'false' }}" aria-controls="distribution">
                            <i class="ni ni-box-2 text-info"></i>Distribution
                        </a>
                        <div class="collapse {{ (request()->is('distribution*')) ? 'show' : 'collapse' }}" id="distribution">
                            <ul class="nav nav-sm flex-column">
                                @if(Gate::check('app.dist.index'))
                                    <li class="nav-item {{ (request()->is('distribution')) ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('distribution.index') }}">
                                            {{ __('Distribution History') }}
                                        </a>
                                    </li>
                                @endif

                                @if(Gate::check('app.dist.create'))
                                    <li class="nav-item {{ (request()->is('distribution/create')) ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('distribution.create') }}">
                                            {{ __('Create Distribution') }}
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </li>
                @endif
                @if(Gate::check('app.roles.index') || Gate::check('app.roles.create') || Gate::check('app.roles.edit') || Gate::check('app.roles.destroy'))
                    <li class="nav-item {{ (request()->is('roles*'))? 'active' : '' }}">
                        <a class="nav-link {{ (request()->is('roles*'))? 'active' : '' }}" href="{{ route('roles.index') }}">
                            <i class="ni ni-ui-04 text-orange"></i> {{ __('Roles & Permissions   ') }}
                        </a>
                    </li>
                @endif
                @if(Gate::check('app.users.index') || Gate::check('app.users.create') || Gate::check('app.users.edit') || Gate::check('app.users.destroy'))
                    <li class="nav-item {{ (request()->is('users*')) ? 'active' : '' }}">
                        <a class="nav-link {{ (request()->is('users*')) ? 'active' : '' }}" href="{{ route('users.index') }}">
                            <i class="fas fa-users-cog text-success"></i></i> {{ __('User Management') }}
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}">
                        <i class="ni ni-button-power text-gray"></i> Logout
                    </a>
                </li>
            </ul>


            <!--Navigation for Warehouse-->

        </div>
    </div>
</nav>
