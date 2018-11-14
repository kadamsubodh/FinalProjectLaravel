<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Coupon extends Model
{
    public function coupon_used()
    {
    	return $this->hasMany("App\Coupon_used");
    }
}
