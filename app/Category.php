<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Category extends Model
{
    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }
    public function product()
    {
    	return $this->hasManyThrough('App\Product');
    }
}
