<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Request extends Model
{
    use HasFactory;
    protected $table = 'h_requests';
    protected $primaryKey = 'id';

    public function status(){
        $detail = DB::table('d_requests')->select('status')->where('request_id', $this->id)->get();
        $status = true;
        foreach($detail as $value){
            if($value->status == '0'){
                $status = false;
            }
        }
        return $status;
    }

    public function sudah(){
        $detail = DB::table('d_requests')->select('status')->where('request_id', $this->id)->get();
        $status = false;
        foreach($detail as $value){
            if($value->status == '1'){
                $status = true;
            }
        }
        return $status;
    }

    public function user(){
        return User::where('id', $this->user_id)->first();
    }

    public function detail(){
        return DRequest::where('request_id', $this->id)->get();
    }
}
