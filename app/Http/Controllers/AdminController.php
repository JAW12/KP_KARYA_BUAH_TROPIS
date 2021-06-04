<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Fruit;
use App\Models\DOrder;
use App\Models\HOrder;
use App\Models\Product;
use App\Models\Category;
use App\Models\DRequest;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\Request as ModelsRequest;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Resources\FruitsStockResources;
use App\Http\Resources\FruitsStockResourcess;
use App\Models\DPurchase;
use App\Models\Gallery;
use App\Models\HPurchase;

class AdminController extends Controller
{
    function hash(){
        $user = User::find(1);
        $user->password = Hash::make($user->password);
        $user->save();
    }

    public function adminLoginPage(){
        if(Session::has('admin')){
            Alert::error('Gagal', 'Anda tidak punya akses ke halaman ini');
            return redirect()->route('admin.home');
        }
        else if(Auth::check())
        {
            Alert::error('Gagal', 'Anda tidak punya akses ke halaman ini');
            return redirect()->route('home');
        }
        else{
            return view('auth.admin.login');
        }
    }

    public function login(Request $request){
        $input = $request->validate([
            "username" => "required",
            "password" => "required"
        ]);

        $user = User::where('username', $request->username)->first();
        if($user != null){
            if($user->role > 0){
                if (Auth::attempt($request->only(["username", "password"]))) {
                    Session::put('admin', $user->role);
                    return redirect()->route('admin.home');
                } else {
                    return redirect()->back()->with("error", "Login failed");
                }
            }
            else {
                return redirect()->back()->with("error", "Unauthorized access");
            }
        }
        else{
            return redirect()->back()->with("error", "User not found");
        }
    }

    public function logout(){
        Auth::logout();
        Session::forget('admin');
        return redirect()->route('admin.login');
    }

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
        Alert::success('Berhasil', "Stok bahan baku berhasil dihapus");
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
            'user_id' => Auth::id(),
            'berat' => $request->berat,
            'status' => $status,
            'jumlah' => $request->berat * $status,
            'keterangan' => $request->keterangan,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        if($result){
            Alert::success('Berhasil', "Stok bahan baku berhasil ditambah");
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
        Alert::success('Berhasil', "Stok produk berhasil dihapus");
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
            'user_id' => Auth::id(),
            'jumlah' => $request->jumlah,
            'status' => $status,
            'jumlah_kali' => $request->jumlah * $status,
            'keterangan' => $keterangan,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        if($result){
            Alert::success('Berhasil', "Stok produk berhasil ditambah");
            return redirect()->back();
        }
    }

    function stok_produk_ubahHarga($hargabaru, $id){
        $product = Product::withTrashed()->find($id);
        $product->harga_jual = $hargabaru;
        $product->save();
        Alert::success('Berhasil', "Harga produk $product->nama berhasil diubah");
        return redirect()->back();
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
                'user_id' => Auth::id(),
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
        Alert::success('Berhasil', "Permintaan berhasil ditambah");
        return redirect()->route('admin.permintaan.detail', $trans);
    }

    function permintaan_hapus($id){
        DB::table('h_requests')->where('id', $id)->update(['status' => 0]);
        Alert::success('Berhasil', "Permintaan berhasil dihapus");
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
            Alert::success('Berhasil', "Produk $product->nama berhasil diubah");
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
            Alert::success('Berhasil', "Produk $product->nama berhasil diubah");
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
        Alert::success('Berhasil', "Berhasil menambahkan produk $product->nama");
        return redirect()->route('admin.master.produk');
    }

    function master_produk_hapus($id){
        $product = Product::find($id);
        $product->delete();
        Alert::success('Berhasil', "Berhasil menghapus produk $product->nama");
        return redirect()->back();
    }

    function master_produk_restore($id){
        $product = Product::withTrashed()->find($id);
        $product->deleted_at = null;
        $product->save();
        Alert::success('Berhasil', "Berhasil mengembalikan produk $product->nama");
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
        Alert::success('Berhasil', "Berhasil mengubah kategori $category->nama");
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

        $category = Category::create($attr);
        $category->save();
        Alert::success('Berhasil', "Berhasil menambah kategori $category->nama");
        return redirect()->route('admin.master.kategori_buah');
    }

