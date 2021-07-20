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
        <li class="breadcrumb-item active" aria-current="page">Check Out</li>
        </ol>
        </div>
        </nav>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3><i class="bi bi-cart-fill"></i> Check Out</h3>
                    @if(!empty($pesanan))
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Total Harga</th>
                                <th>Ubah</th>
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
                                <td>
                                    <form action="{{ url('checkout') }}/{{ $pesanan_detail->id }}" method="post">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus barang ?')">
                                        <i class="bi bi-trash"></i></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="5" align="right"><h4><strong>Jumlah : </strong></h4></td>
                                <td align="right"><h4><strong>Rp. {{ number_format($pesanan->jumlah_harga) }}</strong></h4></td>
                                <td>
                                    <a href="{{ url('konfirmasi') }}" class="btn btn-warning" onclick="return confirm('Anda yakin ingin Check Out ?')">
                                         <i class="bi bi-cart-fill"></i> Check Out
                                    </a>
                                </td>
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
