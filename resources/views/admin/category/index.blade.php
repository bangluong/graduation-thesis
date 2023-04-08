@extends('layouts.user_type.auth')

@section('content')

    <button type="button" class="btn btn-secondary btn-lg active">
        @if(isset($category))
            <a href="{{url('admin/category/add/'.$category->id)}}">{{__('Add Sub Category')}}</a>
        @else
            <a href="{{url('admin/category/add/1')}}">{{__('Add Sub Category')}}</a>
        @endif
    </button>
    <div class="category card-group">
        <div class="card">
            <div class="card-body pt-2">
                @foreach($categories as $cat)
                    <li id="category_{{$cat->id}}">
                        <a href="{{url('admin/category/edit/'.$cat->id)}}">
                        {{ $cat->title }}
                        </a>
                        @if(count($cat->childs($cat->id)))
                            @include('admin.category.child-cate',['childs' => $cat->childs($cat->id)])
                        @endif
                    </li>
                @endforeach
            </div>
        </div>
        <div class="card">
            <div class="card-body pt-2">
                <form action="{{$url}}" method="POST" role="form text-left">
                    <div class="card-body pt-4 p-3">
                        @csrf
                        @if($errors->any())
                            <div class="mt-3  alert alert-primary alert-dismissible fade show" role="alert">
                            <span class="alert-text text-white">
                            {{$errors->first()}}</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <i class="fa fa-close" aria-hidden="true"></i>
                                </button>
                            </div>
                        @endif
                        @if(session('success'))
                            <div class="m-3  alert alert-success alert-dismissible fade show" id="alert-success"
                                 role="alert">
                            <span class="alert-text text-white">
                            {{ session('success') }}</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <i class="fa fa-close" aria-hidden="true"></i>
                                </button>
                            </div>
                        @endif
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user-name" class="form-control-label">{{ __('Name') }}</label>
                                <div class="border rounded-3">
                                    @if(isset($category))
                                        <input class="form-control" value="{{$category->title}}" type="text"
                                               placeholder="title"
                                               id="attribute-label" name="title">
                                        <input class="form-control" value="{{$category->id}}" type="hidden"
                                               id="attribute-label" name="id">
                                        @if(isset($parent))
                                            <input class="form-control" value="{{$parent}}" type="hidden"
                                                   id="attribute-label" name="parent_id">
                                        @else
                                            <input class="form-control" value="{{$category->parent_id}}" type="hidden"
                                                   id="attribute-label" name="parent_id">
                                        @endif
                                    @else
                                        <input class="form-control" value="" type="text" placeholder="name"
                                               id="attribute-label" name="title">
                                        @if(isset($parent))
                                            <input class="form-control" value="{{$parent}}" type="hidden"
                                                   id="attribute-label" name="parent_id">
                                        @else
                                            <input class="form-control" value="1" type="hidden"
                                                   id="attribute-label" name="parent_id">
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end" style="margin-right: 100px">
                        <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Save' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
