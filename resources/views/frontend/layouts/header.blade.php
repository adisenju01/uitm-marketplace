<header>
    <div class="container">
        <div class="row">
            <div class="col-2 col-md-1 d-lg-none">
                <div class="wsus__mobile_menu_area">
                    <span class="wsus__mobile_menu_icon"><i class="fal fa-bars"></i></span>
                </div>
            </div>
            <div class="col-xl-2 col-7 col-md-8 col-lg-2">
                <div class="wsus_logo_area">
                    <a class="wsus__header_logo" href="{{ route('home') }}">
                        <img src="{{asset('frontend/images/logo_uitm.png')}}" alt="logo" class="img-fluid w-100">
                    </a>
                </div>
            </div>
         
            <div class="col-xl-5 col-3 col-md-3 col-lg-6">
                <div class="wsus__call_icon_area">
                    <div class="wsus__call_area">
                        
                    </div>
                    <ul class="wsus__icon_area">
                        <li style="margin-left: 1000px; margin-top: 5px;"><a class="wsus__cart_icon" href="#"><i
                                    class="fal fa-shopping-bag"></i><span id="cart-count">{{ Cart::content()->count() }}</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="wsus__mini_cart">
        <h4>shopping cart <span class="wsus_close_mini_cart"><i class="far fa-times"></i></span></h4>
        <ul class="mini_cart_wrapper">
        

           @foreach(Cart::content() as $sidebarProduct)
                <li id="mini_cart_{{$sidebarProduct->rowId}}">
                    <div class="wsus__cart_img">
                        <a href="#"><img src="{{ asset($sidebarProduct->options->image) }}" alt="product" class="img-fluid w-100"></a>
                        <a class="wsis__del_icon remove_sidebar_product" data-id="{{$sidebarProduct->rowId}}" href="#" ><i class="fas fa-minus-circle"></i></a>
                    </div>
                    <div class="wsus__cart_text">
                        <a class="wsus__cart_title" href="{{ route('product-detail', $sidebarProduct->options->slug) }}">{{ $sidebarProduct->name }}</a>
                        <p>RM {{ $sidebarProduct->price }}</p>
                        <small>Qty: {{ $sidebarProduct->qty }}</small>
                    </div>
                </li>
           @endforeach
        
           @if (Cart::content()->count() === 0)
           <li class="text-center">Cart Is Empty!</li>
            @endif
            
           
        </ul>
        <div class="mini_cart_actions {{Cart::content()->count() === 0 ? 'd-none': ''}}">

            <h5>sub total <span id="mini_cart_subtotal">{{getCartTotal()}}</span></h5>
            <div class="wsus__minicart_btn_area">
                <a class="common_btn" href="{{ route('cart-details') }}">view cart</a>
                <a class="common_btn" href="{{ route('user.payment') }}">checkout</a>
            </div>

        </div>
      
    </div>

</header>
