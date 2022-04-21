<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //
    protected $fillable = ["id","title","slug","description",'image','price','category_id'];

    public function getRouteKeyName()
    {
        return "slug";
    }
    public function sales()
    {
        return $this->belongsToMany(Sales::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
