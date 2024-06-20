@extends('frontend.layouts.master')

@section('content')

    <!--============================
            SERVICE LISTING START
        ==============================-->
    <section id="wsus__daily_deals">
        <div class="container">
            <div class="wsus__offer_details_area">
                <div class="row">
                    @foreach($approvedServices as $service)
                        <div class="col-xl-3 col-sm-6 col-lg-4">
                            <div class="wsus__product_item">
                                <!-- Your service item content goes here -->
                                <a class="wsus__pro_link" href="{{ route('service-detail', ['slug' => $service->slug]) }}">
                                    <!-- Your service item image goes here -->
                                    <img src="{{ asset($service->thumb_image) }}" alt="service" class="img-fluid w-100 img_1" />
                                </a>
                                <!-- Other details like service name, price, etc. go here -->
                                <div class="wsus__product_details">
                                    <a class="wsus__pro_name" href="{{ route('service-detail', ['slug' => $service->slug]) }}">{{ $service->name }}</a>
                                    <p class="wsus__price">{{ $service->price }}</p>
                                    <!-- Add to cart or other actions go here -->
                                    <a class="add_cart" href="#">add to cart</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

@endsection
