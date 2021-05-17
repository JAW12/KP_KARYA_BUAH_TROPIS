<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DOrder extends Model
{
    use HasFactory;
    protected $table = 'd_orders';
    protected $primaryKey = 'id';
    protected $fillable = ['order_id', 'product_id', 'jumlah', 'harga_jual', 'subtotal'];

    public function product(){
        return Product::where('id', $this->product_id)->first();
    }
}
