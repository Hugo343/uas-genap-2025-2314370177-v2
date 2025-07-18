@extends('layouts.app')

@section('title', 'Wishlist - HugoFPW')

@section('content')
<div class="container-fluid">
    {{-- Header Section --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1 fw-semibold text-dark">Wishlist Saya</h1>
            <p class="text-muted mb-0">Produk favorit yang ingin Anda beli nanti</p>
        </div>
        <div class="d-flex gap-2">
            @if($favorites->count() > 0)
                <button class="btn btn-outline-secondary btn-sm" onclick="clearAllWishlist()">
                    <i class="fas fa-trash me-1"></i>Hapus Semua
                </button>
                <button class="btn btn-primary btn-sm" onclick="addAllToCart()">
                    <i class="fas fa-shopping-cart me-1"></i>Tambah ke Keranjang
                </button>
            @endif
        </div>
    </div>

    {{-- Wishlist Content --}}
    @forelse($favorites as $item)
        <div class="card border-0 shadow-sm mb-3 wishlist-item" style="border-radius: 12px; transition: all 0.2s ease;"
             onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.1)'"
             onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 1px 3px rgba(0,0,0,0.1)'">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    {{-- Product Image & Info --}}
                    <div class="col-lg-6 col-md-7">
                        <div class="d-flex align-items-center">
                            <div class="product-image me-4">
                                <div class="image-placeholder d-flex align-items-center justify-content-center"
                                     style="width: 80px; height: 80px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 12px; color: white;">
                                    <i class="fas fa-box" style="font-size: 24px;"></i>
                                </div>
                            </div>
                            <div class="product-info">
                                <h5 class="mb-2 fw-semibold text-dark">{{ $item->product->name }}</h5>
                                <div class="d-flex align-items-center gap-3 mb-2">
                                    <span class="price fw-bold text-primary" style="font-size: 1.1rem;">
                                        Rp {{ number_format($item->product->price, 0, ',', '.') }}
                                    </span>
                                    @if($item->product->stock > 0)
                                        <span class="badge bg-success-subtle text-success">
                                            <i class="fas fa-check me-1"></i>Tersedia
                                        </span>
                                    @else
                                        <span class="badge bg-danger-subtle text-danger">
                                            <i class="fas fa-times me-1"></i>Habis
                                        </span>
                                    @endif
                                </div>
                                <p class="text-muted small mb-0">
                                    <i class="fas fa-heart me-1 text-danger"></i>
                                    Ditambahkan {{ $item->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Stock Info --}}
                    <div class="col-lg-2 col-md-2 col-6 text-center">
                        <div class="stock-info">
                            <p class="text-muted small mb-1">Stok Tersedia</p>
                            <span class="fw-semibold {{ $item->product->stock > 10 ? 'text-success' : ($item->product->stock > 0 ? 'text-warning' : 'text-danger') }}">
                                {{ $item->product->stock }} unit
                            </span>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="col-lg-4 col-md-3 col-6">
                        <div class="d-flex justify-content-end gap-2 flex-wrap">
                            {{-- Add to Cart Button --}}
                            @if($item->product->stock > 0)
                                <form action="{{ route('orders.store') }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                                    <button type="submit" class="btn btn-primary btn-sm"
                                            style="border-radius: 8px; padding: 8px 16px; font-weight: 500;">
                                        <i class="fas fa-shopping-cart me-1"></i>Pesan
                                    </button>
                                </form>
                            @else
                                <button class="btn btn-secondary btn-sm" disabled
                                        style="border-radius: 8px; padding: 8px 16px; font-weight: 500;">
                                    <i class="fas fa-ban me-1"></i>Habis
                                </button>
                            @endif

                            {{-- Remove from Wishlist --}}
                            <form action="{{ route('wishlist.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm"
                                        style="border-radius: 8px; padding: 8px 16px; font-weight: 500;"
                                        onclick="return confirm('Hapus dari wishlist?')">
                                    <i class="fas fa-heart-broken me-1"></i>Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        {{-- Empty State --}}
        <div class="text-center py-5">
            <div class="empty-state-container">
                <div class="empty-icon mb-4 mx-auto"
                     style="width: 120px; height: 120px; background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-heart" style="font-size: 3rem; color: #667eea; opacity: 0.7;"></i>
                </div>
                <h4 class="text-muted mb-3">Wishlist Masih Kosong</h4>
                <p class="text-muted mb-4">Belum ada produk yang ditambahkan ke wishlist Anda.<br>Mulai jelajahi produk dan tambahkan yang Anda sukai!</p>
                <a href="{{ route('products.index') }}" class="btn btn-primary"
                   style="border-radius: 8px; padding: 12px 24px; font-weight: 500;">
                    <i class="fas fa-shopping-bag me-2"></i>Jelajahi Produk
                </a>
            </div>
        </div>
    @endforelse

    {{-- Wishlist Summary --}}
    @if($favorites->count() > 0)
        <div class="card border-0 shadow-sm mt-4" style="border-radius: 12px; background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h6 class="mb-1 fw-semibold text-dark">Total Wishlist</h6>
                        <p class="text-muted mb-0">
                            {{ $favorites->count() }} produk dengan total nilai 
                            <span class="fw-semibold text-primary">
                                Rp {{ number_format($favorites->sum(function($item) { return $item->product->price; }), 0, ',', '.') }}
                            </span>
                        </p>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <button class="btn btn-outline-primary" onclick="shareWishlist()">
                            <i class="fas fa-share me-1"></i>Bagikan Wishlist
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

{{-- Custom Styles --}}
<style>
    .wishlist-item {
        position: relative;
        overflow: hidden;
    }
    
    .wishlist-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        opacity: 0;
        transition: opacity 0.2s ease;
    }
    
    .wishlist-item:hover::before {
        opacity: 1;
    }
    
    .image-placeholder {
        position: relative;
        overflow: hidden;
    }
    
    .image-placeholder::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.3) 0%, transparent 70%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .wishlist-item:hover .image-placeholder::before {
        opacity: 1;
    }
    
    .btn {
        transition: all 0.2s ease;
    }
    
    .btn:hover {
        transform: translateY(-1px);
    }
    
    .bg-success-subtle { background-color: #d1f2eb !important; }
    .bg-danger-subtle { background-color: #f8d7da !important; }
    .text-success { color: #198754 !important; }
    .text-danger { color: #dc3545 !important; }
</style>

{{-- JavaScript --}}
<script>
function clearAllWishlist() {
    if (confirm('Apakah Anda yakin ingin menghapus semua item dari wishlist?')) {
        // Implement clear all functionality
        console.log('Clearing all wishlist items');
    }
}

function addAllToCart() {
    if (confirm('Tambahkan semua item wishlist ke keranjang?')) {
        // Implement add all to cart functionality
        console.log('Adding all items to cart');
    }
}

function shareWishlist() {
    if (navigator.share) {
        navigator.share({
            title: 'Wishlist Saya - HugoFPW',
            text: 'Lihat wishlist produk favorit saya!',
            url: window.location.href
        });
    } else {
        // Fallback: copy to clipboard
        navigator.clipboard.writeText(window.location.href);
        alert('Link wishlist telah disalin ke clipboard!');
    }
}
</script>
@endsection