<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    // public function supplier(){
    //     return $this->belongsTo(Supplier::class,'supplier_id','id');
    // }
    // public function unit(){
    //     return $this->belongsTo(Unit::class,'unit_id','id');
    // }
    // public function category(){
    //     return $this->belongsTo(Category::class,'category_id','id');
    // }
    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
    public function payment(){
        return $this->belongsTo(Payment::class,'id','invoice_id');
    }

    public function Invoice_details(){
        return $this->hasMany(InvoiceDetail::class,'invoice_id','id');
    }
}
