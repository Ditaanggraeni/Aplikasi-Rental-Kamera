@extends('layouts.app')

@section('title', 'Show')

@section('content')
<div class="card">
        <div class="card-body">
            <h3>Gambar Kamera : {{ $kameras['image'] }}</h3>
            <h3>Merk Kamera : {{ $kameras['merk'] }}</h3>
            <h3>Harga Sewa : {{ $kameras['harga']}}</h3>
     </div>
</div>
@endsection