<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;  //use this for add to cart(very important!!)

class CartController extends Controller
{
    /** Add item to cart */
    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        //check product quantity
        if($product->qty === 0){
            return response(['status' => 'error', 'message' => 'Product stock out']);
        }elseif($product->qty < $request->qty){
            return response(['status' => 'error', 'message' => 'Quantity not available in our stock']);
        }

        $cartData = [];
        $cartData['id'] = $product->id;
        $cartData['name'] = $product->name;
        $cartData['qty'] = $request->qty;
        $cartData['price'] = $product->price;
        $cartData['weight'] = 10;
        $cartData['options']['image'] = $product->thumb_image;
        $cartData['options']['slug'] = $product->slug;
        
        Cart::add($cartData);
        
        return response(['status' => 'success', 'message' => 'Added to cart successfully!']);
    }

       /** Show cart page  */
       public function cartDetails()
       {
           $cartItems = Cart::content();
   
           if(count($cartItems) === 0){
               Session::forget('coupon');
               toastr('Please add some products in your cart for view the cart page', 'warning', 'Cart is empty!');
               return redirect()->route('home');
           }
   
          
   
           return view('frontend.pages.cart-detail', compact('cartItems'));
       }

       /** Update product quantity */
       public function updateProductQty(Request $request)
       {
            $productId = Cart::get($request->rowId)->id;
            $product = Product::findOrFail($productId);

            // check product quantity
            if($product->qty === 0){
                return response(['status' => 'error', 'message' => 'Product stock out']);
            }elseif($product->qty < $request->qty){
                return response(['status' => 'error', 'message' => 'Quantity not available in our stock']);
            }

            Cart::update($request->rowId, $request->quantity);
            $productTotal = $this->getProductTotal($request->rowId);
            return response(['status' => 'success', 'message' => 'Product Quantity Updated!', 'product_total' => $productTotal]);

       }

       /** get product total */
       public function getProductTotal($rowId)
       {
            $product = Cart::get($rowId);
            $total = $product->price * $product->qty;
            return $total;
       }

        /** get cart total amount */
        public function cartTotal()
        {
            $total = 0;
            foreach(Cart::content() as $product){
                $total += $this->getProductTotal($product->rowId);
            }

            return $total;
        }

       /** Clear all cart products */
       public function clearCart()
       {
            Cart::destroy();

            return response(['status' => 'success', 'message' => 'Cart cleared successfully']);
       }

       /** Remove product from cart */
       public function removeProduct($rowId)
       {
            Cart::remove($rowId);
            toastr('Product removed succesfully!', 'success', 'Success');
            return redirect()->back();
       }

       /** Get cart count */
       public function getCartCount()
       {
            return Cart::content()->count();
       }

         /** Get all cart products */
        public function getCartProducts()
        {
            return Cart::content();
        }

         /** Romve product form sidebar cart */
        public function removeSidebarProduct(Request $request)
        {
            Cart::remove($request->rowId);

            return response(['status' => 'success', 'message' => 'Product removed successfully!']);
        }

}
