<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_wish_list extends Model
{
   public function user()
   {
   	return $this->belongsTo('App\User');
   }
   public function product()
   {
   	return $this->hasMany('App\Product');
   }
}
