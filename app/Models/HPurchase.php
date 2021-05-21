<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HPurchase extends Model
{
    use HasFactory;
    protected $table = 'h_purchases';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'tempat', 'tanggal', 'total', 'foto'];

    public function user(){
        return User::where('id', $this->user_id)->first();
    }
}
