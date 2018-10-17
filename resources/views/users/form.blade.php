<div class="container-fluid">
 <div class="row">
 <div class="col-sm-offset-3 col-sm-6">   
<div class="form-group {{ $errors->has('firstname') ? 'has-error' : ''}}">
    <label for="firstname" class="control-label">{{ 'Firstname' }}</label>
    <input class="form-control" name="firstname" type="text" id="firstname" value="{{ $user->firstname or ''}}" >
    {!! $errors->first('firstname', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('lastname') ? 'has-error' : ''}}">
    <label for="lastname" class="control-label">{{ 'Lastname' }}</label>
    <input class="form-control" name="lastname" type="text" id="lastname" value="{{ $user->lastname or ''}}" >
    {!! $errors->first('lastname', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}" >
    <label for="email" class="control-label">{{ 'Email' }}</label>
    <input class="form-control" name="email" type="text" id="email" value="{{ $user->email or ''}}" >
    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}" style="{{ isset($user) ? 'display:none' : '' }}">
    <label for="password" class="control-label">{{ 'Password' }}</label>
    <input class="form-control" name="password" type="password" id="password" value="{{ $user->password or ''}}" >
    {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('confirm_password') ? 'has-error' : ''}}" style="{{ isset($user) ? 'display:none' : '' }}">
    <label for="confirm_password" class="control-label">{{ 'Confirm Password' }}</label>
    <input class="form-control" name="confirm_password" type="password" id="confirm_password" value="{{ $user->confirm_password or ''}}" >
    {!! $errors->first('confirm_password', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="control-label">{{ 'Status' }}</label>
    <div class="radio">
    <label><input name="status" type="radio" value="1" {{ (isset($user) && 1 == $user->status) ? 'checked' : '' }}> Active</label>
</div>
<div class="radio">
    <label><input name="status" type="radio" value="0" @if (isset($user)) {{ (0 == $user->status) ? 'checked' : '' }} @else {{ 'checked' }} @endif> Inactive</label>
</div>
    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('role') ? 'has-error' : ''}}">
    <label for="role" class="control-label">{{ 'Role' }}</label>
<select name="role" class="form-control" id="role" >
      @foreach (App\Role::all() as $role)
        <option value="{{$role->id}}">{{ $role->name}}</option>
    @endforeach
</select>
    {!! $errors->first('role', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
</div>
</div>
</div>
