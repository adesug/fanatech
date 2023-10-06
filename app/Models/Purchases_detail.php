<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchases_detail extends Model
{
    use HasFactory;
    protected $table = 'purchases_details';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function purchases() {
        return $this->belongsTo(Purchases::class,'purchases_id');
    }
    public function inventory() {
        return $this->belongsTo(Inventory::class,'inventory_id');
    }
}
