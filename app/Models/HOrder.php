<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HOrder extends Model
{
    use HasFactory;
    protected $table = 'h_orders';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'metode_pembayaran', 'bukti', 'total', 'keterangan', 'status'];

    public function user(){
        return User::where('id', $this->user_id)->first();
    }

}