    function master_kategori_hapus($id){
        $category = Category::find($id);
        $category->delete();
        Alert::success('Berhasil', "Berhasil menghapus kategori $category->nama");
        return redirect()->back();
    }

    function master_category_restore($id){
        $category = Category::withTrashed()->find($id);
        $category->deleted_at = null;
        $category->save();
        Alert::success('Berhasil', "Berhasil mengembalikan kategori $category->nama");
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
        Alert::success('Berhasil', "Berhasil mengubah buah $fruit->nama");
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

        $fruit = Fruit::create($attr);
        $fruit->save();
        Alert::success('Berhasil', "Berhasil menambah buah $fruit->nama");
        return redirect()->route('admin.master.kategori_buah');
    }

    function master_buah_hapus($id){
        $fruit = Fruit::find($id);
        $fruit->delete();
        Alert::success('Berhasil', "Berhasil menambah buah $fruit->nama");
        return redirect()->back();
    }

    function master_buah_restore($id){
        $fruit = Fruit::withTrashed()->find($id);
        $fruit->deleted_at = null;
        $fruit->save();
        Alert::success('Berhasil', "Berhasil mengembalikan buah $fruit->nama");
        return redirect()->back();
    }

    function master_pegawai_index(){
        $header = User::withTrashed()->where('role', '<>', 0)->where('role', '<>', 0)->orderBy('deleted_at', 'asc')->orderBy('nama', 'asc')->get();
        return view('admin.master.pegawai.index', compact('header'));
    }

    function master_pegawai_detail($username){
        $header = User::withTrashed()->where('username', $username)->first();
        return view('admin.master.pegawai.detail', compact('header'));
    }

    function master_pegawai_ubah(Request $request){
        $user = User::withTrashed()->find($request->id);

        $this->validate($request, [
            'nama' => 'required',
            'role' => 'required'
        ]);

        $user->nama = $request->nama;

        if($request->role == $user->role){
            $splitName = explode(' ', $request->nama, 2); // Restricts it to only 2 values, for names like Billy Bob Jones
            $first_name = $splitName[0];

            $password = strtolower($first_name) . '_' . strtolower($request->username);
            $password = Hash::make($password);

            $user->password = $password;
        }
        else{
            $c = User::where('role', $request->role)->count();
            $username = "";
            if($request->role == 1){
                $username = "PRD";
            }
            else if($request->role == 2){
                $username = "PMB";
            }
            else if($request->role == 3){
                $username = "PNJ";
            }

            $username .= str_pad($c+1, 3, '0', STR_PAD_LEFT);
            $splitName = explode(' ', $request->nama, 2); // Restricts it to only 2 values, for names like Billy Bob Jones
            $first_name = $splitName[0];

            $password = strtolower($first_name) . '_' . strtolower($username);
            $password = Hash::make($password);

            $user->username = $username;
            $user->role = $request->role;
            $user->password = $password;
        }

        $user->save();
        Alert::success('Berhasil', "Berhasil mengubah pegawai $user->nama");
        return redirect()->route('admin.master.pegawai');
    }

    function master_pegawai_tambah_index(){
        return view('admin.master.pegawai.add');
    }

    function master_pegawai_tambah(Request $request){
        $this->validate($request, [
            'nama' => 'required',
            'role' => 'required|numeric',
        ]);

        $attr = $request->all();
        $r = $attr['role'];

        $c = User::where('role', $r)->count();
        $username = "";

        if($r == 1){
            $username = "PRD";
        }
        else if($r == 2){
            $username = "PMB";
        }
        else if($r == 3){
            $username = "PNJ";
        }

        $username .= str_pad($c+1, 3, '0', STR_PAD_LEFT);
        $splitName = explode(' ', $attr['nama'], 2); // Restricts it to only 2 values, for names like Billy Bob Jones
        $first_name = $splitName[0];

        $password = strtolower($first_name) . '_' . strtolower($username);
        $password = Hash::make($password);

        $attr['username'] = $username;
        $attr['password'] = $password;

        $user = User::create($attr);
        $user->save();
        Alert::success('Berhasil', "Berhasil menambah pegawai $user->nama");
        return redirect()->route('admin.master.pegawai');
    }

