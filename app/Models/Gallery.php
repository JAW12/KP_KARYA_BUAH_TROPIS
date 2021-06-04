<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    protected $fillable = ['nama', 'url', 'kategori'];

    public function getTakeImageAttribute()
    {
        return "/storage/galleries/" . $this->url;
    }
}
