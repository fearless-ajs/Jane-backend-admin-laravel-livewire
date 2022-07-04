<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto"><a class="navbar-brand" href="{{route('contact.dashboard')}}"><span class="brand-logo">
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
            <li class=" nav-item"><a class="d-flex align-items-center" href="{{route('contact.dashboard')}}"><i class="fa fa-home"></i><span class="menu-title text-truncate" >Dashboard</span></a>
            </li>
            <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Apps &amp; Pages</span><i data-feather="more-horizontal"></i>
            </li>

            <li class="nav-item @if(Route::currentRouteName() == 'contact.signed-invoices' || Route::currentRouteName() == 'contact.unsigned-invoices') active @endif"><a class="d-flex align-items-center" href="#"><i class="fa fa-file"></i><span class="menu-title text-truncate" data-i18n="Invoice">Invoices</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center @if(Route::currentRouteName() == 'contact.unsigned-invoices') active @endif" href="{{route('contact.unsigned-invoices')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Unsigned</span></a>
                    </li>
                    <li><a class="d-flex align-items-center @if(Route::currentRouteName() == 'contact.signed-invoices') active @endif" href="{{route('contact.signed-invoices')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Signed</span></a>
                    </li>
                </ul>
            </li>



            <li class=" navigation-header"><span data-i18n="Forms &amp; Tables">Market area</span><i data-feather="more-horizontal"></i>
            </li>
            <li class=" nav-item @if(Route::currentRouteName() == 'company.catalogues' || Route::currentRouteName() == 'contact.cart') active @endif"><a class="d-flex align-items-center" href="#"><i class="fa fa-shopping-cart"></i><span class="menu-title text-truncate" data-i18n="eCommerce">Market</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center @if(Route::currentRouteName() == 'contact.catalogues') active @endif" href="{{route('contact.catalogues')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop">Catalog</span></a>
                    </li>
                    <li><a class="d-flex align-items-center @if(Route::currentRouteName() == 'contact.cart') active @endif" href="{{route('contact.cart')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop">Cart</span></a>
                    </li>
                </ul>
            </li>
{{--            <li class=" nav-item @if(Route::currentRouteName() == 'company.products') active @endif"><a class="d-flex align-items-center" href="#"><i class="fa fa-money-bill"></i><span class="menu-title text-truncate" data-i18n="eCommerce">Orders</span></a>--}}
{{--                <ul class="menu-content">--}}
{{--                    <li><a class="d-flex align-items-center @if(Route::currentRouteName() == 'company.products') active @endif" href="{{route('company.products')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop">List</span></a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </li>--}}


            <li class=" navigation-header"><span data-i18n="Forms &amp; Tables">Billing</span><i data-feather="more-horizontal"></i>
            </li>
            <li class=" nav-item @if(Route::currentRouteName() == 'contact.payment-info') active @endif"><a class="d-flex align-items-center" href="#"><i class="fa fa-cash-register"></i><span class="menu-title text-truncate" data-i18n="eCommerce">Payment</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center @if(Route::currentRouteName() == 'contact.payment-info') active @endif" href="{{route('contact.payment-info')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop">Payment Info</span></a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
