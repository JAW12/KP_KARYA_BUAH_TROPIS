<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Fruit;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class GuestController extends Controller
{
    function home(){
        $terbaru = Product::orderBy('updated_at', 'asc')->limit(4)->get();
        $terlaris = Product::limit(4)->get();
        $categories = Category::get();
        return view('home',  compact('categories', 'terbaru', 'terlaris'));
    }

    public function loginPage(){
        return view('auth.login');
    }

    public function login(Request $request){
        $input = $request->validate([
            "username" => "required",
            "password" => "required"
        ]);

        $user = User::where('username', $request->username)->first();
        if($user != null){
            if($user->role == 0){
                if (Auth::attempt($request->only(["username", "password"]))) {
                    return redirect()->route('home');
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

    public function registerPage(){
        return view('auth.register');
    }

    public function mail(Request $request)
    {
        $nama = $request->nama;
        $email = $request->email;
        $notelp = $request->telp;
        $waktu = $request->tgl;
        $pesan = $request->pesan;

        $body = "
            nama: {$nama} <br>
            email: {$email} <br>
            notelp: {$notelp} <br>
            waktu: {$waktu} <br>
            pesan: {$pesan}";

        $to_name = "Karya Buah Tropis";
        $to_email = "karyabuahtropis@gmail.com";
        $data = array("name" => "Karya Buah Tropis", "body" => $body);

        try {
            Mail::send("emails.mail", $data, function ($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)
                    ->subject("[KUNJUNGAN]");
                $message->from("karyabuahtropis@gmail.com", "Karya Buah Tropis");
            });
            session()->flash('success', 'Tawaran kunjungan Anda berhasil dikirimkan');
        } catch (\Throwable $th) {
            throw $th;
            session()->flash('error', 'Tawaran kunjungan Anda gagal dikirimkan');
        }
        return redirect()->to('kontak');
    }

    public function produk_index(Request $request)
    {
        $query = request('query');
        if($query != ""){
            $products = Product::where("nama", "like", "%$query%")->latest()->paginate(8);
            $products->appends(['query' => $query]);
        }
        else{
            $products = Product::orderBy('nama', 'ASC')->paginate(8)->onEachSide(0);
        }
        $categories = Category::get();
        $labels = Fruit::get();
        return view('products.list', compact('products', 'categories', 'labels', 'query'));
    }

    public function produk_detail(Product $product)
    {
        $serupa = Product::where('category_id', $product->category_id)->where('id', '!=', $product->id)->limit(4)->get();
        return view('products.detail', compact('product', 'serupa'));
    }

    public function produk_category(Category $category)
    {
        $categories = Category::get();
        $labels = Fruit::get();
        $products = $category->products()->orderBy('nama', 'ASC')->paginate(8);
        return view('products.list', compact('products', 'categories', 'labels', 'category'));
    }

    public function produk_fruit(Fruit $label)
    {
        $categories = Category::get();
        $labels = Fruit::get();
        $products = $label->products()->orderBy('nama', 'ASC')->paginate(8);
        return view('products.list', compact('products', 'categories', 'labels', 'label'));
    }
}
