<?php

namespace App\Http\Controllers;

use App\Models\Acl;
use App\Http\Requests\StoreAclRequest;
use App\Http\Requests\UpdateAclRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Auth;

class AclController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
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
        if(!in_array('acl', $resource) && !in_array(0, $resource) ) {
            return redirect('admin/dashboard');
        }
        return view('admin.acl.index')->with('acls', Acl::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
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
        if(!in_array('acl', $resource) && !in_array(0, $resource) ) {
            return redirect('admin/dashboard');
        }
        return view('admin.acl.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAclRequest  $request
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(StoreAclRequest $request)
    {
        $resource = $request->get('resource');
        $aclResource = [];
        foreach ($resource as $key => $value) {
            if ($key == 'all') {
                $aclResource[] = 0;
            } else {
                $aclResource[] = $key;
            }
        }
        $aclResource = implode(',', $aclResource);
        $data = [
            'name' => $request->get('name') ?? 'admin',
            'resource' => $aclResource
        ];
        Acl::create($data);
        return redirect('admin/acl');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Acl  $acl
     * @return \Illuminate\Http\Response
     */
    public function show(Acl $acl)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $acl = Acl::find($id);
        $resource = $acl->resource;
        if ($resource!=0) {
            $resource = explode(',', $resource);
        } else {
            $resource = [$resource];
        }
        $acl->resource = $resource;
        return view('admin.acl.edit')->with('acl', $acl);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAclRequest  $request
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(UpdateAclRequest $request)
    {
        $resource = $request->get('resource');
        $aclResource = [];
        foreach ($resource as $key => $value) {
            if ($key == 'all') {
                $aclResource[] = 0;
            } else {
                $aclResource[] = $key;
            }
        }
        $aclResource = implode(',', $aclResource);
        $acl = Acl::find($request->get('id'));
        $acl->name = $request->get('name') ?? 'admin';
        $acl->resource = $aclResource;
        $acl->save();
        return redirect('admin/acl');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Acl  $acl
     * @return \Illuminate\Http\Response
     */
    public function destroy(Acl $acl)
    {
        //
    }
}
