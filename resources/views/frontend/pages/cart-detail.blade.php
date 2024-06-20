@extends('frontend.layouts.master')

@section('content')

    <!--============================
        BREADCRUMB START
    ==============================-->
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>cart View</h4>
                        <ul>
                            <li><a href="#">home</a></li>
                            <li><a href="#">peoduct</a></li>
                            <li><a href="#">cart view</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        BREADCRUMB END
    ==============================-->


    <!--============================
        CART VIEW PAGE START
    ==============================-->
    <section id="wsus__cart_view">
        <div class="container">
            <div class="row">
                <div class="col-xl-9">
                    <div class="wsus__cart_list">
                        <div class="table-responsive">
                            <table>
                                <tbody>
                                    <tr class="d-flex">
                                        <th class="wsus__pro_img">
                                            product item
                                        </th>

                                        <th class="wsus__pro_name">
                                            product details
                                        </th>


                                        <th class="wsus__pro_tk">
                                            unit price
                                        </th>

                                        <th class="wsus__pro_tk">
                                            total
                                        </th>

                                        <th class="wsus__pro_select">
                                            quantity
                                        </th>


                                        <th class="wsus__pro_icon">
                                            <a href="#" class="common_btn clear_cart">clear cart</a>
                                        </th>
                                    </tr>
                                    @foreach( $cartItems as $item)
                                    <tr class="d-flex">
                                        <td class="wsus__pro_img"><img src="{{ asset($item->options->image) }}" alt="product"
                                                class="img-fluid w-100">
                                        </td>

                                        <td class="wsus__pro_name">
                                            <p>{{ $item->name}}</p>
                                        </td>

                                        <td class="wsus__pro_tk">
                                            <h6>RM {{ $item->price }}</h6>
                                        </td>

                                        <td class="wsus__pro_tk">
                                            <h6 id="{{ $item->rowId }}">{{ $item->price + $item->options->item_total }}</h6>
                                        </td>

                                        <td class="wsus__pro_select">
                                            <div class="product_qty_wrapper">
                                                    <button class="btn btn-danger product-decrement">-</button>
                                                    <input class="product-qty" data-rowid="{{ $item->rowId }}" type="text" min="1" max="100" value="{{ $item->qty }}" readonly />
                                                    <button class="btn btn-success product-increment">+</button>
                                            </div>
                                        </td>

                                        <td class="wsus__pro_icon">
                                            <a href="{{ route('cart.remove-product', $item->rowId) }}"><i class="far fa-times"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="wsus__cart_list_footer_button" id="sticky_sidebar">
                        <h6>total cart</h6>
                        {{-- <p>Total: <span id="sub_total">RM {{getCartTotal()}}</span></p> --}}
                    
                        <p class="total"><span>total:</span> <span id="sub_total">RM {{getCartTotal()}}</span></p>

                       
                      <a class="common_btn mt-4 w-100 text-center" href="{{ route('user.payment') }}">checkout</a>

                    
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!--============================
          CART VIEW PAGE END
    ==============================-->


@endsection

@push('scripts')

<script>
    $(document).ready(function(){
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        // increment product quantity
        $('.product-increment').on('click', function(){
            let input = $(this).siblings('.product-qty');
            let quantity = parseInt(input.val()) + 1;
            let rowId = input.data('rowid');
            input.val(quantity);
            
            $.ajax({
                url: "{{ route('cart.update-quantity') }}",
                method: 'POST',
                data: {
                    rowId: rowId,
                    quantity: quantity
                },
                success: function(data){
                    if(data.status === 'success'){
                        let productId = '#'+rowId; 
                        
                        $(productId).text(data.product_total)
                        renderCartSubTotal()
                        toastr.success(data.message)
                    }else if (data.status === 'error'){
                        toastr.error(data.message)
                    }
                },
                error: function(data){
                    
                }
            })

        })


        // decrement product quantity
        $('.product-decrement').on('click', function(){
            let input = $(this).siblings('.product-qty');
            let quantity = parseInt(input.val()) - 1;
            let rowId = input.data('rowid');

            if(quantity < 1){
                quantity = 1;
            }

            input.val(quantity);
            
            $.ajax({
                url: "{{ route('cart.update-quantity') }}",
                method: 'POST',
                data: {
                    rowId: rowId,
                    quantity: quantity
                },
                success: function(data){
                    if(data.status === 'success'){
                        let productId = '#'+rowId; 
                        $(productId).text(data.product_total)
                        renderCartSubTotal()
                        toastr.success(data.message)
                    }else if (data.status === 'error'){
                        toastr.error(data.message)
                    }
                },
                error: function(data){

                }
            })

        })

        
        //clear cart
        $('.clear_cart').on('click', function(e){
            e.preventDefault();
            Swal.fire({
                    title: 'Are you sure?',
                    text: "This action will clear your cart!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, clear it!'
                    }).then((result) => {
                    if (result.isConfirmed) {

                        $.ajax({
                            type: 'get',
                            url: "{{ route('clear.cart') }}",
                            success: function(data){
                                if(data.status === 'success'){
                                    window.location.reload();
                                }
                               
                            },
                            error: function(xhr, status, error){
                                console.log(error);
                            }
                        })
                    }
                })
        })

         // get subtotal of cart and put it on dom
         function renderCartSubTotal(){
            $.ajax({
                method: 'GET',
                url: "{{ route('cart.sidebar-product-total') }}",
                success: function(data) {
                    $('#sub_total').text("RM"+data);
                },
                error: function(data) {
                    console.log(data);
                }
            })
        }


    })

</script>

@endpush