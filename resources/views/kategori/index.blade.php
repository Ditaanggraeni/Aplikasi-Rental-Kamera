@extends('layouts.app')

@section('title', 'Kategori Kamera')

@section('content')
<a href="/kategori/create" class="card-link btn-primary">Tambah Kategori</a>
@foreach ($kategori as $kategoris)

<div class="card" style="width: 18rem;">
  <div class="card-body">
    <a href = "/kategori/kamera{{$kategoris['id']}}" class="card-title">{{ $kategoris['name'] }}</a>
    <p class="card-text">{{ $kategoris['description'] }}</p>
      <hr>
        <a href="" class="card-link btn-primary">Tambah Data Kamera</a>
          @foreach ($kategoris->kamera as $kameras)
            <li> {{$kameras->merk}} </li>
          @endforeach

      <hr>
    <a href="/kategori/{{$kategoris['id']}}/edit" class="card-link btn-warning">Edit Kategori</a>
    <form action="/kategori/{{$kategoris['id']}}" method="POST">
      @csrf 
      @method('DELETE')
      <button class="card-link btn-danger">Delete Kategori</button>
    </form>
  </div>
</div>
@endforeach
<div>
    {{ $kategori->links() }}
    </div>
@endsection