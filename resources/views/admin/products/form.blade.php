<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Name' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ $product->name or ''}}" >
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('sku') ? 'has-error' : ''}}">
    <label for="sku" class="control-label">{{ 'Sku' }}</label>
    <input class="form-control" name="sku" type="text" id="sku" value="{{ $product->sku or ''}}" >
    {!! $errors->first('sku', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('short_description') ? 'has-error' : ''}}">
    <label for="short_description" class="control-label">{{ 'Short Description' }}</label>
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
    <input class="form-control" name="price" type="text" id="price" value="{{ $product->price or ''}}" >
    {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('special_price') ? 'has-error' : ''}}">
    <label for="special_price" class="control-label">{{ 'Special Price' }}</label>
    <input class="form-control" name="special_price" type="text" id="special_price" value="{{ $product->special_price or ''}}" >
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
    <input class="form-control" name="quantity" type="text" id="quantity" value="{{ $product->quantity or ''}}" >
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


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
