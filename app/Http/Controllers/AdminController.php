<?php

namespace App\Http\Controllers;

use App\Models\Fruit;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\FruitsStockResources;
use App\Http\Resources\FruitsStockResourcess;
use App\Models\DRequest;
use App\Models\Request as ModelsRequest;

class AdminController extends Controller
{
    function home(){
        return view('admin.home');
    }

    function stok_bahan_baku_index(){
        $header = Fruit::all();
        return view('admin.stok.bahan_baku.index', compact('header'));
    }

    function stok_bahan_baku_detail($slug){
        $header = Fruit::where('slug', $slug)->first();
        $detail = DB::table('fruits_stock')->where('fruit_id', $header->id)->orderBy('created_at', 'desc')->get();
        return view('admin.stok.bahan_baku.detail', compact('header', 'detail'));
    }

    function stok_bahan_baku_hapus($id){
        $detail = DB::table('fruits_stock')->where('id', $id)->delete();
        return redirect()->back();
    }

    function stok_bahan_baku_tambah(Request $request){
        $this->validate($request, [
            'berat' => 'required|min:0|gt:0',
            'keterangan' => 'required'
        ]);

        $keterangan = $request->keterangan;
        if($keterangan == 'Mentah' || $keterangan == 'Matang'){
            $status = 1;
        }
        else{
            $status = -1;
        }

        $result = DB::table('fruits_stock')->insert([
            'fruit_id' => $request->id,
            'user_id' => 1,
            'berat' => $request->berat,
            'status' => $status,
            'jumlah' => $request->berat * $status,
            'keterangan' => $request->keterangan,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        if($result){
            return redirect()->back();
        }
    }

    function stok_produk_index(){
        $header = Product::all();
        return view('admin.stok.produk.index', compact('header'));
    }

    function stok_produk_detail($slug){
        $header = Product::where('slug', $slug)->first();
        $detail = DB::table('products_stock')->where('product_id', $header->id)->orderBy('created_at', 'desc')->get();
        return view('admin.stok.produk.detail', compact('header', 'detail'));
    }

    function stok_produk_hapus($id){
        $detail = DB::table('products_stock')->where('id', $id)->delete();
        return redirect()->back();
    }

    function stok_produk_tambah(Request $request){
        $this->validate($request, [
            'jumlah' => 'required|min:0|gt:0',
            'keterangan' => 'required'
        ]);

        $keterangan = $request->keterangan;

        $keterangan = $request->keterangan;
        if($keterangan == 'Produksi'){
            $status = 1;
        }
        else{
            $status = -1;
        }
        $result = DB::table('products_stock')->insert([
            'product_id' => $request->id,
            'user_id' => 1,
            'jumlah' => $request->jumlah,
            'status' => $status,
            'jumlah_kali' => $request->jumlah * $status,
            'keterangan' => $keterangan,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        if($result){
            return redirect()->back();
        }
    }

    function permintaan_index(){
        $header = ModelsRequest::latest()->get();
        return view('admin.permintaan.index', compact('header'));
    }

    function permintaan_detail($id){
        $header = ModelsRequest::find($id);
        $detail = DRequest::where('request_id', $id)->get();
        return view('admin.permintaan.detail', compact('header', 'detail'));
    }

    function permintaan_tambah_index(){
        $fruits = Fruit::all();
        return view('admin.permintaan.add', compact('fruits'));
    }

    function permintaan_tambah(Request $request){
        $arr_id = $request->id;
        $arr_jml = $request->jumlah;

        $trans = DB::transaction(function () use ($arr_id, $arr_jml) {
            $count = DB::table('h_requests')->whereDate('created_at', now())->count() + 1;
            DB::table('h_requests')->insert([
                'user_id' => 1,
                'kode' => date("Ymd") . str_pad($count, 3, "0", STR_PAD_LEFT),
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            $id = DB::getPdo()->lastInsertId();

            for($i = 0; $i < count($arr_id); $i++){
                if($arr_jml[$i] != "0"){
                    DB::table('d_requests')->insert([
                        'request_id' => $id,
                        'fruit_id' => $arr_id[$i],
                        'jumlah' => $arr_jml[$i],
                        'status' => 0,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            }

            return $id;
        });
        return redirect()->route('admin.permintaan.detail', $trans);
    }

    function permintaan_hapus($id){
        DB::table('h_requests')->where('id', $id)->update(['status' => 0]);
        return redirect()->back();
    }
}
