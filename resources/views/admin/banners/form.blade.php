<div class="form-group {{ $errors->has('banner_name') ? 'has-error' : ''}}">
    <label for="banner_name" class="control-label">{{ 'Banner Name' }}</label>
    <input class="form-control" name="banner_name" type="text" id="banner_name" value="{{ $banner->banner_name or ''}}" >
    {!! $errors->first('banner_name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('banner_image') ? 'has-error' : ''}}">
    <label for="banner_image" class="control-label">{{ 'Banner Image' }}</label>
    <input class="form-control" name="banner_image" type="file" id="banner_image" value="{{ $banner->banner_image or ''}}" >
    {!! $errors->first('banner_image', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="control-label">{{ 'status' }}</label>
    <div class="radio">
    <label><input name="status" type="radio" value="1" {{ (isset($banner) && 1 == $banner->status) ? 'checked' : '' }}> Enable</label>
</div>
<div class="radio">
    <label><input name="status" type="radio" value="0" @if (isset($banner)) {{ (0 == $banner->status) ? 'checked' : '' }} @else {{ 'checked' }} @endif> Disable</label>
</div>
    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
