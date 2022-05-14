<!DOCTYPE html>
<html class="loading dark-layout" lang="en" data-layout="dark-layout" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>{{$data['title']}}</title>
    <link rel="apple-touch-icon" href="{{asset('app-assets/images/ico/apple-icon-120.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('app-assets/images/ico/favicon.ico')}}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/charts/apexcharts.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/extensions/toastr.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/forms/select/select2.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/components.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/themes/dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/themes/bordered-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/themes/semi-dark-layout.css')}}">


    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/forms/form-validation.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/authentication.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/extensions/ext-component-toastr.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/page-profile.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/forms/pickers/form-flat-pickr.css')}}">

    @if(Route::currentRouteName() == 'company.print-invoice')
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/app-invoice-print.css')}}">
    @endif

<link rel="stylesheet" href="{{asset('app-assets/css/toastr.css')}}">
<!-- END: Page CSS-->

<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/extensions/nouislider.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/vendors.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/extensions/ext-component-sliders.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/app-ecommerce.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/forms/form-number-input.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/app-ecommerce-details.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/app-invoice-list.css')}}">

<!-- BEGIN: Custom CSS-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
<!-- END: Custom CSS-->

@livewireStyles
</head>
<!-- END: Head-->


<!-- BEGIN: Body-->
<body class="vertical-layout vertical-menu-modern  footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">
{{--<x-company-app-header />--}}

{{--<x-company-main-menu />--}}

<!-- BEGIN: Content-->
<div class="app-content content">
    @yield('content')
</div>



<!-- BEGIN: Footer-->
<footer class="footer footer-static footer-light">
<p class="clearfix mb-0"><span class="float-md-start d-block d-md-inline-block mt-25">COPYRIGHT &copy; {{ now()->year }}<a class="ms-25" href="https://1.envato.market/pixinvent_portfolio" target="_blank">Binutu</a><span class="d-none d-sm-inline-block">, All rights Reserved</span></span><span class="float-md-end d-none d-md-block">Hand-crafted & Made with<i data-feather="heart"></i></span></p>
</footer>
<button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>


<!-- END: Content-->


@livewireScripts

<!-- BEGIN: Vendor JS-->
<script src="{{asset('app-assets/vendors/js/vendors.min.js')}}"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{asset('app-assets/vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
<!-- END: Page Vendor JS-->
<script src="{{asset('app-assets/vendors/js/extensions/wNumb.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/extensions/nouislider.min.js')}}"></script>
<script  src="{{asset('app-assets/js/toastr.js')}}"></script>

<!-- BEGIN: Theme JS-->
<script src="{{asset('app-assets/js/core/app-menu.js')}}"></script>
<script src="{{asset('app-assets/js/core/app.js')}}"></script>
<script src="{{asset('app-assets/js/scripts/pages/app-ecommerce-details.js')}}"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="{{asset('app-assets/js/scripts/pages/auth-login.js')}}"></script>
<!-- END: Page JS-->

@if(Route::currentRouteName() == 'company.print-invoice')
    <script src="{{asset('app-assets/js/scripts/pages/app-invoice-print.js')}}"></script>
@endif

<!-- BEGIN: Page JS-->
<script src="{{asset('app-assets/js/scripts/pages/app-ecommerce.js')}}"></script>
<!-- END: Page JS-->

<script src="{{asset('app-assets/js/scripts/pages/app-invoice.js')}}"></script>

<script>
window.livewire.on('alert', param => {
    toastr[param['type']](param['message'], param['type']);
});
</script>


<script>
$(window).on('load', function() {
    if (feather) {
        feather.replace({
            width: 14,
            height: 14
        });
    }
})
</script>

<script  src="{{asset('app-assets/js/sweetalert.js')}}"></script>
<script>
window.addEventListener('swal:modal', event => {
    swal({
        title: event.detail.title,
        text: event.detail.text,
        icon: event.detail.type
    });
});

window.addEventListener('swal:confirm', event => {
    swal({
        title: event.detail.title,
        text: event.detail.text,
        icon: event.detail.type,
        buttons: true,
        dangerMode: true
    }).then((willDelete) => {

        if(willDelete){
            window.livewire.emit('delete', event.detail.id);
        }
    });
});
</script>

<script>
    window.livewire.on('close-current-modal', param => {
        $('.current-modal').modal('hide');
    });
</script>

</body>
<!-- END: Body-->

</html>
