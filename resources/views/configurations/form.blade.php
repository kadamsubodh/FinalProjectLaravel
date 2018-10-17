<div class="form-group {{ $errors->has('conf_key') ? 'has-error' : ''}}">
    <label for="conf_key" class="control-label">{{ 'Conf Key' }}</label>
    <input class="form-control" name="conf_key" type="text" id="conf_key" value="{{ $configuration->conf_key or ''}}" >
    {!! $errors->first('conf_key', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('conf_value') ? 'has-error' : ''}}">
    <label for="conf_value" class="control-label">{{ 'Conf Value' }}</label>
    <input class="form-control" name="conf_value" type="text" id="conf_value" value="{{ $configuration->conf_value or ''}}" >
    {!! $errors->first('conf_value', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="control-label">{{ 'Status' }}</label>
    <div class="radio">
    <label><input name="status" type="radio" value="1" {{ (isset($configuration) && 1 == $configuration->status) ? 'checked' : '' }}> Active</label>
</div>
<div class="radio">
    <label><input name="status" type="radio" value="0" @if (isset($configuration)) {{ (0 == $configuration->status) ? 'checked' : '' }} @else {{ 'checked' }} @endif>Inactive</label>
</div>
    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
