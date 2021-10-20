<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    public function supplier(){
        return $this->belongsTo(Supplier::class,'supplier_id','id');
    }
    public function unit(){
        return $this->belongsTo(Unit::class,'unit_id','id');
    }
    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
   

}
