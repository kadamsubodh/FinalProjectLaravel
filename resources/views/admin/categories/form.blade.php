<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Name' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ $category->name or ''}}" >
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('parent_category') ? 'has-error' : ''}}">
    <label for="parent_category" class="control-label">{{ 'Parent Category' }}</label>
	<select name="parent_category" class="form-control" id="parent_category" >
		<option value='0'>self</option>
	   @foreach(App\Category::all() as $category)
	   <option value='{{$category->id}}'>{{$category->name}}</option>
	   @endforeach
	</select>
    {!! $errors->first('parent_category', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
