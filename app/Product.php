<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Product extends Model
{
    public function product_attribute()
    {
    	return $this->hasMany("App\Product_attribute");
    }
    public function category()
    {
    	return $this->belongsTo("App\Category");
    }
    public function product_image()
    {
    	return $this->hasOne("App\Product_image");
    }

    public function product_category()
    {
        return $this->hasOne("App\Product_category");
    }
    public function user_wish_list()
    {
        return $this->belongsTo('App\user_wish_list');
    }
}
