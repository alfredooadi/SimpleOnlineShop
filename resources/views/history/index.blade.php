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
        <li class="breadcrumb-item active" aria-current="page">Order History</li>
        </ol>
        </div>
        </nav>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3><i class="bi bi-clock-history"></i> Order History</h3>
                </div>
                <div class="card-body">
                
                
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Jumlah Harga</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($pesanans as $pesanan)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{ $pesanan->tanggal }}</td>
                                <td>
                                    @if($pesanan->status == 1) 
                                    Pesanan belum dibayar
                                    @else
                                    Pesanan sudah dibayar
                                    @endif
                                </td>
                                <td>Rp. {{ number_format($pesanan->jumlah_harga+$pesanan->kode) }}</td>
                                <td>
                                    <a href="{{ url('history') }}/{{ $pesanan->id }}" class="btn btn-primary btn-sm"><i class="bi bi-info-circle"></i> Detail</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>

            </div>

        </div>
        
        
    </div>
</div>
@endsection
