@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <!-- Header -->
        <div class="mb-5">
            <img src="{{ url('asset/header.jpg') }}" width="800"alt="">
        </div>
        @foreach($barangs as $barang)
        <div class="col-md-4 ">
            <div class="card " >
                <img src="{{ url('upload') }}/{{ $barang->gambar_barang }}" class="card-img-top" alt="...">
                <div class="card-body">
                <h5 class="card-title">{{ $barang->nama_barang }}</h5>
                <p class="card-text">
                    <strong>Harga : </strong> Rp. {{ number_format($barang->harga_barang) }} <br>
                    <strong>Stok : </strong> {{ $barang->stok_barang }} <br>
                    <br>
                    <strong>Keterangan : </strong> {{ $barang->keterangan_barang }} <br>
                </p>
                <a href="{{ url('pesan') }}/{{ $barang->id }}" class="btn btn-primary"><i class="bi bi-cart3"></i> Pesan</a>
                </div>
            </div>
        </div>
        @endforeach
        <!-- Akhir Header -->
    </div>
</div>
@endsection
