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

}