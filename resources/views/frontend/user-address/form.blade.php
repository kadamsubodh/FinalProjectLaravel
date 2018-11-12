<div class="form-group {{ $errors->has('address_1') ? 'has-error' : ''}}">
    <label for="address_1" class="control-label">{{ 'Address 1' }}</label>
    <textarea class="form-control" rows="5" name="address_1" type="textarea" id="address_1" >{{ $useraddress->address_1 or ''}}</textarea>
    {!! $errors->first('address_1', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('address_2') ? 'has-error' : ''}}">
    <label for="address_2" class="control-label">{{ 'Address 2' }}</label>
    <textarea class="form-control" rows="5" name="address_2" type="textarea" id="address_2" >{{ $useraddress->address_2 or ''}}</textarea>
    {!! $errors->first('address_2', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('city') ? 'has-error' : ''}}">
    <label for="city" class="control-label">{{ 'City' }}</label>
    <input class="form-control" name="city" type="text" id="city" value="{{ $useraddress->city or ''}}" >
    {!! $errors->first('city', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('state') ? 'has-error' : ''}}">
    <label for="state" class="control-label">{{ 'State' }}</label>
    <input class="form-control" name="state" type="text" id="state" value="{{ $useraddress->state or ''}}" >
    {!! $errors->first('state', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('country') ? 'has-error' : ''}}">
    <label for="country" class="control-label">{{ 'Country' }}</label>
    <input class="form-control" name="country" type="text" id="country" value="{{ $useraddress->country or ''}}" >
    {!! $errors->first('country', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('zipcode') ? 'has-error' : ''}}">
    <label for="zipcode" class="control-label">{{ 'Zipcode' }}</label>
    <input class="form-control" name="zipcode" type="text" id="zipcode" value="{{ $useraddress->zipcode or ''}}" >
    {!! $errors->first('zipcode', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
