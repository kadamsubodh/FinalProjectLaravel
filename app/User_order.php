<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_order extends Model
{
    public function user()
    {
    	return $this->belongsTo("App\User");
    }

    public function order_detail()
    {
    	return $this->hasMany("App\Order_detail",'order_id');
    }
}
