<?php

namespace App\Http\Controllers;

use App\Models\ShippingAdress;
use App\Http\Requests\StoreShippingAdressRequest;
use App\Http\Requests\UpdateShippingAdressRequest;

class ShippingAdressController extends Controller
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
     * @param  \App\Http\Requests\StoreShippingAdressRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreShippingAdressRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShippingAdress  $shippingAdress
     * @return \Illuminate\Http\Response
     */
    public function show(ShippingAdress $shippingAdress)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShippingAdress  $shippingAdress
     * @return \Illuminate\Http\Response
     */
    public function edit(ShippingAdress $shippingAdress)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateShippingAdressRequest  $request
     * @param  \App\Models\ShippingAdress  $shippingAdress
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateShippingAdressRequest $request, ShippingAdress $shippingAdress)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShippingAdress  $shippingAdress
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShippingAdress $shippingAdress)
    {
        //
    }
}
