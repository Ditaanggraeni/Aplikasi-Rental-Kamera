@extends('layouts.app')

@section('title', 'Data Sewa')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Sewa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<body style="background: #7fffd4">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-13">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <a href="{{ route('sewa.create') }}" class="btn btn-md btn-success mb-3">TAMBAH DATA SEWA</a>
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col">GAMBAR</th>
                                <th scope="col">MERK</th>
                                <th scope="col">HARGA</th>
                                <th scope="col">PENYEWA</th>
                                <th scope="col">JAMINAN</th>
                                <th scope="col">TANGGAL SEWA</th>
                                <th scope="col">TANGGAL KEMBALI</th>
                                <th scope="col">DENDA</th>
                                <th scope="col">TOTAL</th>
                                <th scope="col">AKSI</th>
                              </tr>
                            </thead>
                            <tbody>
                              @forelse ($sewa as $sewas)
                                <tr>
                                    <td class="text-center">
                                        <img src="{{ Storage::url('public/sewas/').$sewas->image }}" class="rounded" style="width: 150px">
                                    </td>
                                    <td>{{ $sewas->merk }}</td>
                                    <td>{!! $sewas->harga !!}</td>
                                    <td>{{ $sewas->penyewa }}</td>
                                    <td>{!! $sewas->jaminan !!}</td>
                                    <td>{{ $sewas->tgl_sewa }}</td>
                                    <td>{!! $sewas->tgl_kembali !!}</td>
                                    <td>{{ $sewas->denda }}</td>
                                    <td>{!! $sewas->total !!}</td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('sewa.destroy', $sewas->id) }}" method="POST">
                                            <a href="{{ route('sewa.edit', $sewas->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                        </form>
                                    </td>
                                </tr>
                              @empty
                                  <div class="alert alert-danger">
                                      Data Sewa Belum Tersedia.
                                  </div>
                              @endforelse
                            </tbody>
                          </table>  
                          {{ $sewa->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        //message with toastr
        @if(session()-> has('success'))
        
            toastr.success('{{ session('success') }}', 'BERHASIL!'); 

        @elseif(session()-> has('error'))

            toastr.error('{{ session('error') }}', 'GAGAL!'); 
            
        @endif
    </script>

</body>
</html>

     
@endsection