<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Coupon_used extends Model
{
    public function coupon()
    {
    	return $this->belongsTo("App\Coupon");
    }
}
