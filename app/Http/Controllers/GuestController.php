<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class GuestController extends Controller
{
    function home(){
        $terbaru = Product::orderBy('updated_at', 'asc')->limit(4)->get();
        $terlaris = Product::limit(4)->get();
        $categories = Category::get();
        return view('home',  compact('categories', 'terbaru', 'terlaris'));
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
                session()->flash('success', 'Tawaran kunjungan Anda berhasil dikirimkan');
            });
        } catch (\Throwable $th) {
            session()->flash('error', 'Tawaran kunjungan Anda gagal dikirimkan');
        }
        return redirect()->to('kontak');
    }
}
