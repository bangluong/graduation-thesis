<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Product;
use App\Models\Theme;
use App\Http\Requests\StoreThemeRequest;
use App\Http\Requests\UpdateThemeRequest;
use Illuminate\Contracts\Foundation\Application;

class ThemeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $products = Product::all();
        foreach ($products as &$product) {
            $imgs = File::query()->where('entity_id', '=', $product->id)->get();
            if (count($imgs)) {
                $product->img = url('/products/'.$imgs[0]->filename);
            } else {
                $product->img = url('/products/placeholder.png');
            }
        }
        return view('index')->with(
            [
                'products' => $products
            ]
        );
    }
    public function list()
    {
        $products = Product::all();
        foreach ($products as &$product) {
            $imgs = File::query()->where('entity_id', '=', $product->id)->get();
            if (count($imgs)) {
                $product->img = url('/products/'.$imgs[0]->filename);
            } else {
                $product->img = url('/products/placeholder.png');
            }
        }
        return view('product-list')->with(
            [
                'products' => $products
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
     * @param  \App\Http\Requests\StoreThemeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreThemeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Theme  $theme
     * @return \Illuminate\Http\Response
     */
    public function show(Theme $theme)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Theme  $theme
     * @return \Illuminate\Http\Response
     */
    public function edit(Theme $theme)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateThemeRequest  $request
     * @param  \App\Models\Theme  $theme
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateThemeRequest $request, Theme $theme)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Theme  $theme
     * @return \Illuminate\Http\Response
     */
    public function destroy(Theme $theme)
    {
        //
    }
}
