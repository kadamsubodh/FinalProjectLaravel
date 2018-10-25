<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Product extends Model
{
    public function product_attribute()
    {
    	$this->hasMany("App\Product_attribute");
    }
    public function catgeory()
    {
    	$this->belongsTo("App\Catgeory");
    }
}
