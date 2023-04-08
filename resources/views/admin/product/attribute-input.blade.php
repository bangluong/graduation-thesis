@foreach($set->list_attrs as $attr)
    @if($attr->attr->type == 0)
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-control-label">{{ __($attr->attr->name) }}</label>
                <div class="border rounded-3">
                    <input class="form-control" type="text" name="attributes[{{$attr->attr->attribute_code}}]"
                           value="{{$attr->attr->added_value}}">
                </div>
            </div>
        </div>
    @else
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-control-label">{{ __($attr->attr->name) }}</label>
                <div class="border rounded-3">
                    <select class="form-control" id="input-type" name="attributes[{{$attr->attr->attribute_code}}]">
                        @foreach($attr->attr->option_values as $value)
                            @if(isset($value->is_select))
                                @if($value->is_select == 1)
                                    <option value="{{$value->value}}" selected>{{$value->swatch}}</option>
                                @else
                                    <option value="{{$value->value}}">{{$value->swatch}}</option>
                                @endif
                            @else
                                <option value="{{$value->value}}">{{$value->swatch}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    @endif
@endforeach
