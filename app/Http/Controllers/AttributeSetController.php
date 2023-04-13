<?php

namespace App\Http\Controllers;

use App\Models\Acl;
use App\Models\AttributeSet;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\EavAttribute;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use App\Models\AttributeSetAttribute;
use Illuminate\Support\Facades\Auth;

class AttributeSetController extends Controller
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
        if(!in_array('attribute', $resource) && !in_array(0, $resource) ) {
            return redirect('admin/dashboard');
        }
        return view('EavAttribute.AttributeSet.index')->with('sets', AttributeSet::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
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
        $allAttr = EavAttribute::all();
        return view('EavAttribute.AttributeSet.form')
            ->with(
                [
                    'label' =>'Add New',
                    'attributes' => $allAttr,
                    'url' => url('admin/attribute_set/save')
                ]
            );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        AttributeSet::create($request->all());
        $attrs = $request->get('atb');
        foreach ($attrs as $key => $value) {
            if ($value == 1) {
                $data = [
                    'attribute_set_name' => $request->get('attribute_set_name'),
                    'attribute_code' => $key
                ];
                AttributeSetAttribute::create($data);
            } else {
                (new \App\Models\AttributeSetAttribute)->deleteIfExist($request->get('attribute_set_name'), $key);
            }
        }

        return redirect('admin/attribute_set');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AttributeSet  $attributeSet
     * @return Response
     */
    public function show(AttributeSet $attributeSet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $attributeSetId
     * @return Application|Factory|View
     */
    public function edit($attributeSetId)
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
        $allAttr = EavAttribute::all();
        $set = AttributeSet::find($attributeSetId);
        $addedAttr = (new \App\Models\AttributeSetAttribute)->getBySet($set->attribute_set_name);
        $addedAttrCode = [];
        foreach ($addedAttr as $attr) {
            $addedAttrCode[] = $attr->attribute_code;
        }
        foreach ($allAttr as &$attr) {
            if (in_array($attr->attribute_code, $addedAttrCode)) {
                $attr->is_added = 1;
            } else {
                $attr->is_added = 0;
            }
        }
        return view('EavAttribute.AttributeSet.form')
            ->with(
                [
                    'label' =>$set->attribute_set_name,
                    'attributes' => $allAttr,
                    'set'=>$set,
                    'url' => url('admin/attribute_set/update')
                ]
            );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $attributeSetId
     * @return Application|Redirector|RedirectResponse
     */
    public function update(Request $request)
    {
        /**@var AttributeSet $set*/
        $set = AttributeSet::find($request->get('id'));
        $set->update($request->all());
        $attrs = $request->get('atb');
        foreach ($attrs as $key => $value) {
            if ($value == 1) {
                $data = [
                    'attribute_set_name' => $request->get('attribute_set_name'),
                    'attribute_code' => $key
                ];
                AttributeSetAttribute::create($data);
            } else {
                (new \App\Models\AttributeSetAttribute)->deleteIfExist($request->get('attribute_set_name'), $key);
            }
        }

        return redirect('admin/attribute_set/edit/'.$set->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AttributeSet  $attributeSet
     * @return Response
     */
    public function destroy(AttributeSet $attributeSet)
    {
        //
    }
}
