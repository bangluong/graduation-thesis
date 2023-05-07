<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Http\Requests\StoreCartItemRequest;
use App\Http\Requests\UpdateCartItemRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Routing\Redirector;

class CartItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreCartItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCartItemRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CartItem  $cartItem
     * @return \Illuminate\Http\Response
     */
    public function show(CartItem $cartItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CartItem  $cartItem
     * @return \Illuminate\Http\Response
     */
    public function edit(CartItem $cartItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  $id
     * @param $type
     * @return Application|\Illuminate\Http\RedirectResponse|Redirector
     */
    public function update($id, $type)
    {
        $cartItem = CartItem::find($id);
        if ($type == 'minus') {
            $cartItem->qty = $cartItem->qty - 1;
            $cartItem->row_total = $cartItem->qty * $cartItem->price;
            $cartItem->update();
        } else {
            $cartItem->qty = $cartItem->qty + 1;
            $cartItem->row_total = $cartItem->qty * $cartItem->price;
            $cartItem->update();
        }
        $cart = Cart::find(session()->get('cart_id'));
        $cart->item_qty = CartItem::query()->where('cart_id', '=', $cart->id)->count();
        $cart->item_count = CartItem::query()->where('cart_id', '=', $cart->id)->sum('qty');
        $cart->subtotal = CartItem::query()->where('cart_id', '=', $cart->id)->sum('row_total');
        $cart->update();
        session(
            [
                'cart_id'=> $cart->id,
                'cart_count' => $cart->item_count
            ]
        );
        session()->save();
        session()->flash('fe-success', 'cập nhật giỏ hàng thành công');
        return redirect('checkout/cart');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|Redirector
     */
    public function destroy($id)
    {
        $cartItem = CartItem::query()->where('id', '=', $id)->delete();
        $cart = Cart::find(session()->get('cart_id'));
        $cart->item_qty = CartItem::query()->where('cart_id', '=', $cart->id)->count();
        $cart->item_count = CartItem::query()->where('cart_id', '=', $cart->id)->sum('qty');
        $cart->subtotal = CartItem::query()->where('cart_id', '=', $cart->id)->sum('row_total');
        $cart->update();
        session(
            [
                'cart_id'=> $cart->id,
                'cart_count' => $cart->item_count
            ]
        );
        session()->save();
        session()->flash('fe-success', 'cập nhật giỏ hàng thành công');
        return redirect('checkout/cart');
    }
}
