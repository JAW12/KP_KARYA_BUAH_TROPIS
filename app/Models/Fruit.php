<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fruit extends Model
{
    use HasFactory;

    public function products()
    {
        return $this->BelongsToMany(Product::class);
    }

    public function matang(){
        return DB::table('fruits_stock')->where('fruit_id', $this->id)->where('keterangan', 'Matang')->sum('jumlah');
    }

    public function mentah(){
        return DB::table('fruits_stock')->where('fruit_id', $this->id)->where('keterangan', 'Mentah')->sum('jumlah');
    }

    public function rusak(){
        return DB::table('fruits_stock')->where('fruit_id', $this->id)->where('keterangan', 'Rusak')->sum('jumlah')*-1;
    }

    public function selesai(){
        return DB::table('fruits_stock')->where('fruit_id', $this->id)->where('keterangan', 'Selesai')->sum('jumlah')*-1;
    }

    public function jumlah(){
        return DB::table('fruits_stock')->where('fruit_id', $this->id)->sum('jumlah');
    }
}
