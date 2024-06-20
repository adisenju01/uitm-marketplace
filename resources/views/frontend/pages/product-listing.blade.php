@extends('frontend.layouts.master')

@section('content')


    <!--============================
            PRODUCT DETAILS START
        ==============================-->
        <section id="wsus__daily_deals">
            <div class="container">
                <div class="wsus__offer_details_area">
                    <div class="row">
                        @foreach($approvedProducts as $product)
                            <div class="col-xl-3 col-sm-6 col-lg-4">
                                <div class="wsus__product_item">
                                    <!-- Your service item content goes here -->
                                    <a class="wsus__pro_link" href="{{ route('product-detail', ['slug' => $product->slug]) }}">
                                        <!-- Your service item image goes here -->
                                        <img src="{{ asset($product->thumb_image) }}" alt="service" class="img-fluid w-100 img_1" />
                                    </a>
                                    <!-- Other details like service name, price, etc. go here -->
                                    <div class="wsus__product_details">
                                        <a class="wsus__pro_name" href="{{ route('product-detail', ['slug' => $product->slug]) }}">{{ $product->name }}</a>
                                        <p class="wsus__price">{{ $settings->currency_icon }}{{ $product->price }}</p>
                                        <!-- Add to cart or other actions go here -->
                                        <form class="shopping-cart-form">
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <a class="add_cart" href="{{ route('product-detail', ['slug' => $product->slug]) }}">detail</a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>



@endsection
 