    function master_pegawai_hapus($id){
        $user = User::find($id);
        $user->delete();
        Alert::success('Berhasil', "Berhasil menghapus pegawai $user->nama");
        return redirect()->back();
    }

    function master_pegawai_restore($id){
        $user = User::withTrashed()->find($id);
        $user->deleted_at = null;
        $user->save();
        Alert::success('Berhasil', "Berhasil mengembalikan pegawai $user->nama");
        return redirect()->back();
    }

    function transaksi_index(){
        $header = HOrder::latest()->get();
        return view('admin.transaksi.index', compact('header'));
    }

    function laporan_transaksi_index(){
        $header = HOrder::latest()->get();
        return view('admin.transaksi.laporan', compact('header'));
    }

    function laporan_transaksi(Request $request){
        $from = $request->from;
        $to = $request->to;
        $header = DB::table('h_orders')
            ->join('users', 'h_orders.user_id', '=', 'users.id')
            ->where('h_orders.created_at', '>=', $from)
            ->where('h_orders.created_at', '<=', $to)
            ->where('h_orders.status', '=', 3)
            ->select('h_orders.id', 'h_orders.metode_pembayaran', 'h_orders.total', 'users.nama', 'h_orders.created_at')
            ->orderBy('h_orders.created_at', 'asc')
            ->get();
        $header = json_decode(json_encode($header), true);
        foreach($header as $key => $value){
            $detail = DB::table('d_orders')
                ->join('products', 'products.id', '=', 'd_orders.product_id')
                ->where('d_orders.order_id', $value['id'])
                ->get();
            $header[$key]['detail'] = json_decode(json_encode($detail), true);
        }
        $summary = DB::table('products')
                    ->join('d_orders', 'products.id', '=', 'd_orders.product_id')
                    ->join('h_orders', 'h_orders.id', '=', 'd_orders.order_id')
                    ->select('products.nama', DB::raw('sum(d_orders.jumlah) as jumlah'))
                    ->where('h_orders.created_at', '>=', $from)
                    ->where('h_orders.created_at', '<=', $to)
                    ->groupBy('products.nama')
                    ->get();
        $summary = json_decode(json_encode($summary), true);
        // print_r($header);
        return response()->json([
            'status' => 'success',
            'data' => $header,
            'summary' => $summary
        ]);
    }

    function laporan_transaksi_print(Request $request){
        $from = $request->from;
        $to = $request->to;
        $header = DB::table('h_orders')
            ->join('users', 'h_orders.user_id', '=', 'users.id')
            ->where('h_orders.created_at', '>=', $from)
            ->where('h_orders.created_at', '<=', $to)
            ->where('h_orders.status', '=', 3)
            ->select('h_orders.id', 'h_orders.metode_pembayaran', 'h_orders.total', 'users.nama', 'h_orders.created_at')
            ->orderBy('h_orders.created_at', 'asc')
            ->get();
        $header = json_decode(json_encode($header), true);
        foreach($header as $key => $value){
            $detail = DB::table('d_orders')
                ->join('products', 'products.id', '=', 'd_orders.product_id')
                ->where('d_orders.order_id', $value['id'])
                ->get();
            $header[$key]['detail'] = json_decode(json_encode($detail), true);
        }
        $summary = DB::table('products')
                    ->join('d_orders', 'products.id', '=', 'd_orders.product_id')
                    ->join('h_orders', 'h_orders.id', '=', 'd_orders.order_id')
                    ->select('products.nama', DB::raw('sum(d_orders.jumlah) as jumlah'))
                    ->where('h_orders.created_at', '>=', $from)
                    ->where('h_orders.created_at', '<=', $to)
                    ->groupBy('products.nama')
                    ->get();
        return view('admin.transaksi.print', compact('header', 'summary'));
    }

    function transaksi_tambah_index(){
        return view('admin.transaksi.add');
    }

