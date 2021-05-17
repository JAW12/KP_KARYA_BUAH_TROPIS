<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\DOrder;
use App\Models\HOrder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function logout(){
        Auth::logout();
        return redirect()->route('home');
    }

    public function profilePage(){
        return view('user.profile');
    }

    public function profileSubmit(Request $request){
        $attr = $request->all();

        if($request->email !=  Auth::user()->email){
            $input = $request->validate([
                "email" => "required|email|unique:users,email",
            ]);
            $attr['email_verified_at'] = null;
        }
        if($request->password != null){
            $input = $request->validate([
                "password" => "required|string|min:4",
                "confirm" => "required|same:password",
            ]);
            $attr['password'] = Hash::make($request->password);
        }
        else{
            $attr['password'] = Auth::user()->password;
        }

        $result = User::find(Auth::id())->update($attr);
        if ($result) {
            Alert::success('Berhasil', 'Berhasil mengubah profil akun');
            return redirect()->route('profile');
        } else {
            Alert::error('Gagal', 'Gagal mengubah profil akun');
            return redirect()->back();
        }
    }

    public function addtocart(Request $request){
        $id = $request->id;
        $jml = $request->jml;

        $lama = Auth::user()->carts()->where('product_id', $id)->first();
        if($lama != null){
            $jmllama = $lama->pivot->jumlah;
            $jmlbaru = $jmllama + $jml;
            Auth::user()->carts()->updateExistingPivot($id, [
                'jumlah' => $jmlbaru
            ]);
            $baru = Auth::user()->carts()->where('product_id', $id)->first();

            if($baru != $lama){
                echo 'Success';
            }
            else{
                echo 'Failed';
            }
        }
        else{
            $c = Auth::user()->carts()->count();
            Auth::user()->carts()->attach($id, ['jumlah' => $jml]);
            $cb = Auth::user()->carts()->count();

            if($cb > $c){
                echo 'Success';
            }
            else{
                echo 'Failed';
            }
        }
    }

    public function cartsPage(){
        $total = 0;
        foreach(Auth::user()->carts as $c){
            $total += $c->pivot->jumlah * $c->harga_jual;
        }
        return view('user.carts', compact('total'));
    }

    public function tambahCart($id){
        $cart = Auth::user()->carts()->find($id);
        $jmlbaru = $cart->pivot->jumlah + 1;

        Auth::user()->carts()->updateExistingPivot($id, [
            'jumlah' => $jmlbaru
        ]);

        Alert::success('Berhasil', "Berhasil menambah produk $cart->nama");
        return redirect()->back();
    }

    public function kurangCart($id){
        $cart = Auth::user()->carts()->find($id);
        $jmlbaru = $cart->pivot->jumlah - 1;

        Auth::user()->carts()->updateExistingPivot($id, [
            'jumlah' => $jmlbaru
        ]);

        Alert::success('Berhasil', "Berhasil mengurangi produk $cart->nama");
        return redirect()->back();
    }

    public function hapusCart($id){
        $cart = Auth::user()->carts()->find($id);
        $produk = $cart->nama;

        $res = Auth::user()->carts()->detach($id);

        Alert::success('Berhasil', "Berhasil menghapus produk $produk");
        return redirect()->back();
    }

    public function checkoutCart(){
        $berhasil = true;
        $cart = Auth::user()->carts;
        $total = 0;
        foreach($cart as $c){
            $total += $c->pivot->jumlah * $c->harga_jual;
        }

        DB::beginTransaction();

        $result = HOrder::create([
            'user_id' => Auth::id(),
            'total' => $total,
            'status' => 0
        ]);
        if($result){
            try {
                foreach($cart as $c){
                    DOrder::create([
                        'order_id' => $result->id,
                        'product_id' => $c->id,
                        'jumlah' => $c->pivot->jumlah,
                        'harga_jual' => $c->harga_jual,
                        'subtotal' =>$c->pivot->jumlah * $c->harga_jual
                    ]);
                }

                foreach($cart as $c){
                    Auth::user()->carts()->detach($c->id);
                }

                DB::commit();
            } catch (\Throwable $th) {
                $berhasil = false;
                DB::rollBack();
            }
        }
        else{
            $berhasil = false;
        }

        if($berhasil){
            Alert::success('Berhasil', "Berhasil melakukan pemesanan");
            return redirect()->back();
        }
    }
}
