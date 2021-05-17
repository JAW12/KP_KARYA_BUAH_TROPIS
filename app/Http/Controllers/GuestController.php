<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Fruit;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Auth\Events\PasswordReset;

class GuestController extends Controller
{
    function coba(){
        $sub = DB::table(function ($query) {
            $query->selectRaw('product_id, count(*) as total_order, sum(jumlah) as total_quantity')
                ->from('d_orders')
                ->groupBy('product_id')
                ->orderByRaw('3 desc');
        }, 'sub')->select('product_id')->get();

        $ids = [];
        foreach($sub as $s){
            $ids[] = $s->product_id;
        }

        $terlaris = Product::whereIn('id', $ids)->get();
        if($terlaris->count() < 4){
            $t2 = Product::whereNotIn('id', $ids)->limit(4-$terlaris->count())->get();
            $terlaris = $terlaris->toBase()->merge($t2);
        }
        dd($terlaris);
    }
    function home(){
        $terbaru = Product::orderBy('updated_at', 'asc')->limit(4)->get();
        $sub = DB::table(function ($query) {
            $query->selectRaw('product_id, count(*) as total_order, sum(jumlah) as total_quantity')
                ->from('d_orders')
                ->groupBy('product_id')
                ->orderByRaw('3 desc');
        }, 'sub')->select('product_id')->get();

        $ids = [];
        foreach($sub as $s){
            $ids[] = $s->product_id;
        }

        $terlaris = Product::whereIn('id', $ids)->get();
        if($terlaris->count() < 4){
            $t2 = Product::whereNotIn('id', $ids)->limit(4-$terlaris->count())->orderBy('nama')->get();
            $terlaris = $terlaris->toBase()->merge($t2);
        }
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
                    return redirect()->back()->with("error", "Login Gagal");
                }
            }
            else {
                return redirect()->back()->with("error", "Tidak punya akses");
            }
        }
        else{
            return redirect()->back()->with("error", "Akun tidak ditemukan");
        }
    }

    public function registerPage(){
        return view('auth.register');
    }

    public function register(Request $request) {
        $input = $request->validate([
            "username" => "required|unique:users,username",
            "nama"  => "required|string|min:5",
            "email" => "required|email|unique:users,email",
            "password" => "required|string|min:4",
            "confirm" => "required|same:password",
        ]);

        $attr = $request->all();
        $attr['role'] = 0;
        $attr['password'] = Hash::make($request->password);
        $attr['remember_token'] = Str::random(10);
        $result = User::create($attr);

        if ($result) {
            return redirect()->route('login')->with('success', 'Mendaftar user berhasil.');
        } else {
            return redirect()->back()->with('error', 'Mendaftar user gagal');
        }
    }

    public function forgotPage(){
        return view('auth.forgotpassword');
    }

    public function forgot(Request $request){
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);$request->validate(['email' => 'required|email']);

                    $status = Password::sendResetLink(
                        $request->only('email')
                    );

                    return $status === Password::RESET_LINK_SENT
                                ? back()->with(['status' => __($status)])
                                : back()->withErrors(['email' => __($status)]);
    }

    public function resetPage(){
        return view('auth.resetpassword');
    }

    public function reset(Request $request){
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            "password" => "required|string|min:4",
            "confirm" => "required|same:password",
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->save();

                $user->setRememberToken(Str::random(60));

                event(new PasswordReset($user));
            }
        );

        return $status == Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => __($status)]);
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
        setlocale(LC_TIME, 'id_ID');
        \Carbon\Carbon::setLocale('id');
        \Carbon\Carbon::now()->formatLocalized("%A, %d %B %Y");

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

    public function gallery()
    {
        $pbb = Gallery::where('kategori', 'pbb')->paginate(6)->onEachSide(0);
        $po = Gallery::where('kategori', 'po')->get();
        return view('gallery', compact('pbb', 'po'));
    }
}
