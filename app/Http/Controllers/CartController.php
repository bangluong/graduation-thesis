<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Models\CartItem;
use App\Models\File;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\View;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|View
     */
    public function index()
    {
        $cart = Cart::find(session()->get('cart_id'));
        if (!$cart) {
            return view('cart')->with([
                'cart_items' => [],
                'cart'=> $cart
            ]);
        }
        $cartItems = CartItem::query()->where('cart_id', '=', $cart->id)->get();
        foreach ($cartItems as &$cartItem) {
            $product = Product::find($cartItem->product_id);
            $image = File::query()->where('entity_id', '=', $product->id)->first();
            if(isset($image->filename)) {
                $product->img = url('products/'.$image->filename);
            } else {
                $product->img = url('products/placeholder.png');
            }
            $cartItem->product = $product;
        }
        return view('cart')->with([
            'cart_items' => $cartItems,
            'cart'=> $cart
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|View
     */
    public function checkout()
    {
        $cart = Cart::find(session()->get('cart_id'));
        if (!$cart) {
            return view('checkout')->with([
                'cart_items' => [],
                'cart'=> $cart
            ]);
        }
        $cartItems = CartItem::query()->where('cart_id', '=', $cart->id)->get();
        foreach ($cartItems as &$cartItem) {
            $product = Product::find($cartItem->product_id);
            $image = File::query()->where('entity_id', '=', $product->id)->first();
            if(isset($image->filename)) {
                $product->img = url('products/'.$image->filename);
            } else {
                $product->img = url('products/placeholder.png');
            }
            $cartItem->product = $product;
        }
        return view('checkout')->with([
            'cart_items' => $cartItems,
            'cart'=> $cart
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCartRequest  $request
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(StoreCartRequest $request)
    {
        $session = session();
        $qty = $request->get('qty');
        $product = Product::find($request->get('product_id'));
        if($product->qty < $qty) {
            session()->flash('fe-error', 'sản phẩm này tạm hết');
            return redirect('/product/'.$product->sku);
        }
        try {
            if (!$session->get('cart_id')) {
                $cartData = [
                    'customer_id' => $session->get('customer') ? $session->get('customer')->id : null,
                    'is_active' => 1,
                    'item_qty' => $qty,
                    'item_count' => 1,
                    'subtotal' => $product->price * $qty
                ];
                $cart = Cart::create($cartData);
            } else {
                $cart = Cart::find($session->get('cart_id'));
            }
            $cartItemData = [
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'row_total' => $product->price * $qty,
                'price' => $product->price,
                'qty' => $qty
            ];
            $cartItem = CartItem::query()->where('product_id', '=', $product->id)
                ->where('cart_id', '=', $cart->id)->first();
            if ($cartItem) {
                $cartItemData['qty'] = $cartItem->qty + $qty;
                $cartItemData['row_total'] = $cartItemData['qty'] * $product->price;
                $cartItem->update($cartItemData);
                $message = 'Cập Nhật vào giỏ hàng thành công';
            } else {
                $cartItem = CartItem::create($cartItemData);
                $message = 'Thêm vào giỏ hàng thành công';
            }
            $updateCart = [
                'customer_id' => $session->get('customer') ? $session->get('customer')->id : null,
                'is_active' => 1,
                'item_qty' =>  CartItem::query()->where('cart_id', '=', $cart->id)->count(),
                'item_count' => CartItem::query()->where('cart_id', '=', $cart->id)->sum('qty'),
                'subtotal' => CartItem::query()->where('cart_id', '=', $cart->id)->sum('row_total')
            ];
            $cart->update($updateCart);
            session(
                [
                    'cart_id'=> $cart->id,
                    'cart_count' => $cart->item_count
                ]
            );
            session()->save();
            session()->flash('fe-success', 'Thêm vào giỏ hàng thành công');
            return redirect('/product/'.$product->sku);
        } catch (\Exception $exception) {
            session()->flash('fe-error', 'thêm sản phẩm vào giỏ hàng thất bại');
            return redirect('/product/'.$product->sku);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCartRequest  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCartRequest $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
