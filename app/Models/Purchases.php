<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchases extends Model
{
    use HasFactory;
    protected $table = 'purchases';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function purchases_details(){
        return this->has(Purchases_detail::class,'purchases_id');
    }
}
