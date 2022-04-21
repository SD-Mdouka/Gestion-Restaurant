<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    //
    protected $fillable = ["servant_id","quantity","total_price",'total_received','change','payment_type',"payment_status"];
    public function menus()
    {
        return $this->belongsToMany(Menu::class);
    }
    public function tables(){
        return $this->belongsToMany(Table::class);
    }
    public function servant(){
        return $this->belongsTo(Servant::class);
    }
}
