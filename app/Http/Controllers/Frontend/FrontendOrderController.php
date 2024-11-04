<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendOrderController extends Controller
{

    public function addCart($pId)
    {

        $product = Product::find($pId);

        if ($product->product_quantity > 0) {
            $myCart = session()->get('basket');

            //step 1: Cart Empty
            if (empty($myCart)) {
                //Action: add to cart
                $cart[$product->id] =
                    [
                        //key=> Value
                        'product_id' => $product->id,
                        'product_name' => $product->product_name,
                        'product_price' => $product->product_price,
                        'quantity' => 1,
                        'discount_price' => $product->discount_price,
                        'subtotal' => 1 * $product->product_price,
                        'image' => $product->product_image
                    ];
                session()->put('basket', $cart);
                //session()->forget('basket'); // Clear basket session for testing

                notify()->success("Product Added to Cart");
                return redirect()->back();
            } else {

                if (array_key_exists($pId, $myCart)) {
                    //step 2: Quantity Update, Subtotal Update

                    if ($product->product_quantity > $myCart[$pId]['quantity']) {
                        $myCart[$pId]['quantity'] = $myCart[$pId]['quantity'] + 1;
                        $myCart[$pId]['subtotal'] = $myCart[$pId]['quantity'] * $myCart[$pId]['product_price'];

                        session()->put('basket', $myCart);
                        notify()->success('Quantity Updated');
                        return redirect()->back();
                    } else {
                        notify()->error('Quantity Not Available');
                        return redirect()->back();
                    }
                } else {

                    //step 3: add to cart
                    $myCart[$product->id] =
                        [
                            'product_id' => $product->id,
                            'image' => $product->product_image,
                            'product_name' => $product->product_name,
                            'product_price' => $product->product_price,
                            'discount_price' => $product->discount_price,
                            'quantity' => 1,
                            'subtotal' => 1 * $product->product_price,
                        ];

                    session()->put('basket', $myCart);
                    notify()->success("product Added to Cart");
                    return redirect()->back();
                }
            }
        } else {
            notify()->error('Stock Not Available');
            return redirect()->back();
        }
    }

    //View Cart
    public function viewCart()
    {
        $myCart = session()->get('basket') ?? [];
        return view('frontend.pages.add-to-cart', compact('myCart'));
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

        if ($product->product_quantity >= $request->quantity) {
            $cart[$id]['quantity'] = $request->quantity;
            $cart[$id]['subtotal'] = $request->quantity * $cart[$id]['product_price'];

            session()->put('basket', $cart);
            notify()->success('Cart updated.');
            return redirect()->back();
        } else {
            notify()->error('stock not available');
            return redirect()->back();
        }
    }

}
