<?php

namespace App\Http\Controllers;

use App\Models\AttributeValue;
use App\Models\Category;
use App\Models\CategoryProducts;
use App\Models\EavAttribute;
use App\Models\File;
use App\Models\Product;
use App\Models\ProductAttributeValue;
use App\Models\Theme;
use App\Http\Requests\StoreThemeRequest;
use App\Http\Requests\UpdateThemeRequest;
use http\Client\Request;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Routing\Route;

class ThemeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $products = Product::query()->where('attribute_set_id', '=', 10)->limit(8)->get();
        foreach ($products as &$product) {
            $imgs = File::query()->where('entity_id', '=', $product->id)->get();
            if (count($imgs)) {
                $product->img = url('/products/'.$imgs[0]->filename);
            } else {
                $product->img = url('/products/placeholder.png');
            }
        }
        $productsPC = Product::query()->where('attribute_set_id', '=', 11)->limit(8)->get();
        foreach ($productsPC as &$productPC) {
            $imgs = File::query()->where('entity_id', '=', $productPC->id)->get();
            if (count($imgs)) {
                $productPC->img = url('/products/'.$imgs[0]->filename);
            } else {
                $productPC->img = url('/products/placeholder.png');
            }
        }
        return view('index')->with(
            [
                'products' => $products,
                'pc' => $productsPC
            ]
        );
    }

    public function categoryProduct($url)
    {
        $category = Category::query()->where('url', '=', $url)->get()[0];
        $category_products = CategoryProducts::query()->where('category_id', '=', $category->id)->get();
        $product_ids = [];
        foreach ($category_products as $a) {
            $product_ids[] = $a->product_id;
        }
        $cate = Category::where('parent_id', '=', 1)->get();
        $limit = 8;
        $brands = AttributeValue::query()->where('attribute_code', '=', 'brand')->get();
        $p = request()->get('p') ?: 1;
        $s = request()->get('s');
        $sort = request()->get('sort') ?? 'id';
        $filter = request()->get('filter');
        $brand = request()->get('brand');
        if ($brand) {
            $prds = ProductAttributeValue::query()->where('value', '=', $brand)
                ->get('product_id');
            $productIds = [];
            foreach ($prds as $prd) {
                $productIds[] = $prd->product_id;
            }
            $products = Product::query()->whereIn('id',  $productIds)->get();
        } else {
            if ($filter) {
                if ($filter == 'price1') {
                    $products = Product::query()->where('price', '<', '10000000')->orderBy($sort, 'asc')->get();
                    if ($s) {
                        $products = Product::query()->where('price', '<', '10000000')->where('name', 'like', "%{$s}%")->orderBy($sort, 'asc')->get();
                    }
                } else if ($filter == 'price2') {
                    $products = Product::query()->where('price', '>=', '10000000')
                        ->where('price', '<=', '20000000')->orderBy($sort, 'asc')->get();
                    if ($s) {
                        $products = Product::query()->where('price', '>=', '10000000')
                            ->where('price', '<=', '20000000')
                            ->where('name', 'like', "%{$s}%")->orderBy($sort, 'asc')->get();
                    }
                } else if ($filter == 'price3') {
                    $products = Product::query()->where('price', '>', '20000000')->orderBy($sort, 'asc')->get();
                    if ($s) {
                        $products = Product::query()->where('price', '>', '20000000')->where('name', 'like', "%{$s}%")->orderBy($sort, 'asc')->get();
                    }
                }
            } else {
                if (count($product_ids)) {
                    $products = Product::query()->whereIn('id', $product_ids)->orderBy($sort, 'asc')->get();
                } else {
                    $products = Product::query()->orderBy($sort, 'asc')->get();
                }
                if ($s) {
                    $products = Product::query()->where('name', 'like', "%{$s}%")->orderBy($sort, 'asc')->get();
                }
            }
        }
        $total = count($products);
        if ($total == 0) {
            return view('product-list')->with([
                'products' => null,
                'cates' => $cate,
                'brands' => $brands
            ]);
        }
        $pageNum = ceil($total/$limit);
        $pages = [];
        $path = request()->path();
        if($p != 1) {
            $url = url($path . ('?p=' . ($p - 1)));
            if ($s) {
                $url = url($path . ('?p=' . ($p - 1))). ('&s='.$s);
            }
            $pages[] = [
                'label' => '<',
                'url' => $url,
                'class' => ''
            ];
        }
        for ($i = 1; $i<=$pageNum; $i++) {
            $url = url($path . ('?p=' . $i));
            if ($s) {
                $url = url($path . ('?p=' . $i)). ('&s='.$s);
            }
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
            if ($s) {
                $url = url($path . ('?p=' . ($p + 1))). ('&s='.$s);
            }
            $pages[] = [
                'label' => '>',
                'url' => $url,
                'class' => ''
            ];
        }
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
            $imgs = File::query()->where('entity_id', '=', $products[$i]->id)->get();
            if (count($imgs)) {
                $products[$i]->img = url('/products/'.$imgs[0]->filename);
            } else {
                $products[$i]->img = url('/products/placeholder.png');
            }
            $prds[] = $products[$i];
        }
        return view('product-list')->with([
            'products' => $prds,
            'pages' =>$pages,
            'cates' => $cate,
            'brands' => $brands
        ]);
    }
    public function list()
    {
        $cate = Category::where('parent_id', '=', 1)->get();
        $limit = 8;
        $brands = AttributeValue::query()->where('attribute_code', '=', 'brand')->get();
        $p = request()->get('p') ?: 1;
        $s = request()->get('s');
        $sort = request()->get('sort') ?? 'id';
        $filter = request()->get('filter');
        $brand = request()->get('brand');
        if ($brand) {
            $prds = ProductAttributeValue::query()->where('value', '=', $brand)
                ->get('product_id');
            $productIds = [];
            foreach ($prds as $prd) {
                $productIds[] = $prd->product_id;
            }
            $products = Product::query()->whereIn('id', $productIds)->get();
        } else {
            if ($filter) {
                if ($filter == 'price1') {
                    $products = Product::query()->where('price', '<', '10000000')->orderBy($sort, 'asc')->get();
                    if ($s) {
                        $products = Product::query()->where('price', '<', '10000000')->where('name', 'like', "%{$s}%")->orderBy($sort, 'asc')->get();
                    }
                } else if ($filter == 'price2') {
                    $products = Product::query()->where('price', '>=', '10000000')
                        ->where('price', '<=', '20000000')->orderBy($sort, 'asc')->get();
                    if ($s) {
                        $products = Product::query()->where('price', '>=', '10000000')
                            ->where('price', '<=', '20000000')
                            ->where('name', 'like', "%{$s}%")->orderBy($sort, 'asc')->get();
                    }
                } else if ($filter == 'price3') {
                    $products = Product::query()->where('price', '>', '20000000')->orderBy($sort, 'asc')->get();
                    if ($s) {
                        $products = Product::query()->where('price', '>', '20000000')->where('name', 'like', "%{$s}%")->orderBy($sort, 'asc')->get();
                    }
                }
            } else {
                $products = Product::query()->orderBy($sort, 'asc')->get();
                if ($s) {
                    $products = Product::query()->where('name', 'like', "%{$s}%")->orderBy($sort, 'asc')->get();
                }
            }
        }
        $total = count($products);
        if ($total == 0) {
            return view('product-list')->with([
                'products' => null,
                'cates' => $cate,
                'brands' => $brands
            ]);
        }
        $pageNum = ceil($total/$limit);
        $pages = [];
        $path = request()->path();
        if($p != 1) {
            $url = url($path . ('?p=' . ($p - 1)));
            if ($s) {
                $url = url($path . ('?p=' . ($p - 1))). ('&s='.$s);
            }
            $pages[] = [
                'label' => '<',
                'url' => $url,
                'class' => ''
            ];
        }
        for ($i = 1; $i<=$pageNum; $i++) {
            $url = url($path . ('?p=' . $i));
            if ($s) {
                $url = url($path . ('?p=' . $i)). ('&s='.$s);
            }
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
            if ($s) {
                $url = url($path . ('?p=' . ($p + 1))). ('&s='.$s);
            }
            $pages[] = [
                'label' => '>',
                'url' => $url,
                'class' => ''
            ];
        }
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
            $imgs = File::query()->where('entity_id', '=', $products[$i]->id)->get();
            if (count($imgs)) {
                $products[$i]->img = url('/products/'.$imgs[0]->filename);
            } else {
                $products[$i]->img = url('/products/placeholder.png');
            }
            $prds[] = $products[$i];
        }
        return view('product-list')->with([
            'products' => $prds,
            'pages' =>$pages,
            'cates' => $cate,
            'brands' => $brands
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
    public function laptop()
    {
        $cate = Category::all();
        $limit = 4;
        $p = request()->get('p') ?: 1;
        $products = Product::query()->where('attribute_set_id', '=', 10)->get();
        $total = count($products);
        $pageNum = ceil($total/$limit);
        $pages = [];
        $path = request()->path();
        if($p != 1) {
            $pages[] = [
                'label' => '<',
                'url' => url($path . ('?p=' . ($p - 1))),
                'class' => ''
            ];
        }
        for ($i = 0; $i<$pageNum; $i++) {
            if ($p == $i + 1) {
                $pages[] = [
                    'label' => $i+1,
                    'url' => url($path.'?p='.$i),
                    'class' => 'active'
                ];
            } else {
                $pages[] = [
                    'label' => $i+1,
                    'url' => url($path.'?p='.$i),
                    'class' => ''
                ];
            }
        }
        if ($p!=$pageNum) {
            $pages[] = [
                'label' => '>',
                'url' => url($path . ('?p=' . ($p + 1))),
                'class' => ''
            ];
        }
        $start = ($p-1)*$limit;
        $end = $start+$limit;
        $prds = [];
        for ($i = $start; $i<$end; $i++) {
            $imgs = File::query()->where('entity_id', '=', $products[$i]->id)->get();
            if (count($imgs)) {
                $products[$i]->img = url('/products/'.$imgs[0]->filename);
            } else {
                $products[$i]->img = url('/products/placeholder.png');
            }
            $prds[] = $products[$i];
        }
        return view('product-list')->with([
            'products' => $prds,
            'pages' =>$pages,
            'cates' => $cate
        ]);
    }
}
