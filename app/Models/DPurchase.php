<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DPurchase extends Model
{
    use HasFactory;
    protected $table = 'd_purchases';
    protected $primaryKey = 'id';
    protected $fillable = ['purchase_id', 'fruit_id', 'jumlah', 'harga_beli', 'subtotal'];

    public function fruit(){
        return Fruit::where('id', $this->fruit_id)->first();
    }
}
