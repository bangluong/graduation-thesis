<?php

namespace App\Http\Controllers;

use App\Models\EavAttribute;
use Illuminate\Http\Request;

class EavAttributeController extends Controller
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
     * @return \Illuminate\Contracts\View\View
     */
    public function AttributeIndex()
    {
        return view('EavAttribute.Admin.listing');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createAttribute()
    {
        return view('EavAttribute.Admin.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EavAttribute  $eavAttribute
     * @return \Illuminate\Http\Response
     */
    public function show(EavAttribute $eavAttribute)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EavAttribute  $eavAttribute
     * @return \Illuminate\Http\Response
     */
    public function edit(EavAttribute $eavAttribute)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EavAttribute  $eavAttribute
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EavAttribute $eavAttribute)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EavAttribute  $eavAttribute
     * @return \Illuminate\Http\Response
     */
    public function destroy(EavAttribute $eavAttribute)
    {
        //
    }
}
