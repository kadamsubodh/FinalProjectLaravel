<?php
namespace App;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Spatie\Permission\Traits\HasRoles;
class User extends Model implements Authenticatable
{
   use AuthenticableTrait;
   use HasRoles;
   protected $fillable=array('firstname','lastname','email', 'password','status','created_date','role_id');   
   //public $table = 'users';
    public function role(){
    return	$this->belongsTo('Spatie\Permission\Models\Role', 'role_id');
   }
   public function user_wish_list()
   {
   		return $this->hasMany('App\User_wish_list');
   }
   public function UserAaddress(){
    return $this->hasMany('App\UserAaddress');
   } 

   public function user_order()
   {
    return $this->hasMany("App\User_order");
   }
   public function coupon_used()
   {
    return $this->hasMany("App\Coupon_used");
   }

}