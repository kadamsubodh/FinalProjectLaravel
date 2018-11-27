<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Order_detail extends Model
{
    public function user_order()
    {
    	return $this->belongsTo("App\User_order");
    }
}
