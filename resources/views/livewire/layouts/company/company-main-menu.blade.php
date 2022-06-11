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


            @if(Auth::user()->hasModuleAccess('invoice', 'read') || Auth::user()->hasModuleAccess('invoice', 'create'))
                <li class="nav-item @if(Route::currentRouteName() == 'company.invoices' || Route::currentRouteName() == 'company.create-invoice') active @endif"><a class="d-flex align-items-center" href="#"><i data-feather="file-text"></i><span class="menu-title text-truncate" data-i18n="Invoice">Invoices</span></a>
                    <ul class="menu-content">
                        @if(Auth::user()->hasModuleAccess('invoice', 'read'))
                            <li><a class="d-flex align-items-center @if(Route::currentRouteName() == 'company.invoices') active @endif" href="{{route('company.invoices')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">List</span></a>
                            </li>
                        @endif
                        @if(Auth::user()->hasModuleAccess('invoice', 'create'))
                            <li><a class="d-flex align-items-center @if(Route::currentRouteName() == 'company.create-invoice') active @endif" href="{{route('company.create-invoice')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Add">Add</span></a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

                @if(Auth::user()->hasModuleAccess('contact', 'read') || Auth::user()->hasModuleAccess('contact', 'edit'))
                    <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="user"></i><span class="menu-title text-truncate" data-i18n="User">Contacts</span></a>
                        <ul class="menu-content">
                            <li><a class="d-flex align-items-center" href="{{route('company.contacts')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">List</span></a>
                            </li>
                        </ul>
                    </li>
                @endif

            <li class=" navigation-header"><span data-i18n="Forms &amp; Tables">Market area</span><i data-feather="more-horizontal"></i>
            </li>

            @if(Auth::user()->hasModuleAccess('product', 'read'))
                <li class=" nav-item @if(Route::currentRouteName() == 'company.catalogues') active @endif"><a class="d-flex align-items-center" href="#"><i data-feather="shopping-cart"></i><span class="menu-title text-truncate" data-i18n="eCommerce">Catalogue</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center @if(Route::currentRouteName() == 'company.catalogues') active @endif" href="{{route('company.catalogues')}}"><i class="fa fa-cart-plus"></i><span class="menu-item text-truncate" data-i18n="Shop">List</span></a>
                        </li>
                    </ul>
                </li>
            @endif

            @if(Auth::user()->hasModuleAccess('category', 'read'))
                <li class=" nav-item @if(Route::currentRouteName() == 'company.categories') active @endif"><a class="d-flex align-items-center" href="#"><i class="fa fa-file-archive"></i><span class="menu-title text-truncate" data-i18n="eCommerce">Categories</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center @if(Route::currentRouteName() == 'company.categories') active @endif" href="{{route('company.categories')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop">List</span></a>
                        </li>
                    </ul>
                </li>
            @endif
            @if(Auth::user()->hasModuleAccess('category', 'read'))
                <li class=" nav-item @if(Route::currentRouteName() == 'company.billing-cycles') active @endif"><a class="d-flex align-items-center" href="#"><i class="fa fa-money-bill-wave"></i><span class="menu-title text-truncate" data-i18n="eCommerce">Billing</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center @if(Route::currentRouteName() == 'company.billing-cycles') active @endif" href="{{route('company.billing-cycles')}}"><i class="fa fa-money-bill"></i><span class="menu-item text-truncate" data-i18n="Shop">Billing cycles</span></a>
                        </li>
                    </ul>
                </li>
            @endif


            @if(Auth::user()->hasModuleAccess('role', 'read'))
                <li class=" navigation-header"><span data-i18n="Forms &amp; Tables">Roles and access control</span><i data-feather="more-horizontal"></i>
                </li>
                <li class=" nav-item @if(Route::currentRouteName() == 'company.workers') active @endif"><a class="d-flex align-items-center" href="#"><i data-feather="user"></i><span class="menu-title text-truncate" data-i18n="User">Users</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center @if(Route::currentRouteName() == 'company.workers') active @endif" href="{{route('company.workers')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">List</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item  @if(Route::currentRouteName() == 'company.permissions' || Route::currentRouteName() == 'company.roles' || Route::currentRouteName() == 'company.teams') active @endif "><a class="d-flex align-items-center" href="#"><i data-feather="shield"></i><span class="menu-title text-truncate" data-i18n="Roles &amp; Permission">Roles &amp; Permission</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center @if(Route::currentRouteName() == 'company.roles') active @endif" href="{{route('company.roles')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Roles">Roles</span></a>
                        </li>
                        <li><a class="d-flex align-items-center @if(Route::currentRouteName() == 'company.permissions') active @endif" href="{{route('company.permissions')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Permission">Permission</span></a>
                        </li>
                    </ul>
                </li>
            @endif

        </ul>
    </div>
</div>
