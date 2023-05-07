<?php

namespace App\Http\Controllers;

use App\Models\Acl;
use App\Models\Category;
use App\Models\CategoryProducts;
use App\Models\File;
use App\Models\Product;
use http\Url;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\AttributeSet;
use App\Models\AttributeSetAttribute;
use App\Models\EavAttribute;
use App\Models\AttributeValue;
use App\Models\ProductAttributeValue;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|\Illuminate\Http\Response
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
        if(!in_array('attribute', $resource) && !in_array(0, $resource) ) {
            return redirect('admin/dashboard');
        }
        $products = Product::all();
        $total = count($products);
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
            $prds[] = $products[$i];
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
        return view('admin.product.index')->with(
            [
                'products' => $prds,
                'pages' => $pages
            ]
        );
    }

    public function getCategories()
    {
        $categories = Category::where('parent_id', '=', 0)->get();
        $cates = [];
        foreach ($categories as $cate) {
            $cates[] = $this->getChildCate($cate, 0);
        }
        return $cates[0];
    }

    public function getChildCate($cate, $level)
    {
        $childs = $cate->childs($cate->id);
        $results = [];
        $results[] = [
            'value' => $cate->id,
            'label' => str_repeat('-', $level) . ' ' . $cate->title,
        ];
        if (count($childs)) {
            foreach ($childs as $child) {
                $results = array_merge_recursive($results, $this->getChildCate($child, $level + 1));
            }
        }
        return $results;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
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
        $sets = AttributeSet::all();
        $this->getCategories();
        foreach ($sets as &$set) {
            $listAttrs = AttributeSetAttribute::where('attribute_set_name', '=', $set->attribute_set_name)->get();
            $set->list_attrs = $listAttrs;
            foreach ($listAttrs as &$attr) {
                $atb = EavAttribute::query()->where('attribute_code', '=', $attr->attribute_code)->get()[0];
                if ($atb->type != 0) {
                    $optionValue = AttributeValue::query()->where('attribute_code', '=', $atb->attribute_code)->get();
                    $atb->option_values = $optionValue;
                }
                $attr->attr = $atb;
            }
        }
        return view('admin.product.form')->with(
            [
                'label' => 'Add New',
                'url' => url('admin/product/save'),
                'sets' => $sets,
                'categories' => $this->getCategories()
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        try {
            $product = Product::create($request->all());
            $attributes = $request->get('attributes');
            $cates = $request->get('category');
            foreach ($cates as $cate) {
                $categoryPrd = new CategoryProducts;
                $categoryPrd->category_id = $cate;
                $categoryPrd->product_id = $product->id;
                $categoryPrd->save();
            }
            foreach ($attributes as $key => $value) {
                if ($value) {
                    $attribute = EavAttribute::query()->where('attribute_code', '=', $key)->get()[0];
                    $optionValue = AttributeValue::query()->where('attribute_code', '=', $key)
                        ->where('value', '=', $value)->get();
                    $swatch = $value;
                    if (isset($optionValue[0])) {
                        $swatch = $optionValue[0]->swatch;
                    }
                    $data = [
                        'attribute_code' => $key,
                        'value' => $value,
                        'product_id' => $product->id,
                        'attribute_name' => $attribute->name,
                        'label' => $swatch
                    ];
                    ProductAttributeValue::create($data);
                }
            }
            if ($request->hasfile('filenames')) {
                foreach ($request->file('filenames') as $file) {
                    $name = time() . rand(1, 100) . '.' . $file->extension();
                    $file->move(public_path('products'), $name);
                    $fileModel = new File();
                    $fileModel->filename = $name;
                    $fileModel->type = 'product';
                    $fileModel->entity_id = $product->id;
                    $fileModel->save();
                }
            }
            session()->flash('success', 'lưu dữ liệu thành công');
            return redirect('admin/products');
        } catch (\Exception $e) {
            session()->flash('error','có lỗi xảy ra. vui lòng thử lại sau');
            return redirect('admin/products');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param string $sku
     * @return Application|Factory|View|\Illuminate\Http\Response
     */
    public function show($sku)
    {
        $product = Product::query()->where('sku', '=', $sku)->first();
        $imgs = File::query()->where('entity_id', '=', $product->id)->get();
        $images = [];
        foreach ($imgs as $img) {
            $images[] = url('products/'.$img->filename);
        }
        if (!count($images)) {
            $images[] = url('products/placeholder.png');
        }
        $product->imgs = $images;
        $allAttribute = ProductAttributeValue::query()->where('product_id', '=', $product->id)->get();
        $product->attributes = $allAttribute;
        return view('product')->with(['product'=>$product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View|\Illuminate\Http\Response
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
        $product = Product::find($id);
        $set = AttributeSet::find($product->attribute_set_id);
        $imgs = File::query()->where('entity_id', '=', $id)->get();
        $listAttrs = AttributeSetAttribute::where('attribute_set_name', '=', $set->attribute_set_name)->get();
        $productAttributeValue = ProductAttributeValue::query()->where('product_id', '=', $id)->get();
        $atbTmp = [];
        foreach ($productAttributeValue as $at) {
            $atbTmp[$at->attribute_code] = $at;
        }
        $set->list_attrs = $listAttrs;
        foreach ($listAttrs as &$attr) {
            $atb = EavAttribute::query()->where('attribute_code', '=', $attr->attribute_code)->get()[0];
            $selectedValue = 0;
            if (isset($atbTmp[$attr->attribute_code])) {
                $selectedValue = $atbTmp[$attr->attribute_code]->value;
            }
            if ($atb->type != 0) {
                $optionValue = AttributeValue::query()->where('attribute_code', '=', $atb->attribute_code)->get();
                foreach ($optionValue as &$value) {
                    if($value->value == $selectedValue) {
                        $value->is_select = 1;
                    } else {
                        $value->is_select = 0;
                    }
                }
                $atb->option_values = $optionValue;
            } else {
                $atb->added_value = $selectedValue;
            }
            $attr->attr = $atb;
        }
        $allCategory = $this->getCategories();
        $categoryProducts = CategoryProducts::query()->where('product_id', '=', $id)->get();
        $listCateIds = [];
        foreach ($categoryProducts as $categoryProduct) {
            $listCateIds[] = $categoryProduct->category_id;
        }
        foreach ($allCategory as &$category) {
            if (in_array($category['value'], $listCateIds)) {
                $category['is_selected'] = 'selected';
            } else {
                $category['is_selected'] ='';
            }
        }
        return view('admin.product.edit')->with(
            [
                'label' => 'Edit Product',
                'url' => url('admin/product/update'),
                'set' => $set,
                'categories' => $allCategory,
                'product' => $product,
                'list_images' => $imgs,
                'img_id' => $id
            ]
        );

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return Application|RedirectResponse|\Illuminate\Http\Response|Redirector
     */
    public function update(Request $request)
    {
        $id = $request->get('id');
        $product = Product::find($id);
        $product->update($request->all());
        ProductAttributeValue::query()->where('product_id', '=', $id)->delete();
        File::query()->where('entity_id', '=', $id)->delete();
        $attributes = $request->get('attributes');
        $cates = $request->get('category');
        foreach ($cates as $cate) {
            $categoryPrd = new CategoryProducts;
            $categoryPrd->category_id = $cate;
            $categoryPrd->product_id = $product->id;
            $categoryPrd->save();
        }
        foreach ($attributes as $key => $value) {
            $attribute = EavAttribute::query()->where('attribute_code', '=', $key)->get()[0];
            $optionValue = AttributeValue::query()->where('attribute_code', '=', $key)
                ->where('value', '=', $value)->get();
            $swatch = $value;
            if (isset($optionValue[0])) {
                $swatch = $optionValue[0]->swatch;
            }
            $data = [
                'attribute_code' => $key,
                'value' => $value ?? '',
                'product_id' => $product->id,
                'attribute_name' => $attribute->name,
                'label' => $swatch ?? ''
            ];
                ProductAttributeValue::create($data);

        }
        if ($request->hasfile('filenames')) {
            foreach ($request->file('filenames') as $file) {
                $name = time() . rand(1, 100) . '.' . $file->extension();
                $file->move(public_path('products'), $name);
                $fileModel = new File();
                $fileModel->filename = $name;
                $fileModel->type = 'product';
                $fileModel->entity_id = $product->id;
                $fileModel->save();
            }
        }
        session()->flash('success', 'lưu dữ liệu thành công');
        return redirect('admin/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Application|RedirectResponse|\Illuminate\Http\Response|Redirector
     */
    public function destroy($id)
    {
        Product::destroy($id);
        return redirect('/admin/products');
    }
}
