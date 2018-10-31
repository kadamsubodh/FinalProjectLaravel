<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Product extends Model
{
    public function product_attribute()
    {
    	return $this->hasMany("App\Product_attribute");
    }
    public function catgeory()
    {
    	return $this->belongsTo("App\Catgeory");
    }
    public function product_image()
    {
    	return $this->hasOne("App\Product_image");
    }
}
