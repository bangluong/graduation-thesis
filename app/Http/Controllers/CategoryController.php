<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Acl;
use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
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
        if(!in_array('category', $resource) && !in_array(0, $resource) ) {
            return redirect('admin/dashboard');
        }
        $allCategories = Category::where('parent_id', '=', 0)->get();
        return view('admin.category.index')
            ->with([
                'categories' => $allCategories,
                'parent' => 1,
                'url' => url('admin/category/save')
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
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(StoreCategoryRequest $request)
    {
        $cate = Category::create($request->all());
        return redirect('admin/category/edit/'.$cate->id);
    }

    /**
     * Display the specified resource.
     *
     * @param int  $categoryId
     * @return Application|Factory|View|\Illuminate\Http\Response
     */
    public function addSubCategory(int $categoryId)
    {
        $allCategories = Category::where('parent_id', '=', 0)->get();
        return view('admin.category.index')
            ->with([
                'categories' => $allCategories,
                'parent' => $categoryId,
                'url' => url('admin/category/save')
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $categoryId
     * @return Application|Factory|View
     */
    public function edit($categoryId)
    {
        $acl = Acl::find(Auth::user()->acl);
        $resource = $acl->resource;
        if ($resource!=0) {
            $resource = explode(',', $resource);
        } else {
            $resource = [$resource];
        }
        if(!in_array('category', $resource) && !in_array(0, $resource) ) {
            return redirect('admin/dashboard');
        }
        $allCategories = Category::where('parent_id', '=', 0)->get();
        $category = Category::find($categoryId);
        return view('admin.category.index')
            ->with([
                'categories' => $allCategories,
                'category' => $category,
                'url' => url('admin/category/update')
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
