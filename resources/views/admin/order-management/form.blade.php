<div class="form-group {{ $errors->has('abc') ? 'has-error' : ''}}">
    <label for="abc" class="control-label">{{ 'Abc' }}</label>
    <input class="form-control" name="abc" type="text" id="abc" value="{{ $ordermanagement->abc or ''}}" >
    {!! $errors->first('abc', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('body') ? 'has-error' : ''}}">
    <label for="body" class="control-label">{{ 'Body' }}</label>
    <textarea class="form-control" rows="5" name="body" type="textarea" id="body" >{{ $ordermanagement->body or ''}}</textarea>
    {!! $errors->first('body', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
