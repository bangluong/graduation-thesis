@extends('layouts.user_type.auth')

@section('content')

    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <div class="d-flex flex-row justify-content-between">
                                <div>
                                    <h5 class="mb-0">All Attributes</h5>
                                </div>
                                <a href="{{ url('admin/attribute/add') }}" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; New Attribute</a>
                            </div>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Attribute Id') }}</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Attribute code') }}</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Attribute name') }}</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Attribute type') }}</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($attributes as $attribute)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{$attribute->id}}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{$attribute->attribute_code}}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-xs font-weight-bold mb-0">{{$attribute->name}}</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            @if ($attribute->type == 0)
                                                <p class="text-xs font-weight-bold mb-0">Text</p>
                                            @elseif ($attribute->type == 1)
                                                <p class="text-xs font-weight-bold mb-0">Text Swatch</p>
                                            @elseif ($attribute->type == 2)
                                                <p class="text-xs font-weight-bold mb-0">Color Swatch</p>
                                            @elseif ($attribute->type == 3)
                                                <p class="text-xs font-weight-bold mb-0">Checkbox</p>
                                            @endif
                                        </td>
                                        <td class="align-middle">
                                            <a href="{{url('admin/attribute/edit/'.$attribute->id)}}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                Edit
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
