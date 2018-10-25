<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Product_attribute extends Model
{
	public function product()
	{
		$this->belongsTo('App\Product');
	}
	public function product_attribute_value()
	{
		$this->hasMany("App\Product_attribute_value");
	}
}
