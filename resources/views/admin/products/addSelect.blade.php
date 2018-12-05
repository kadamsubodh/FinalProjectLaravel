<?php
$length=$_POST['length'];
$AttributeName="Attribute_name[]";
$AttributeValue="Attribute_value[]";
?>
<div class="col-md-4 form-group">
	<select name="<?php echo $AttributeName;?>" id="<?php echo $AttributeName;?>" class="form-control">
		@foreach(App\Product_attribute::all() as $attr)
			<option value={{$attr->id}}>{{$attr->name}}</option>
		@endforeach
	</select>
</div>
<div class="col-md-2">
</div>
<div class="col-md-4 form-group">
	<input class="form-control" name="<?php echo $AttributeValue;?>" type="text" id="<?php echo $AttributeValue;?>" value="{{ $product->Attribute_value or ''}}" >
</div>
<div class="col-md-1">
</div>
<div class="col-md-1">
	<input type="button" class="btn btn-danger btn-sm " id="remove" value="remove" onclick="deleteAttributeValue.call(this,event)"/>
</div>
