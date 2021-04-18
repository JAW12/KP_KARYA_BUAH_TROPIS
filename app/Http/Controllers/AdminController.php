<?php

namespace App\Http\Controllers;

use App\Models\Fruit;
use App\Models\DOrder;
use App\Models\HOrder;
use App\Models\Product;
use App\Models\Category;
use App\Models\DRequest;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Request as ModelsRequest;
use App\Http\Resources\FruitsStockResources;
use App\Http\Resources\FruitsStockResourcess;

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
        $header = Product::orderBy('nama', 'asc')->get();
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

    function master_produk_index(){
        $header = Product::withTrashed()->orderBy('deleted_at', 'asc')->orderBy('nama', 'asc')->get();
        return view('admin.master.produk.index', compact('header'));
    }

    function master_produk_detail($slug){
        $header = Product::withTrashed()->where('slug', $slug)->first();
        $category = Category::withTrashed()->get();
        $fruits = Fruit::withTrashed()->get();
        $detail = DOrder::where('product_id', $header->id)->get();
        return view('admin.master.produk.detail', compact('header', 'category', 'detail', 'fruits'));
    }

    function master_produk_ubah(Request $request){
        $product = Product::withTrashed()->find($request->id);

        if(isset($request->nama)){
            $this->validate($request, [
                'nama' => 'required',
                'category' => 'required'
            ]);
            $product->nama = $request->nama;
            $product->category_id = $request->category;
            $product->deskripsi = $request->deskripsi;
            $product->tokopedia_url = $request->tokopedia;
            $product->fruits()->sync($request->label);
            $product->save();
            return redirect()->back();
        }
        else{
            $this->validate($request, [
                'foto' => 'required|image\mimes:jpeg,png,jpg,svg|max:2048',
            ]);
            $foto = $request->file('foto');
            $result = Storage::delete('public/img/products/'.$product->foto);
            $foto->storeAs('img/products', Str::slug($product->nama) . '.' . $foto->getClientOriginalExtension(), "public");
            $product->foto = Str::slug($product->nama) . '.' . $foto->getClientOriginalExtension();
            $product->save();
            return redirect()->back();
        }
    }

    function master_produk_tambah_index(){
        $category = Category::all();
        $fruits = Fruit::all();
        return view('admin.master.produk.add', compact('category', 'fruits'));
    }

    function master_produk_tambah(Request $request){
        $this->validate($request, [
            'nama' => 'required',
            'harga_jual' => 'required|numeric|gt:0',
            'category_id' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        $attr = $request->all();
        $slug = Str::slug($request->nama);
        $attr['slug'] = $slug;

        if (request()->file('foto')){
            $foto = request()->file('foto');
            $foto->storeAs('img/products', Str::slug($request->nama) . '.' . $foto->getClientOriginalExtension(), "public");
            $attr['foto'] = Str::slug($request->nama) . '.' . $foto->getClientOriginalExtension();
        }

        $product = Product::create($attr);
        $product->fruits()->attach($request->label);
        $product->save();
        return redirect()->route('admin.master.produk')->with('success', 'Berhasil menambah produk');
    }

    function master_produk_hapus($id){
        Product::find($id)->delete();
        return redirect()->back();
    }

    function master_produk_restore($id){
        $product = Product::withTrashed()->find($id);
        $product->deleted_at = null;
        $product->save();

        return redirect()->back();
    }

    function master_kategori_buah_index(){
        $kategori = Category::withTrashed()->orderBy('nama', 'asc')->get();
        $buah = Fruit::withTrashed()->orderBy('nama', 'asc')->get();
        return view('admin.master.kategori_buah.index', compact('kategori', 'buah'));
    }

    function master_kategori_detail($slug){
        $header = Category::withTrashed()->where('slug', $slug)->first();
        return view('admin.master.kategori_buah.kategori.detail', compact('header'));
    }

    function master_kategori_ubah(Request $request){
        $category = Category::withTrashed()->find($request->id);

        $this->validate($request, [
            'nama' => 'required',
            'keterangan' => 'required'
        ]);
        $category->nama = $request->nama;
        $category->slug = Str::slug($request->nama);
        $category->keterangan = $request->keterangan;
        $category->save();
        return redirect()->route('admin.master.kategori_buah');
    }

    function master_kategori_tambah_index(){
        return view('admin.master.kategori_buah.kategori.add');
    }

    function master_kategori_tambah(Request $request){
        $this->validate($request, [
            'nama' => 'required',
            'keterangan' => 'required',
        ]);

        $attr = $request->all();
        $slug = Str::slug($request->nama);
        $attr['slug'] = $slug;

        $product = Category::create($attr);
        $product->save();
        return redirect()->route('admin.master.kategori_buah')->with('success', 'Berhasil menambah kategori');
    }

    function master_kategori_hapus($id){
        Category::find($id)->delete();
        return redirect()->back();
    }

    function master_category_restore($id){
        $category = Category::withTrashed()->find($id);
        $category->deleted_at = null;
        $category->save();

        return redirect()->back();
    }

    function master_buah_detail($slug){
        $header = Fruit::withTrashed()->where('slug', $slug)->first();
        return view('admin.master.kategori_buah.buah.detail', compact('header'));
    }

    function master_buah_ubah(Request $request){
        $fruit = Fruit::withTrashed()->find($request->id);

        $this->validate($request, [
            'nama' => 'required',
            'manfaat' => 'required'
        ]);
        $fruit->nama = $request->nama;
        $fruit->slug = Str::slug($request->nama);
        $fruit->manfaat = $request->manfaat;
        $fruit->save();
        return redirect()->route('admin.master.kategori_buah');
    }

    function master_buah_tambah_index(){
        return view('admin.master.kategori_buah.buah.add');
    }

    function master_buah_tambah(Request $request){
        $this->validate($request, [
            'nama' => 'required',
            'manfaat' => 'required',
        ]);

        $attr = $request->all();
        $slug = Str::slug($request->nama);
        $attr['slug'] = $slug;

        $product = Fruit::create($attr);
        $product->save();
        return redirect()->route('admin.master.kategori_buah')->with('success', 'Berhasil menambah kategori');
    }

    function master_buah_hapus($id){
        Fruit::find($id)->delete();
        return redirect()->back();
    }

    function master_buah_restore($id){
        $fruit = Fruit::withTrashed()->find($id);
        $fruit->deleted_at = null;
        $fruit->save();

        return redirect()->back();
    }

    function transaksi_index(){
        $header = HOrder::latest()->get();
        return view('admin.penjualan.index', compact('header'));
    }

    function transaksi_detail($id){
        $header = HOrder::find($id);
        $detail = DRequest::where('request_id', $id)->get();
        return view('admin.penjualan.detail', compact('header', 'detail'));
    }

    function transaksi_hapus($id){
        DB::table('h_orders')->where('id', $id)->update(['status' => 0]);
        return redirect()->back();
    }
}
