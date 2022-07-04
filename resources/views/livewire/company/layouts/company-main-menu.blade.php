<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto"><a class="navbar-brand" href="{{route('company.dashboard')}}"><span class="brand-logo">
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
            <li class=" nav-item @if(Route::currentRouteName() == 'company.dashboard') active @endif"><a class="d-flex align-items-center" href="{{route('company.dashboard')}}"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Dashboard</span></a>
            </li>
            <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Apps &amp; Pages</span><i data-feather="more-horizontal"></i>
            </li>


            @if(Auth::user()->hasModuleAccess('invoice', 'read') || Auth::user()->hasModuleAccess('invoice', 'create') || Auth::user()->hasModuleAccess('invoice', 'edit'))
                <li class="nav-item @if(Route::currentRouteName() == 'company.invoices' || Route::currentRouteName() == 'company.create-invoice') active @endif"><a class="d-flex align-items-center" href="{{route('company.invoices')}}"><i data-feather="file-text"></i><span class="menu-title text-truncate" data-i18n="Invoice">Invoices</span></a>
                </li>
            @endif

                @if(Auth::user()->hasModuleAccess('contact', 'read') || Auth::user()->hasModuleAccess('contact', 'edit') || Auth::user()->hasModuleAccess('contact', 'create'))
                    <li class=" nav-item"><a class="d-flex align-items-center" href="{{route('company.contacts')}}"><i data-feather="user"></i><span class="menu-title text-truncate" data-i18n="User">Contacts</span></a>
                    </li>
                @endif

            <li class=" navigation-header"><span data-i18n="Forms &amp; Tables">Market area</span><i data-feather="more-horizontal"></i>
            </li>

            @if(Auth::user()->hasModuleAccess('catalogue', 'read') || Auth::user()->hasModuleAccess('catalogue', 'edit') || Auth::user()->hasModuleAccess('catalogue', 'edit'))
                <li class=" nav-item @if(Route::currentRouteName() == 'company.catalogues') active @endif"><a class="d-flex align-items-center" href="{{route('company.catalogues')}}"><i data-feather="shopping-cart"></i><span class="menu-title text-truncate" data-i18n="eCommerce">Catalog</span></a>
                </li>
            @endif

            @if(Auth::user()->hasModuleAccess('category', 'read') || Auth::user()->hasModuleAccess('category', 'edit') || Auth::user()->hasModuleAccess('category', 'create'))
                <li class=" nav-item @if(Route::currentRouteName() == 'company.categories') active @endif"><a class="d-flex align-items-center" href="{{route('company.categories')}}"><i class="fa fa-file-archive"></i><span class="menu-title text-truncate" data-i18n="eCommerce">Categories</span></a>
                </li>
            @endif


            @if(Auth::user()->hasModuleAccess('tax', 'read') || Auth::user()->hasModuleAccess('tax', 'edit') || Auth::user()->hasModuleAccess('tax', 'create'))
                <li class=" nav-item @if(Route::currentRouteName() == 'company.categories') active @endif"><a class="d-flex align-items-center" href="{{route('company.taxes')}}"><i class="fa fa-file-archive"></i><span class="menu-title text-truncate" data-i18n="eCommerce">Taxes</span></a>
                </li>
            @endif


        @if(Auth::user()->hasModuleAccess('billing-cycle', 'read') || Auth::user()->hasModuleAccess('billing-cycle', 'edit') || Auth::user()->hasModuleAccess('billing-cycle', 'create'))
                <li class=" nav-item @if(Route::currentRouteName() == 'company.billing-cycles') active @endif"><a class="d-flex align-items-center" href="{{route('company.billing-cycles')}}"><i class="fa fa-money-bill-wave"></i><span class="menu-title text-truncate" data-i18n="eCommerce">Billing cycles</span></a>
                </li>
        @endif


            <li class=" navigation-header"><span data-i18n="Forms &amp; Tables">Management</span><i data-feather="more-horizontal"></i>
            </li>
            @if(Auth::user()->hasModuleAccess('role', 'read') || Auth::user()->hasModuleAccess('role', 'edit') || Auth::user()->hasModuleAccess('role', 'create'))
                <li class=" nav-item @if(Route::currentRouteName() == 'company.workers') active @endif"><a class="d-flex align-items-center" href="{{route('company.workers')}}"><i data-feather="user"></i><span class="menu-title text-truncate" data-i18n="User">Staff</span></a>
                </li>
            @endif


            @if(Auth::user()->hasModuleAccess('role', 'read') || Auth::user()->hasModuleAccess('role', 'edit') || Auth::user()->hasModuleAccess('role', 'create'))
                <li class=" navigation-header"><span data-i18n="Forms &amp; Tables">Roles and access control</span><i data-feather="more-horizontal"></i>
                </li>
                <li class=" nav-item  @if(Route::currentRouteName() == 'company.permissions') active @endif "><a class="d-flex align-items-center" href="{{route('company.permissions')}}"><i data-feather="shield"></i><span class="menu-title text-truncate">Permissions</span></a>
                </li>
            @endif

            @if(Auth::user()->hasModuleAccess('role', 'read') || Auth::user()->hasModuleAccess('role', 'edit') || Auth::user()->hasModuleAccess('role', 'create'))
                <li class=" nav-item  @if(Route::currentRouteName() == 'company.roles') active @endif "><a class="d-flex align-items-center" href="{{route('company.roles')}}"><i data-feather="shield"></i><span class="menu-title text-truncate" data-i18n="Roles &amp; Permission">Roles</span></a>
                </li>
            @endif

        </ul>
    </div>
</div>
