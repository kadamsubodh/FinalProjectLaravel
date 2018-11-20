<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Name' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ $contactus->name or ''}}" >
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    <label for="email" class="control-label">{{ 'Email' }}</label>
    <input class="form-control" name="email" type="text" id="email" value="{{ $contactus->email or ''}}" >
    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('contact_no') ? 'has-error' : ''}}">
    <label for="contact_no" class="control-label">{{ 'Contact No' }}</label>
    <input class="form-control" name="contact_no" type="text" id="contact_no" value="{{ $contactus->contact_no or ''}}" >
    {!! $errors->first('contact_no', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('message') ? 'has-error' : ''}}">
    <label for="message" class="control-label">{{ 'Message' }}</label>
    <textarea class="form-control" rows="5" name="message" type="textarea" id="message" >{{ $contactus->message or ''}}</textarea>
    {!! $errors->first('message', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('note_admin') ? 'has-error' : ''}}">
    <label for="note_admin" class="control-label">{{ 'Note Admin' }}</label>
    <input class="form-control" name="note_admin" type="text" id="note_admin" value="{{ $contactus->note_admin or ''}}" >
    {!! $errors->first('note_admin', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
