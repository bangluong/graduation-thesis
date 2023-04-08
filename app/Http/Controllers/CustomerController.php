<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class CustomerController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View
     */
    public function viewLogin()
    {
        return view('login');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View
     */
    public function login(\App\Http\Requests\StoreCustomerRequest  $request)
    {
        $customer = Customer::query()->where('email', '=', $request->get('email'))->first();
        if (!$customer || $request->get('pwd') != $customer->pwd) {
            return view('login')->with('message', 'Tài Khoản Hoặc Mật Khẩu Không Chính Xác');
        }
        $this->mergeCart($customer);
        session(['customer' => $customer]);
        session()->save();
        return redirect('/');
    }

    public function logout()
    {
        session()->forget('customer');
        return redirect('/login');
    }

    public function mergeCart($customer)
    {
        $currentCart = Cart::find(session()->get('cart_id'));
        $customerCart = Cart::query()->where('customer_id', '=', $customer->id)
            ->where('is_active', '=', 1)->first();
        if ($customerCart && $currentCart) {
            $currentCartItems = CartItem::query()->where('cart_id', '=', $currentCart->id)->get();
            $customerCartItems = CartItem::query()->where('cart_id', '=', $customerCart->id)->get();
            foreach ($currentCartItems as $currentCartItem) {
                $isAdded = false;
                foreach ($customerCartItems as $customerCartItem) {
                    if($currentCartItem->product_id == $customerCartItem->product_id) {
                        $isAdded = true;
                        CartItem::query()->where('id', $currentCartItem->id)->delete();
                    }
                }
                if (!$isAdded) {
                    $currentCartItem->cart_id = $customerCart->id;
                    $currentCartItem->save();
                }
            }
            $customerCart->item_qty = CartItem::query()->where('cart_id', '=', $cart->id)->count();
            $customerCart->item_count = CartItem::query()->where('cart_id', '=', $cart->id)->sum('qty');
            $customerCart->subtotal = CartItem::query()->where('cart_id', '=', $cart->id)->sum('row_total');
            $customerCart->update();
            session([
                'cart_id' => $customerCart->id,
                'cart_count' => $customerCart->item_count
            ]);
            session()->save();
        } elseif ($currentCart !=null ) {
            $currentCart->customer_id = $customer->id;
            $currentCart->save();
            session([
                'cart_id' => $currentCart->id,
                'cart_count' => $currentCart->item_count
            ]);
            session()->save();
        }

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View
     */
    public function register()
    {
        return view('register');
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
     * @param  \App\Http\Requests\StoreCustomerRequest  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreCustomerRequest $request)
    {
        $customer = Customer::create($request->all());
        session(['customer'=> $customer]);
        $this->mergeCart($customer);
        session()->save();
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCustomerRequest  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
