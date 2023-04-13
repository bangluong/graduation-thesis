<?php

namespace App\Http\Controllers;

use App\Models\Acl;
use App\Models\EavAttribute;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\AttributeValue;
use Illuminate\Support\Facades\Auth;

class EavAttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
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
        $allAttr = EavAttribute::all();
        return view('EavAttribute.Admin.listing')->with('attributes', $allAttr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
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
        return view('EavAttribute.Admin.form')
            ->with([
                'label' =>'Add New Attribute',
                'url' => url('admin/attribute/save'),
                'options' => [],
                'type' => 0
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Application|RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $values = $request->get('values');
        $swatches = $request->get('swatches');
        EavAttribute::create($request->all());
        foreach ($values as $index => $value) {
            if ($value) {
                $data = [
                    'attribute_code' => $request->get('attribute_code'),
                    'value' => $value,
                    'swatch' => $swatches[$index]
                ];
                AttributeValue::create($data);
            }
        }
        return redirect('admin/attributes');
    }

    /**
     * Display the specified resource.
     *
     * @param int $eavAttributeId
     * @return \Illuminate\Http\Response
     */
    public function show(int $eavAttributeId)
    {
        $attr = EavAttribute::find($eavAttributeId);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $eavAttributeId
     * @return Application|Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(int $eavAttributeId)
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
        $attr = EavAttribute::find($eavAttributeId);
        $options = AttributeValue::getValueOptionOfAttribute($attr->attribute_code);

        return view('EavAttribute.Admin.form')->with([
            'attribute' => $attr,
            'options' => $options,
            'url' => url('admin/attribute/update'),
            'label' => 'Edit Attribute',
            'type' => $attr->type
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Application|RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request)
    {
        $id = $request->get('id');
        /**@var EavAttribute $attr*/
        $attr = EavAttribute::find($id);
        $attr->update($request->all());
        AttributeValue::deleteByAttribute($request->get('attribute_code'));
        $values = $request->get('values');
        $swatches = $request->get('swatches');
        if (count($values)) {
            foreach ($values as $index => $value) {
                if ($value) {
                    $data = [
                        'attribute_code' => $request->get('attribute_code'),
                        'value' => $value,
                        'swatch' => $swatches[$index]
                    ];
                    AttributeValue::create($data);
                }
            }
        }
        return redirect('admin/attribute/edit/'.$id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\EavAttribute $eavAttribute
     * @return \Illuminate\Http\Response
     */
    public function destroy(EavAttribute $eavAttribute)
    {
        //
    }
}
