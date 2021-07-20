@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="{{ url('history') }}" class="btn btn-primary"> <i class="bi bi-arrow-left"></i> Kembali</a>
        </div>
        
        <div class="col-md-12 mt-3">
        <nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ url('history') }}">Order History</a></li>
        <li class="breadcrumb-item active" aria-current="page">Order Detail</li>
        </ol>
        </div>
        </nav>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3><i class="bi bi-credit-card"></i> Transfer</h3>
                </div>
                    <div class="card-body">
                        <h5>Pembayaran sebesar : <strong>Rp. {{ number_format($pesanan->jumlah_harga+$pesanan->kode)}}</strong> dilakukan melalui transfer ke rek <strong> BCA : 1122334455 A/n Alfredo Adiyasa </strong></h5>
                    </div>
            </div>
            <div class="card mt-3">
                <div class="card-header">
                    <h3><i class="bi bi-cart-fill"></i> Order Detail</h3>
                    @if(!empty($pesanan))
                </div>
                <div class="card-body">
                    <p align="right">Order Date : {{ $pesanan->tanggal }}</p>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Total Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($pesanan_details as $pesanan_detail)
                            <tr>
                                <td>{{ $no++}}</td>
                                <td>
                                <img src="{{ url('upload') }}/{{ $pesanan_detail->barang->gambar_barang }}" width="150" alt="...">
                                </td>
                                <td>{{ $pesanan_detail->barang->nama_barang }}</td>
                                <td>{{ $pesanan_detail->jumlah }} pcs</td>
                                <td align="left"> Rp. {{ number_format($pesanan_detail->barang->harga_barang) }}</td>
                                <td align="left">Rp. {{ number_format($pesanan_detail->jumlah_harga) }}</td>
                            </tr>
                            @endforeach
                            
                            <tr>
                                <td colspan="5" align="center"><h4><strong>Jumlah : </strong></h4></td>
                                <td><h4><strong>Rp. {{ number_format($pesanan->jumlah_harga) }}</strong></h4></td>
                                
                            </tr>
                            
                            <tr>
                                <td colspan="5" align="center"><h4><strong>Kode Unik : </strong></h4></td>
                                <td><h4><strong>Rp. {{ number_format($pesanan->kode) }}</strong></h4></td>
                                
                            </tr>
                            
                            <tr>
                                <td colspan="5" align="center"><h4><strong>Total : </strong></h4></td>
                                <td><h4><strong>Rp. {{ number_format($pesanan->jumlah_harga+$pesanan->kode) }}</strong></h4></td>
                                
                            </tr>
                        </tbody>
                    </table>
                    @endif
                </div>

            </div>

        </div>
        
        
    </div>
</div>
@endsection
