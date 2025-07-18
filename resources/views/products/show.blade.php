@extends('layouts.app')

@section('title', 'Detail Produk')

@section('content')
    <h1>{{ $product->name }}</h1>
    <p><strong>Kategori:</strong> {{ $product->category->name }}</p>
    <p><strong>Harga:</strong> Rp {{ number_format($product->price) }}</p>
    <p><strong>Deskripsi:</strong> {{ $product->description }}</p>
    <p><strong>Status:</strong> {{ $product->is_publish ? 'Dipublish' : 'Belum' }}</p>

    <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
@endsection
