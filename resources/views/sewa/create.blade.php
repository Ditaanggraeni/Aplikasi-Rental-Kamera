@extends('layouts.app')

@section('title', 'Tambah Data Sewa')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Data Sewa </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body style="background: violet">

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <form action="{{ route('sewa.store') }}" method="POST" enctype="multipart/form-data">
                        
                            @csrf

                            <div class="form-group">
                                <label class="font-weight-bold">GAMBAR</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                            
                                <!-- error message untuk merk -->
                                @error('image')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">MERK</label>
                                <input type="text" class="form-control @error('merk') is-invalid @enderror" name="merk" value="{{ old('merk') }}" placeholder="Masukkan Merk Kamera">
                            
                                <!-- error message untuk merk -->
                                @error('merk')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">HARGA</label>
                                <input type="text" class="form-control @error('harga') is-invalid @enderror" name="harga" value="{{ old('harga') }}" placeholder="Masukkan Harga Kamera">
                            
                                <!-- error message untuk harga -->
                                @error('harga')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">PENYEWA</label>
                                <input type="text" class="form-control @error('penyewa') is-invalid @enderror" name="penyewa" value="{{ old('penyewa') }}" placeholder="Masukkan Nama Penyewa">
                            
                                <!-- error message untuk penyewa -->
                                @error('penyewa')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">JAMINAN SEWA</label>
                                <input type="text" class="form-control @error('jaminan') is-invalid @enderror" name="jaminan" value="{{ old('jaminan') }}" placeholder="Masukkan Jaminan Sewa">
                            
                                <!-- error message untuk jaminan -->
                                @error('jaminan')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">TANGGAL SEWA</label>
                                <input type="date" class="form-control @error('tgl_sewa') is-invalid @enderror" name="tgl_sewa" value="{{ old('tgl_sewa') }}" placeholder="Masukkan Tanggal Sewa">
                            
                                <!-- error message untuk tgl_sewa -->
                                @error('tgl_sewa')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">TANGGAL KEMBALI</label>
                                <input type="date" class="form-control @error('tgl_kembali') is-invalid @enderror" name="tgl_kembali" value="{{ old('tgl_kembali') }}" placeholder="Masukkan Tanggal Pengembalian">
                            
                                <!-- error message untuk tgl_kembali -->
                                @error('tgl_kembali')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                    @enderror
                            </div>
                                    
                                    <div class="form-group">
                                <label class="font-weight-bold">DENDA</label>
                                <input type="text" class="form-control @error('denda') is-invalid @enderror" name="denda" value="{{ old('denda') }}" placeholder="Masukkan Jumlah Denda">
                            
                                <!-- error message untuk denda -->
                                @error('denda')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">TOTAL</label>
                                <input type="text" class="form-control @error('total') is-invalid @enderror" name="total" value="{{ old('total') }}" placeholder="Masukkan Total Bayar">
                            
                                <!-- error message untuk total -->
                                @error('total')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>

                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
     
@endsection