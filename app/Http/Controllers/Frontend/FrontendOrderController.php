<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Devfaysal\BangladeshGeocode\Models\Division;
use Devfaysal\BangladeshGeocode\Models\District;
use Devfaysal\BangladeshGeocode\Models\Union;
use Devfaysal\BangladeshGeocode\Models\Upazila;


class FrontendOrderController extends Controller
{

    public function addCart(Request $request, $pId)
    {
        $product = Product::find($pId);

        if (!$product || $product->product_quantity <= 0) {
            notify()->error('Stock Not Available');
            return redirect()->back();
        }

        $myCart = session()->get('basket') ?? [];
        $requestedQuantity = $request->input('quantity', 1);

        // If product is already in the cart
        if (isset($myCart[$pId])) {
            notify()->error('Product is already in the cart. Please update the quantity there.');
            return redirect()->back();
        }

        // Add product to the cart
        if ($product->product_quantity >= $requestedQuantity) {
            $myCart[$pId] = [
                'product_id' => $product->id,
                'product_name' => $product->product_name,
                'quantity' => $requestedQuantity,
                'product_price' => $product->product_price,
                'subtotal' => $requestedQuantity * ($product->discount_price ?? $product->product_price),
                'discount' => $product->discount,
                'discount_price' => $product->discount_price,
                'total_amount' => $product->total_amount,
                'image' => $product->image,
            ];

            session()->put('basket', $myCart);
            notify()->success('Product added to the cart');
        } else {
            notify()->error('Requested quantity exceeds available stock');
        }

        return redirect()->back();
    }

    // View Cart
    public function viewCart()
    {
        $myCart = session()->get('basket') ?? [];


        foreach ($myCart as $productId => &$cartItem) {
            $product = Product::find($productId);
            // dd($product);
            //$cartItem['images'] = $product->images->pluck('image_url')->toArray();
        }

        if (empty($myCart)) {
            notify()->error("The cart is empty, add products to view the cart.");
            return redirect()->route('frontend.homepage');
        }

        //Bill Section
        $subtotal = 0;
        $discount = 0;
        $total = 0;
        foreach ($myCart as $productId => $cartData) {
            $product_id = $cartData['product_id'];
            $quantity = $cartData['quantity'];
            $originalPrice = $cartData['product_price'];
            $discountPrice = $cartData['discount_price'] ?? 0;

            // Calculate subtotal
            $subtotal += $originalPrice * $quantity;

            // Calculate discount
            if ($discountPrice > 0) {
                $discount += ($originalPrice - $discountPrice) * $quantity;
            }

            // Calculate total
            $total = $subtotal - $discount;
        }

        session()->put('cart_summary', [
            'subtotal' => $subtotal,
            'discount' => $discount,
            'total' => $total,
            'item_count' => count($myCart),
        ]);
        return view('frontend.pages.add-to-cart', compact('myCart', 'subtotal', 'discount', 'total'));
    }


    //Clear Cart
    public function clearCart()
    {
        session()->forget('basket');

        notify()->success("Cart Clear");
        return redirect()->back();
    }

    //Delete Cart Item
    public function cartItemDelete($product_id)
    {
        $cart = session()->get('basket');
        unset($cart[$product_id]);
        session()->put('basket', $cart);

        notify()->success('Item Remove.');
        return redirect()->back();
    }

    //Cart quantity Update
    public function updateCart(Request $request, $id)
    {
        $cart = session()->get('basket');
        $product = Product::find($id);

        // Ensure the quantity is at least 1
        $quantity = max(1, $request->quantity);

        if ($product->product_quantity >= $quantity) {
            $cart[$id]['quantity'] = $quantity;
            $cart[$id]['subtotal'] = $quantity * $cart[$id]['product_price'];

            session()->put('basket', $cart);
            notify()->success('Cart updated.');
        } else {
            notify()->error('Stock not available.');
        }

        return redirect()->back();
    }

    public function checkoutCart()
    {
        $divisions = Division::orderBy('name', 'asc')->get();
        $districts = District::orderBy('name', 'asc')->get()->groupBy('division_id');
        $upazilas = Upazila::all()->groupBy('district_id');
        $unions = Union::all()->groupBy('upazila_id');
        $cartSummary = session()->get('cart_summary');
        $myCart = session()->get('basket');

        return view('frontend.pages.checkout', compact('divisions', 'districts', 'upazilas', 'unions', 'cartSummary', 'myCart'));
    }

    public function placeOrder(Request $request)
    {
        $checkValidation = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'contact_number' => 'required',
            'country' => 'required',
            'division_id' => 'required',
            'district_id' => 'required',
            'upazila_id' => 'required',
            'union_id' => 'required',
            'address' => 'required',
        ]);
    
        if ($checkValidation->fails()) {
            notify()->error($checkValidation->getMessageBag());
            return redirect()->back();
        }
    
        // Store Order
        $order = Order::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'contact_number' => $request->contact_number,
            'country' => $request->country,
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'upazila_id' => $request->upazila_id,
            'union_id' => $request->union_id,
            'address' => $request->address,
            'amount' => $request->cart_total,
            'payment_method' => $request->payment_method,
        ]);
    
        // Retrieve cart data from session
        $cart = session()->get('basket', []);
    
        if (!empty($cart)) {
            foreach ($cart as $cartItem) {
                Order_detail::create([
                    'product_id' => $cartItem['product_id'] ?? null,
                    'order_id' => $order->id,
                    'product_name' => $cartItem['product_name'] ?? null,
                    'quantity' => $cartItem['quantity'] ?? 1,
                    'product_price' => $cartItem['product_price'] ?? 0,
                    'subtotal' => $cartItem['subtotal'] ?? 0,
                    'discount' => $cartItem['discount'] ?? 0,
                    'discount_price' => $cartItem['discount_price'] ?? 0,
                    'image' => $cartItem['image'] ?? null,
                ]);
            }
        }
    
        // Clear cart data from session
        session()->forget('basket');
        session()->forget('cart_summary');
    
        notify()->success('Order placed successfully!');
        return redirect()->route('frontend.homepage');
    }
    
}
