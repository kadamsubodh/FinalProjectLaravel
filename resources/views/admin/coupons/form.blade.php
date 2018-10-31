<div class="form-group {{ $errors->has('code') ? 'has-error' : ''}}">
    <label for="code" class="control-label">{{ 'Code' }}</label>
    <input class="form-control" name="code" type="text" id="code" value="{{ $coupon->code or ''}}" readonly="true"><button type='button' class="btn btn-info" onclick="getCode()">Get Code</button>
    {!! $errors->first('code', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('percent_off') ? 'has-error' : ''}}">
    <label for="percent_off" class="control-label">{{ 'Percent Off' }}</label>
    <input class="form-control" name="percent_off" type="number" id="percent_off" value="{{ $coupon->percent_off or ''}}" >
    {!! $errors->first('percent_off', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('number_of_uses') ? 'has-error' : ''}}">
    <label for="number_of_uses" class="control-label">{{ 'Number Of Uses' }}</label>
    <input class="form-control" name="number_of_uses" type="number" id="number_of_uses" value="{{ $coupon->no_of_uses or ''}}" >
    {!! $errors->first('no_of_uses', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
