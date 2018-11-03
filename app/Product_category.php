<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Product_category extends Model
{
   public function product()
   {
   	return $this->belongsTo('App\Product');
   }
}
