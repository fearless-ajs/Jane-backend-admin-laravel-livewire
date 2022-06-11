<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto"><a class="navbar-brand" href="{{route('admin.dashboard')}}"><span class="brand-logo">
                            <svg viewbox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="24">
                                <defs>
                                    <lineargradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%" y2="89.4879456%">
                                        <stop stop-color="#000000" offset="0%"></stop>
                                        <stop stop-color="#FFFFFF" offset="100%"></stop>
                                    </lineargradient>
                                    <lineargradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%" x2="37.373316%" y2="100%">
                                        <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                                        <stop stop-color="#FFFFFF" offset="100%"></stop>
                                    </lineargradient>
                                </defs>
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="Artboard" transform="translate(-400.000000, -178.000000)">
                                        <g id="Group" transform="translate(400.000000, 178.000000)">
                                            <img src="{{$settings->AppImage}}" style="margin-left: -35px;" />
                                        </g>
                                    </g>
                                </g>
                            </svg></span>
                    <h2 class="brand-text">{{$settings->app_name}}</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item"><a class="d-flex align-items-center" href="{{route('admin.dashboard')}}"><i class="fa fa-home"></i><span class="menu-title text-truncate" >Dashboard</span></a>
            </li>
            <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Apps &amp; Pages</span><i data-feather="more-horizontal"></i>
            </li>



            @if(Auth::user()->hasRole('super-admin'))
                <li class="nav-item @if(Route::currentRouteName() == 'admin.companies' || Route::currentRouteName() == 'company.create-invoice') active @endif"><a class="d-flex align-items-center" href="#"><i class="fa fa-users"></i><span class="menu-title text-truncate" data-i18n="Invoice">Companies</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center @if(Route::currentRouteName() == 'admin.companies') active @endif" href="{{route('admin.companies')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">List</span></a>
                        </li>
                    </ul>
                </li>
            @endif



            @if(Auth::user()->hasRole('super-admin'))
                <li class=" navigation-header"><span data-i18n="Forms &amp; Tables">Market area</span><i data-feather="more-horizontal"></i>
                </li>
                <li class=" nav-item @if(Route::currentRouteName() == 'company.products') active @endif"><a class="d-flex align-items-center" href="#"><i class="fa fa-shopping-cart"></i><span class="menu-title text-truncate" data-i18n="eCommerce">Product</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center @if(Route::currentRouteName() == 'company.products') active @endif" href="{{route('company.products')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop">List</span></a>
                        </li>
                    </ul>
                </li>
            @endif

            @if(Auth::user()->hasRole('super-admin'))
                <li class=" nav-item @if(Route::currentRouteName() == 'company.services') active @endif"><a class="d-flex align-items-center" href="#"><i class="fa fa-toolbox"></i><span class="menu-title text-truncate" data-i18n="eCommerce">Services</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center @if(Route::currentRouteName() == 'company.services') active @endif" href="{{route('company.services')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop">List</span></a>
                        </li>
                    </ul>
                </li>
            @endif

            @if(Auth::user()->hasRole('super-admin'))
                <li class=" nav-item @if(Route::currentRouteName() == 'admin.currencies') active @endif"><a class="d-flex align-items-center" href="#"><i class="fa fa-money-bill"></i><span class="menu-title text-truncate" data-i18n="eCommerce">Currencies</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center @if(Route::currentRouteName() == 'admin.currencies') active @endif" href="{{route('admin.currencies')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop">List</span></a>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
    </div>
</div>
