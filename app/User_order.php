<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_order extends Model
{
    public function user()
    {
    	return $this->belongsTo("App\User");
    }
}