    function transaksi_tambah_index2(){
        $products = Product::all();
        $idtrans = HOrder::orderBy('id', 'desc')->first()->id;
        return view('admin.transaksi.add-dtrans', compact('products', 'idtrans'));
    }

    function transaksi_tambah(Request $request){
        $this->validate($request, [
            'nama' => 'required',
            'notelp' => 'required',
            'alamat' => 'required',
            'total_pembayaran' => 'required|numeric|gt:0',
            'foto' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        $attr = $request->all();
        $slug = Str::slug($request->nama . '.' . now());
        $attr['slug'] = $slug;

        if (request()->file('foto')){
            $foto = request()->file('foto');
            $foto->storeAs('img/transaksi', Str::slug($request->nama . '.' . now()) . '.' . $foto->getClientOriginalExtension(), "public");
            $attr['foto'] = Str::slug($request->nama . '.' . now()) . '.' . $foto->getClientOriginalExtension();
        }

        // -1 -> batalkan, 0 -> belum dibayar, 1 -> sudah lunas, 2 -> sedang diproses, 3 -> selesai
        $result = DB::table('h_orders')->insert([
            'user_id' => Auth::id(),
            'metode_pembayaran' => "transfer",
            'bukti' => Str::slug($request->nama . '.' . now()) . '.' . $foto->getClientOriginalExtension(),
            'total' => $request->total_pembayaran,
            'keterangan' => $request->nama . ' - ' . $request->notelp . ' - ' . $request->alamat,
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        if($result){
            return redirect()->route('admin.transaksi.tambah-dtrans');
        }
    }

    function transaksi_tambah_dtrans(Request $request){
        $idtrans = $request->idtrans;
        $arr_id = $request->id;
        $arr_jml = $request->jumlah;
        $arr_hrg = $request->harga;

        $trans = DB::transaction(function () use ($arr_id, $arr_jml, $arr_hrg, $idtrans) {
            for($i = 0; $i < count($arr_id); $i++){
                if($arr_jml[$i] != "0"){
                    DB::table('d_orders')->insert([
                        'order_id' => $idtrans,
                        'product_id' => $arr_id[$i],
                        'jumlah' => $arr_jml[$i],
                        'harga_jual' => $arr_hrg[$i],
                        'subtotal' => $arr_jml[$i] * $arr_hrg[$i],
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            }
        });
        return redirect()->route('admin.transaksi');
    }

    function transaksi_detail($id){
        $header = HOrder::find($id);
        $detail = DOrder::where('order_id', $id)->get();
        $customer = User::all();
        return view('admin.transaksi.detail', compact('header', 'detail', 'customer'));
    }

    function transaksi_detail_ubah(Request $request){
        // $this->validate($request, [
        //     'status' => 'required',
        //     'foto' => 'required|image\mimes:jpeg,png,jpg,svg|max:2048'
        // ]);
        $trans = HOrder::find($request->id);
        $customer = User::all();
        // ambil nama customer
        foreach ($customer as $key => $value) {
            if($trans->user_id == $value->id) {
                if($value->role == 0) {
                    $namacustomer = $value->nama;
                }
                else {
                    $pieces = explode("-", $trans->keterangan);
                    $namacustomer = $pieces[0];
                }
            }
        }

        $trans->status = $request->status;
        $foto = $request->file('foto');
        $result = Storage::delete('public/img/transaksi/'.$trans->bukti);
        $foto->storeAs('img/transaksi', Str::slug($namacustomer . '.' . now()) . '.' . $foto->getClientOriginalExtension(), "public");
        $trans->bukti = Str::slug($namacustomer . '.' . now()) . '.' . $foto->getClientOriginalExtension();
        $trans->save();
        Alert::success('Berhasil', "Transaksi $namacustomer berhasil diubah");
        return redirect()->route('admin.transaksi');
    }

    function pembelian_index(){
        $header = HPurchase::latest()->get();
        return view('admin.pembelian.index', compact('header'));
    }

    function laporan_pembelian_index(){
        $header = HPurchase::latest()->get();
        return view('admin.pembelian.laporan', compact('header'));
    }

    function laporan_pembelian(Request $request){
        $from = $request->from;
        $to = $request->to;
        $header = DB::table('h_purchases')
            ->join('users', 'h_purchases.user_id', '=', 'users.id')
            ->where('h_purchases.tanggal', '>=', $from)
            ->where('h_purchases.tanggal', '<=', $to)
            ->select('h_purchases.id', 'h_purchases.tempat', 'h_purchases.tanggal', 'h_purchases.total', 'users.nama')
            ->orderBy('h_purchases.tanggal', 'asc')
            ->get();
        $header = json_decode(json_encode($header), true);
        foreach($header as $key => $value){
            $detail = DB::table('d_purchases')
                ->join('fruits', 'fruits.id', '=', 'd_purchases.fruit_id')
                ->where('d_purchases.purchase_id', $value['id'])
                ->get();
            $header[$key]['detail'] = json_decode(json_encode($detail), true);
        }
        $summary = DB::table('fruits')
                    ->join('d_purchases', 'fruits.id', '=', 'd_purchases.fruit_id')
                    ->join('h_purchases', 'h_purchases.id', '=', 'd_purchases.purchase_id')
                    ->select('fruits.nama', DB::raw('sum(d_purchases.jumlah) as jumlah'))
                    ->where('h_purchases.tanggal', '>=', $from)
                    ->where('h_purchases.tanggal', '<=', $to)
                    ->groupBy('fruits.nama')
                    ->get();
        $summary = json_decode(json_encode($summary), true);
        // print_r($header);
        return response()->json([
            'status' => 'success',
            'data' => $header,
            'summary' => $summary
        ]);
    }

    function laporan_pembelian_print(Request $request){
        $from = $request->from;
        $to = $request->to;
        $header = DB::table('h_purchases')
            ->join('users', 'h_purchases.user_id', '=', 'users.id')
            ->where('h_purchases.tanggal', '>=', $from)
            ->where('h_purchases.tanggal', '<=', $to)
            ->select('h_purchases.id', 'h_purchases.tempat', 'h_purchases.tanggal', 'h_purchases.total', 'users.nama')
            ->orderBy('h_purchases.tanggal', 'asc')
            ->get();
        $header = json_decode(json_encode($header), true);
        foreach($header as $key => $value){
            $detail = DB::table('d_purchases')
                ->join('fruits', 'fruits.id', '=', 'd_purchases.fruit_id')
                ->where('d_purchases.purchase_id', $value['id'])
                ->get();
            $header[$key]['detail'] = json_decode(json_encode($detail), true);
        }
        $summary = DB::table('fruits')
                    ->join('d_purchases', 'fruits.id', '=', 'd_purchases.fruit_id')
                    ->join('h_purchases', 'h_purchases.id', '=', 'd_purchases.purchase_id')
                    ->select('fruits.nama', DB::raw('sum(d_purchases.jumlah) as jumlah'))
                    ->where('h_purchases.tanggal', '>=', $from)
                    ->where('h_purchases.tanggal', '<=', $to)
                    ->groupBy('fruits.nama')
                    ->get();
        return view('admin.pembelian.print', compact('header', 'summary'));
    }

    function pembelian_tambah_index(){
        return view('admin.pembelian.add');
    }

    function pembelian_tambah_index2(){
        $fruits = Fruit::all();
        $idtrans = HPurchase::orderBy('id', 'desc')->first()->id;
        return view('admin.pembelian.add-dbeli', compact('fruits', 'idtrans'));
    }

    function pembelian_tambah(Request $request){
        $this->validate($request, [
            'tempat' => 'required',
            'tanggal' => 'required',
            'total' => 'required|numeric|gt:0',
            'foto' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        $attr = $request->all();
        $slug = Str::slug($request->tempat . '.' . now());
        $attr['slug'] = $slug;

        if (request()->file('foto')){
            $foto = request()->file('foto');
            $foto->storeAs('img/pembelian', Str::slug($request->tempat . '.' . now()) . '.' . $foto->getClientOriginalExtension(), "public");
            $attr['foto'] = Str::slug($request->tempat . '.' . now()) . '.' . $foto->getClientOriginalExtension();
        }

        // -1 -> batalkan, 0 -> belum dibayar, 1 -> sudah lunas, 2 -> sedang diproses, 3 -> selesai
        $result = DB::table('h_purchases')->insert([
            'user_id' => Auth::id(),
            'tempat' => $request->tempat,
            'tanggal' => $request->tanggal,
            'total' => $request->total,
            'foto' => Str::slug($request->tempat . '.' . now()) . '.' . $foto->getClientOriginalExtension(),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        if($result){
            return redirect()->route('admin.pembelian.tambah-dbeli');
        }
    }

    function pembelian_tambah_dbeli(Request $request){
        $idtrans = $request->idtrans;
        $arr_id = $request->id;
        $arr_fruit = $request->fruit;

        $trans = DB::transaction(function () use ($arr_id, $arr_fruit, $idtrans) {
            for($i = 1; $i < count($arr_fruit); $i++){
                if($arr_fruit[$i]["jumlah"] != "0"){
                    DB::table('d_purchases')->insert([
                        'purchase_id' => $idtrans,
                        'fruit_id' => $i,
                        'jumlah' => $arr_fruit[$i]["jumlah"],
                        'harga_beli' => $arr_fruit[$i]["harga_beli"],
                        'subtotal' => $arr_fruit[$i]["jumlah"] * $arr_fruit[$i]["harga_beli"],
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            }
        });
        return redirect()->route('admin.pembelian');
    }

    function pembelian_detail($id){
        $header = HPurchase::find($id);
        $detail = DPurchase::where('purchase_id', $id)->get();
        $customer = User::all();
        return view('admin.pembelian.detail', compact('header', 'detail', 'customer'));
    }

    function pembelian_detail_ubah(Request $request){
        $trans = HPurchase::find($request->id);
        $tempatbeli = $trans->tempat;
        $foto = $request->file('foto');
        $result = Storage::delete('public/img/pembelian/'.$trans->foto);
        $foto->storeAs('img/pembelian', Str::slug($tempatbeli . '.' . now()) . '.' . $foto->getClientOriginalExtension(), "public");
        $trans->foto = Str::slug($tempatbeli . '.' . now()) . '.' . $foto->getClientOriginalExtension();
        $trans->save();
        Alert::success('Berhasil', "Pembelian di $tempatbeli berhasil diubah");
        return redirect()->route('admin.pembelian');
    }

    function permintaan_ubahStatus($statusbaru, $id){
        $permintaan = DRequest::find($id);
        $permintaan->status = $statusbaru;
        $permintaan->save();
        Alert::success('Berhasil', "Status permintaan berhasil diubah");
        return redirect()->back();
    }

    function master_banner_index(){
        $header = Gallery::where('kategori', 'banner')->get();
        return view('admin.master.banner.index', compact('header'));
    }

    function master_banner_tambah(Request $request){
        $request->validate([
            "foto" => "required",
        ]);

        $attr = $request->all();
        $attr['kategori'] = 'banner';
        $count = Gallery::where('kategori', 'banner')->count() + 1;
        $nama = "Banner $count";
        $attr['nama'] = $nama;

        if (request()->file('foto')){
            $foto = request()->file('foto');
            $foto->storeAs('img/banner/', Str::slug($nama) . '.' . $foto->getClientOriginalExtension(), "public");
            $attr['url'] = Str::slug($nama) . '.' . $foto->getClientOriginalExtension();
        }

        $gallery = Gallery::create($attr);
        $gallery->save();
        Alert::success('Berhasil', "Berhasil menambahkan $nama");
        return redirect()->route('admin.master.banner');
    }

    function master_banner_hapus($id){
        $gallery = Gallery::find($id);
        $result = Storage::delete('public/img/banner/'.$gallery->url);
        if($result){
            $gallery->delete();
            Alert::success('Berhasil', "Banner berhasil dihapus");
            return redirect()->back();
        }
        else{
            Alert::error('Gagal', "Banner gagal dihapus");
            return redirect()->back();
        }
    }
}
