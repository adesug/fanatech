<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    protected $table = 'inventories';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function purchases_details(){
        return $this->hasOne(Purchases_detail::class);
    }
    public function sales_details(){
        return $this->hasOne(Sales_detail::class);
    }   
}

