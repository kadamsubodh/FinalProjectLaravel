<fieldset>
    <legend>Basic Information</legend>
    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
        <label for="name" class="control-label">{{ 'Name' }}</label>
        <input class="form-control" name="name" type="text" id="name" value="{{ $product->name or ''}}" >
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="row">
            <div class=" col-md-4 form-group {{ $errors->has('Category') ? 'has-error' : ''}}">
                <label for="category" class="control-label">{{ 'Category Name' }}</label>
                @if(isset($product))
                    @foreach(DB::table('product_categories')->where('product_id',$product->id)->get() as $productCategory)
                        <select name="category" class="form-control" id="category" >
                            @foreach(App\Category::all() as $cat)
                                <option @if($productCategory->category_id == $cat->id) selected @endif value={{$cat->id}}>{{$cat->name}}</option>
                            @endforeach
                        </select>
                    @endforeach
                @else
                <select name="category" class="form-control" id="category" >
                    @foreach(App\Category::all() as $cat)
                        <option value={{$cat->id}}>{{$cat->name}}</option>
                    @endforeach
                </select>
                @endif
                {!! $errors->first('category', '<p class="help-block">:message</p>') !!}
            </div>
    </div>
    <div class="form-group {{ $errors->has('sku') ? 'has-error' : ''}}">
        <label for="sku" class="control-label">{{ 'Sku' }}</label>
        <input class="form-control" name="sku" type="text" id="sku" value="{{ $product->sku or ''}}" >
        {!! $errors->first('sku', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group {{ $errors->has('short_description') ? 'has-error' : ''}}">
        <label for="short_decsription" class="control-label">{{ 'Short Description' }}</label>
        <input class="form-control" name="short_description" type="text" id="short_description" value="{{ $product->short_description or ''}}" >
        {!! $errors->first('short_description', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group {{ $errors->has('long_description') ? 'has-error' : ''}}">
        <label for="long_description" class="control-label">{{ 'Long Description' }}</label>
        <textarea class="form-control" rows="5" name="long_description" type="textarea" id="long_description" >{{ $product->long_description or ''}}</textarea>
        {!! $errors->first('long_description', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
        <label for="price" class="control-label">{{ 'Price' }}</label>
        <input class="form-control" name="price" type="number" id="price" value="{{ $product->price or ''}}" >
        {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group {{ $errors->has('special_price') ? 'has-error' : ''}}">
        <label for="special_price" class="control-label">{{ 'Special Price' }}</label>
        <input class="form-control" name="special_price" type="number" id="special_price" value="{{ $product->special_price or ''}}" >
        {!! $errors->first('special_price', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group {{ $errors->has('special_price_from') ? 'has-error' : ''}}">
        <label for="special_price_from" class="control-label">{{ 'Special Price From' }}</label>
        <input class="form-control" name="special_price_from" type="date" id="special_price_from" value="{{ $product->special_price_from or ''}}" >
        {!! $errors->first('special_price_from', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group {{ $errors->has('special_price_to') ? 'has-error' : ''}}">
        <label for="special_price_to" class="control-label">{{ 'Special Price To' }}</label>
        <input class="form-control" name="special_price_to" type="date" id="special_price_to" value="{{ $product->special_price_to or ''}}" >
        {!! $errors->first('special_price_to', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
        <label for="status" class="control-label">{{ 'Status' }}</label>
        <div class="radio">
        <label><input name="status" type="radio" value="1" {{ (isset($product) && 1 == $product->status) ? 'checked' : '' }}> Yes</label>
    </div>
    <div class="radio">
        <label><input name="status" type="radio" value="0" @if (isset($product)) {{ (0 == $product->status) ? 'checked' : '' }} @else {{ 'checked' }} @endif> No</label>
    </div>
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group {{ $errors->has('quantity') ? 'has-error' : ''}}">
        <label for="quantity" class="control-label">{{ 'Quantity' }}</label>
        <input class="form-control" name="quantity" type="number" id="quantity" value="{{ $product->quantity or ''}}" >
        {!! $errors->first('quantity', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group {{ $errors->has('meta_title') ? 'has-error' : ''}}">
        <label for="meta_title" class="control-label">{{ 'Meta Title' }}</label>
        <input class="form-control" name="meta_title" type="text" id="meta_title" value="{{ $product->meta_title or ''}}" >
        {!! $errors->first('meta_title', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group {{ $errors->has('meta_description') ? 'has-error' : ''}}">
        <label for="meta_description" class="control-label">{{ 'Meta Description' }}</label>
        <textarea class="form-control" rows="5" name="meta_description" type="textarea" id="meta_description" >{{ $product->meta_description or ''}}</textarea>
        {!! $errors->first('meta_description', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group {{ $errors->has('meta_keywords') ? 'has-error' : ''}}">
        <label for="meta_keywords" class="control-label">{{ 'Meta Keywords' }}</label>
        <textarea class="form-control" rows="5" name="meta_keywords" type="textarea" id="meta_keywords" >{{ $product->meta_keywords or ''}}</textarea>
        {!! $errors->first('meta_keywords', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group {{ $errors->has('is_featured') ? 'has-error' : ''}}">
        <label for="is_featured" class="control-label">{{ 'Is Featured' }}</label>
        <div class="radio">
        <label><input name="is_featured" type="radio" value="1" {{ (isset($product) && 1 == $product->is_featured) ? 'checked' : '' }}> Yes</label>
    </div>
    <div class="radio">
        <label><input name="is_featured" type="radio" value="0" @if (isset($product)) {{ (0 == $product->is_featured) ? 'checked' : '' }} @else {{ 'checked' }} @endif> No</label>
    </div>
        {!! $errors->first('is_featured', '<p class="help-block">:message</p>') !!}
    </div>
</fieldset>
<fieldset>
    <legend>Add Image</legend>
    <div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
        <label for="image" class="control-label">{{ 'Image' }}</label>
        <input class="form-control" name="image" type="file" id="image" value="{{ $product->image or ''}}" >
        {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group {{ $errors->has('image_status') ? 'has-error' : ''}}">
        <label for="image_status" class="control-label">{{ 'Image Status' }}</label>
        <div class="radio">
        <label><input name="image_status" type="radio" value="1" {{ (isset($product) && 1 == $product->image_status) ? 'checked' : '' }}> Active</label>
    </div>
    <div class="radio">
        <label><input name="image_status" type="radio" value="0" @if (isset($product)) {{ (0 == $product->image_status) ? 'checked' : '' }} @else {{ 'checked' }} @endif> Inactive</label>
    </div>
        {!! $errors->first('image_status', '<p class="help-block">:message</p>') !!}
    </div>
</fieldset>
<fieldset>
    <legend>Product Attributes</legend>
    <div class="container-fluid" id="selectDiv">
        <div class="row">
            <div class="form-group" style="float:right">
                <input type='button' class="btn btn-info btn-sm" value="add more.." id="add"/>
            </div>
        </div>    
        @if(isset($product))
            @foreach(App\Product_attribute_assoc::where('product_id','=',$product->id)->get() as $productAttributeAssoc)               
                @foreach(App\Product_attribute_value::where('id','=',$productAttributeAssoc->product_attribute_value_id)->get() as $attributeValue )
                <div class="row">
                    <div class=" col-md-4 form-group {{ $errors->has('Attribute_name') ? 'has-error' : ''}}">
                        <select name="Attribute_name[]" class="form-control" id="Attribute_name" >
                            @foreach(App\Product_attribute::all() as $attr)
                                <option @if($attr->id==$attributeValue->product_attribute_id) selected @endif value={{$attr->id}}>{{$attr->name}}</option>
                                @endforeach
                        </select>
                        {!! $errors->first('Attribute_name[]', '<p class="help-block">:message</p>') !!}
                    </div>
                    <div class="col-md-2">
                    </div>
                    <div class=" col-md-4 form-group {{ $errors->has('Attribute_value') ? 'has-error' : ''}}">
                    <input class="form-control" name="Attribute_value[]" type="text" id="Attribute_value" value="{{ $attributeValue->attribute_value or ''}}" >
                        {!! $errors->first('Attribute_value[]', '<p class="help-block">:message</p>') !!}
                    </div>
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-1">
                        <input type="button" class="btn btn-danger btn-sm" id="remove" value="remove" onclick="deleteAttributeValue.call(this,event)"/>
                    </div>
                </div>
                @endforeach               
            @endforeach
        @else
        <div class="row">
            <div class=" col-md-4 form-group {{ $errors->has('Attribute_name') ? 'has-error' : ''}}">
                <label for="Attribute_name[]" class="control-label">{{ 'Attribute Name' }}</label>
                <select name="Attribute_name[]" class="form-control" id="Attribute_name" >
                    @foreach(App\Product_attribute::all() as $attr)
                        <option value={{$attr->id}}>{{$attr->name}}</option>
                    @endforeach
                </select>
                {!! $errors->first('Attribute_name', '<p class="help-block">:message</p>') !!}
            </div>
            <div class="col-md-2">
            </div>
            <div class=" col-md-4 form-group {{ $errors->has('Attribute_value') ? 'has-error' : ''}}">
                <label for="Attribute_value[]" class="control-label">{{ 'Attribute Value' }}</label>
                <input class="form-control" name="Attribute_value[]" type="text" id="Attribute_value" value="{{ $product->Attribute_value or ''}}" >
                {!! $errors->first('Attribute_value[]', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        @endif   
    </div>
</fieldset>
<div class="form-group">
    <input id ="submit" class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>

