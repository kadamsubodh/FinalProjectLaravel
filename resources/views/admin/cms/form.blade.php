<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'Title' }}</label>
    <input class="form-control" name="title" type="text" id="title" value="{{ $cm->title or ''}}" >
    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('content') ? 'has-error' : ''}}">
    <label for="content" class="control-label">{{ 'Content' }}</label>
    <textarea class="form-control content" rows="5" name="content" type="textarea" id="content" >{{ $cm->content or ''}}</textarea>
    {!! $errors->first('content', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('meta_title') ? 'has-error' : ''}}">
    <label for="meta_title" class="control-label">{{ 'Meta Title' }}</label>
    <input class="form-control" name="meta_title" type="text" id="meta_title" value="{{ $cm->meta_title or ''}}" >
    {!! $errors->first('meta_title', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('meta_description') ? 'has-error' : ''}}">
    <label for="meta_description" class="control-label">{{ 'Meta Description' }}</label>
    <textarea class="form-control" rows="5" name="meta_description" type="textarea" id="meta_description" >{{ $cm->meta_description or ''}}</textarea>
    {!! $errors->first('meta_description', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('meta_keywords') ? 'has-error' : ''}}">
    <label for="meta_keywords" class="control-label">{{ 'Meta Keywords' }}</label>
    <textarea class="form-control" rows="5" name="meta_keywords" type="textarea" id="meta_keywords" >{{ $cm->meta_keywords or ''}}</textarea>
    {!! $errors->first('meta_keywords', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>  

  <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
    <script>
        $('#content').ckeditor();
        $('#meta_description').ckeditor();
        // $('.textarea').ckeditor(); // if class is prefered.
    </script>