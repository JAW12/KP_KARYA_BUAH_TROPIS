<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DRequest extends Model
{
    use HasFactory;
    protected $table = 'd_requests';
    protected $primaryKey = 'id';

    public function fruit(){
        return Fruit::where('id', $this->fruit_id)->first();
    }
}
