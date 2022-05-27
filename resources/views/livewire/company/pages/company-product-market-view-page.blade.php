@extends('layouts.public.app')


@section('content')
    <div class="content-wrapper container-xxl p-0 just">
        <div class="content-header row">

            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Product Details</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
{{--                                <li class="breadcrumb-item"><a href="index.html">Home</a>--}}
{{--                                </li>--}}
{{--                                <li class="breadcrumb-item"><a href="#">eCommerce</a>--}}
{{--                                </li>--}}
{{--                                <li class="breadcrumb-item"><a href="app-ecommerce-shop.html">Shop</a>--}}
{{--                                </li>--}}
                                <li class="breadcrumb-item active">{{$product->name}}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        @livewire('company-product-market-view', ['product' => $product, 'missing' => $missing])


    </div>
@endsection
