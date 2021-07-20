@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="{{ url('home') }}" class="btn btn-primary"> <i class="bi bi-arrow-left"></i> Kembali</a>
        </div>
        
        <div class="col-md-12 mt-3">
        <nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $barang->nama_barang}}</li>
        </ol>
        </div>
        </nav>
        
        <div class="col-md-12 mt-3">
            <div class="card">
                <div class="card-header">
                    <h3>{{ $barang->nama_barang}}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5">
                            <img src="{{ url('upload') }}/{{ $barang->gambar_barang }}" width="450" alt="">
                        </div>

                        <div class="col-md-6 mt-3">
                            <h4>{{ $barang->nama_barang}}</h4>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Harga</td>
                                        <td>: </td>
                                        <td>Rp. {{ number_format($barang->harga_barang) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Stok</td>
                                        <td>: </td>
                                        <td>{{ $barang->stok_barang }}</td>
                                    </tr>
                                    <tr>
                                        <td>Keterangan</td>
                                        <td>: </td>
                                        <td> {{ $barang->keterangan_barang }}</td>
                                    </tr>
                                    <tr>
                                        <td>Jumlah Pesan</td>
                                        <td>:</td>
                                        <td>
                                            <form action="{{ url('pesan') }}/{{ $barang->id }}" method="post">
                                            @csrf
                                            <input type="text" name="jumlah_pesan" class="form-control" required="">
                                            <button type="submit" class="btn btn-warning mt-3"><i class="bi bi-cart3"></i> Masukkan Keranjang</button>
                                            </form>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
