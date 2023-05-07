<?php

namespace App\Http\Controllers;

use App\Models\Acl;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Orders;
use App\Models\Product;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();
        $total = count($customers);
        $p = request()->get('p') ?: 1;
        $limit = 10;
        $start = ($p-1)*$limit;
        $end = $start+$limit;
        if ($total <= $limit) {
            $end = $start + $total;
        }
        if (($total-$start) < $limit) {
            $end = $total;
        }
        $prds = [];
        for ($i = $start; $i<$end; $i++) {
            $prds[] = $customers[$i];
        }
        $pageNum = ceil($total/$limit);
        $pages = [];
        $path = request()->path();
        if($p != 1) {
            $url = url($path . ('?p=' . ($p - 1)));
            $pages[] = [
                'label' => 'Previous',
                'url' => $url,
                'class' => ''
            ];
        }
        for ($i = 1; $i<=$pageNum; $i++) {
            $url = url($path . ('?p=' . $i));
            if ($p == $i) {
                $pages[] = [
                    'label' => $i,
                    'url' => $url,
                    'class' => 'active'
                ];
            } else {
                $pages[] = [
                    'label' => $i,
                    'url' => $url,
                    'class' => ''
                ];
            }
        }
        if ($p!=$pageNum) {
            $url = url($path . ('?p=' . ($p + 1)));
            $pages[] = [
                'label' => 'next',
                'url' => $url,
                'class' => ''
            ];
        }
        return view('admin.customer.index')->with(
            [
                'customers' => $prds,
                'pages' => $pages
            ]
        );
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
            $customerCart->item_count = CartItem::query()->where('cart_id', '=', $customerCart->id)->sum('qty');
            $customerCart->subtotal = CartItem::query()->where('cart_id', '=', $customerCart->id)->sum('row_total');
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
        try {
            $customer = Customer::create($request->all());
            session(['customer'=> $customer]);
            $this->mergeCart($customer);
            session()->save();
            return redirect('/');
        } catch (\Exception $e) {
            dd($e);
            session()->flash('fe-error', 'Không thể lưu dữ liệu. vui lòng kiểm tra dữ liệu đầu vào');
            return redirect('/register');
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|\Illuminate\Http\Response
     */
    public function show()
    {
        $customer = session()->get('customer');
        if ($customer == null) {
            return redirect('login');
        } else {
            return view('my-account')->with('customer', $customer);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::find($id);
        $orders = Orders::query()->where('customer_id', '=', $id)->get();
        return view('admin.customer.edit')->with([
            'customer' => $customer,
            'orders' => $orders,
            'status_mapper' =>[
                0 => 'chờ tiếp nhận',
                1 => 'đang xử lý',
                2 => 'đang giao',
                3 => 'hoàn thành',
                4 => 'đã hủy'
            ]
        ]);
    }

    public function listOrders()
    {
        $customer = session()->get('customer');
        $orders = Orders::query()->where('customer_id', '=', $customer->id);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCustomerRequest  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UpdateCustomerRequest $request)
    {
        $customer = Customer::find(session()->get('customer')->id);
        $customer->update($request->all());
        session(['customer' => $customer]);
        session()->save();
        session()->flash('fe-success', 'Cập nhật dữ liệu thành công');
        return redirect('/my-account');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCustomerRequest  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function adminUpdate(UpdateCustomerRequest $request)
    {
        $customer = Customer::find(session()->get('customer')->id);
        $customer->update($request->all());
        session(['customer' => $customer]);
        session()->save();
        session()->flash('fe-success', 'Cập nhật dữ liệu thành công');
        return redirect('admin/customer');
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
