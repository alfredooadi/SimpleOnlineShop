<?php

namespace App\Http\Controllers;
use App\Barang;
use App\Pesanan;
use App\PesananDetail;
use App\User;
use Auth;
use Alert;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PesanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id) 
    {
        $barang = Barang::where('id', $id)->first();

        return view('pesan.index', compact('barang'));
    }

    public function pesan(Request $request, $id)
    {   
        $barang = Barang::where('id', $id)->first();
        $tanggal = Carbon::now();

        //validasi stok
        if($request->jumlah_pesan > $barang->stok_barang)
        {
            return redirect('pesan/' .$id);
        }

        //cek validasi
        $cek_pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status',0)->first();
        //simpan ke database pesanan
        if(empty($cek_pesanan))
        {
            $pesanan = new Pesanan;
            $pesanan->user_id = Auth::user()->id;
            $pesanan->tanggal = $tanggal;
            $pesanan->status = 0;
            $pesanan->kode = mt_rand(10, 99);
            $pesanan->jumlah_harga = 0;
            $pesanan->save();
        }

        //simpan ke database pesanandetail
        $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status',0)->first();

        //cek pesanan detail
        $cek_pesanan_detail = PesananDetail::where('barang_id' , $barang->id)->where('pesanan_id' , $pesanan_baru->id)->first();
        if(empty($cek_pesanan_detail))
        {
            $pesanan_detail = new PesananDetail;
            $pesanan_detail->barang_id = $barang->id;
            $pesanan_detail->pesanan_id = $pesanan_baru->id;
            $pesanan_detail->jumlah = $request->jumlah_pesan;
            $pesanan_detail->jumlah_harga = $barang->harga_barang*$request->jumlah_pesan;
            $pesanan_detail->save();
        }else{
            $pesanan_detail = PesananDetail::where('barang_id' , $barang->id)->where('pesanan_id' ,$pesanan_baru->id)->first();

            $pesanan_detail->jumlah = $pesanan_detail->jumlah+$request->jumlah_pesan;
            
            //harga sekarang
            $harga_pesanan_detail_baru = $barang->harga_barang*$request->jumlah_pesan;
            $pesanan_detail->jumlah_harga = $pesanan_detail->jumlah_harga+$harga_pesanan_detail_baru;
            $pesanan_detail->update();
        }

    
        //jumlah total
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status',0)->first();
        $pesanan->jumlah_harga = $pesanan->jumlah_harga+$barang->harga_barang*$request->jumlah_pesan;
        $pesanan->update();

        alert()->success('Pesanan Berhasil Masuk Keranjang', 'Success');

        return redirect('checkout');
    }

    public function checkout()
    {
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status',0)->first();
        
        if(!empty($pesanan))
        {
            $pesanan_details = PesananDetail::where('pesanan_id', $pesanan->id)->get();
        }

        return view('pesan.checkout', compact('pesanan', 'pesanan_details'));
    }

    public function delete($id) 
    {
        $pesanan_detail = PesananDetail::where('id', $id)->first(); 

        $pesanan = Pesanan::where('id', $pesanan_detail->pesanan_id)->first();
        $pesanan->jumlah_harga=$pesanan->jumlah_harga-$pesanan_detail->jumlah_harga;
        $pesanan->update();

        $pesanan_detail->delete();

        alert()->warning('Pesanan Berhasil Dihapus Dari Keranjang', 'Delete');

        return redirect('checkout');
    }

    public function confirm() 
    {
        //validasi alamat
        $user = User::where('id', Auth::user()->id)->first();

        if(empty($user->alamat))
        {
            alert()->warning('Harap Lengkapi Profile Anda !', 'Error');

            return redirect('profile');
        }


        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status',0)->first();
        $pesanan_id = $pesanan->id;
        $pesanan->status = 1;
        $pesanan->update();

        alert()->success('Pesanan Berhasil Dipesan Silahkan Transfer', 'Thankyou !!!');

        $pesanan_details = PesananDetail::where('pesanan_id', $pesanan_id)->get();

        foreach($pesanan_details as $pesanan_detail)
        {
            $barang = Barang::where('id', $pesanan_detail->barang_id)->first();
            $barang->stok_barang = $barang->stok_barang-$pesanan_detail->jumlah;
            $barang->update();
        }

        return redirect('history/' .$pesanan_id);

    }
}
