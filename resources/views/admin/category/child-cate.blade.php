<ul>
    @foreach($childs as $child)
    <li id="category_{{$child->id}}">
        <a class="" href="{{url('admin/category/edit/'.$child->id)}}">
        {{ $child->title }}
        </a>
        @if(count($child->childs($child->id)))
        @include('admin.category.child-cate',['childs' => $child->childs($child->id)])
        @endif
    </li>
    @endforeach
</ul>
