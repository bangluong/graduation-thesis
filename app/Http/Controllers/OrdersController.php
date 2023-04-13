<?php

namespace App\Http\Controllers;

use App\Models\Acl;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\OrderItems;
use App\Models\Orders;
use App\Http\Requests\StoreOrdersRequest;
use App\Http\Requests\UpdateOrdersRequest;
use App\Models\Product;
use App\Models\ShippingAdress;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    public function customerOrder()
    {
        $customer = session()->get('customer');
        $orders = Orders::query()->where('customer_id', '=', $customer->id)->get();
        return view('orders')->with([
            'orders' => $orders,
            'status_mapper' => [
                0 => 'chờ tiếp nhận',
                1 => 'đang xử lý',
                2 => 'đang giao',
                3 => 'hoàn thành',
                4 => 'đã hủy'
            ]
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $acl = Acl::find(Auth::user()->acl);
        $resource = $acl->resource;
        if ($resource!=0) {
            $resource = explode(',', $resource);
        } else {
            $resource = [$resource];
        }
        if(!in_array('orders', $resource) && !in_array(0, $resource) ) {
            return redirect('admin/dashboard');
        }
        $orders = Orders::all();
        return view('admin.order.index')->with(
            [
                'orders' => $orders,
                'status_mapper' =>[
                    0 => 'chờ tiếp nhận',
                    1 => 'đang xử lý',
                    2 => 'đang giao',
                    3 => 'hoàn thành',
                    4 => 'đã hủy'
                ]
            ]
        );
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
     * @param \App\Http\Requests\StoreOrdersRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function store(StoreOrdersRequest $request)
    {
        $addr = ShippingAdress::create($request->get('address'));
        $cart = Cart::find(session()->get('cart_id'));
        $orderData = [
            'customer_id' => $cart->customer_id,
            'item_qty' => $cart->item_qty,
            'item_count' => $cart->item_count,
            'subtotal' => $cart->subtotal,
            'status' => 0,
            'shipping_address_id' => $addr->id,
            'payment_method' => $request->get('payment')
        ];
        $order = Orders::create($orderData);
        $cart->is_active = 0;
        $cart->save();
        session()->forget('cart_id');
        session()->forget('cart_count');
        $cartItems = CartItem::query()->where('cart_id', '=', $cart->id)->get();
        foreach ($cartItems as $cartItem) {
            $orderItem = [
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'row_total' => $cartItem->row_total,
                'price' => $cartItem->price,
                'qty' => $cartItem->qty
            ];
            OrderItems::create($orderItem);
            $product = Product::find($cartItem->product_id);
            $product->qty = $product->qty - $cartItem->qty;
            $product->save();
        }
        if ($order->payment_method == 'vnpay') {
            $this->vnpay($order);
        }
        return view('success')->with([
            'order' => $order
        ]);
    }
    public function update(StoreOrdersRequest $request)
    {
        $order = Orders::find($request->get('id'));
        $order->status = $request->get('status');
        $order->save();
        return redirect('admin/orders/'.$order->id);
    }
    public function cancel($id)
    {
        $order = Orders::find($id);
        $order->status = 4;
        $order->save();
        return redirect('admin/orders/'.$order->id);
    }

    public function vnpay($order)
    {
        error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = url('success');
        $vnp_TmnCode = "6EY1DU1G";//Mã website tại VNPAY
        $vnp_HashSecret = "OHBFXFVPLCPCETVMBMZQKJVDNMICLRRR"; //Chuỗi bí mật

        $vnp_TxnRef = $order->id; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'order test';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $order->subtotal * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = "NCB";
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
//Add Params of 2.0.1 Version
////Billing
        $fullName = 'nguyen van a';
        $vnp_Bill_State = $order->txt_bill_state;
// Invoice
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => '13.160.92.202',
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }
        $vnp_Url = $vnp_Url . "?" . $query;
        $returnData = array('code' => '00'
        , 'message' => 'success'
        , 'data' => $vnp_Url);
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);//
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            header('Location: ' . $vnp_Url);
        }
        return view('success')->with('order', $order);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Orders $orders
     * @return \Illuminate\Http\Response
     */
    public function show(Orders $orders)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $acl = Acl::find(Auth::user()->acl);
        $resource = $acl->resource;
        if ($resource!=0) {
            $resource = explode(',', $resource);
        } else {
            $resource = [$resource];
        }
        if(!in_array('attribute', $resource) && !in_array(0, $resource) ) {
            return redirect('admin/dashboard');
        }
        $order = Orders::find($id);
        $orderItems = OrderItems::query()->where('order_id', '=', $id)->get();
        foreach ($orderItems as &$item) {
            $product = Product::find($item->product_id);
            $item->old_price = $product->price;
            $item->name = $product->name;
        }
        return view('admin.order.edit')->with(
            [
                'order' => $order,
                'status_mapper' =>[
                    0 => 'chờ tiếp nhận',
                    1 => 'đang xử lý',
                    2 => 'đang giao',
                    3 => 'hoàn thành',
                    4 => 'đã hủy'
                ],
                'items' => $orderItems
            ]
        );
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Orders $orders
     * @return \Illuminate\Http\Response
     */
    public function destroy(Orders $orders)
    {
        //
    }
}
