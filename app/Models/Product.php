<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['category_id', 'nama', 'slug', 'foto', 'harga_jual', 'deskripsi', 'tokopedia_url'];

    public function getTakeImageAttribute()
    {
        return "/storage/img/products/" . $this->foto;
    }

    public function fruits()
    {
        return $this->belongsToMany(Fruit::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function jumlah(){
        return DB::table('products_stock')->where('product_id', $this->id)->sum('jumlah');
    }
}
