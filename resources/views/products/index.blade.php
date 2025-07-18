@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    {{-- Header Section --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1 fw-semibold text-dark">Daftar Produk</h1>
            <p class="text-muted mb-0">Kelola dan lihat semua produk yang tersedia</p>
        </div>
        
        @if (auth()->user()->is_admin)
            <a href="{{ route('products.create') }}" 
               class="btn btn-primary d-flex align-items-center gap-2"
               style="padding: 10px 20px; border-radius: 8px; font-weight: 500;">
                <i class="fas fa-plus" style="font-size: 14px;"></i>
                Tambah Produk
            </a>
        @endif
    </div>

    {{-- Success Alert --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" 
             style="border: none; border-radius: 10px; background-color: #d1f2eb; color: #0c5460;">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Products Table --}}
    <div class="card border-0 shadow-sm" style="border-radius: 12px;">
        <div class="card-header bg-white border-bottom" 
             style="padding: 20px 24px; border-radius: 12px 12px 0 0;">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-semibold text-dark">
                    Katalog Produk ({{ $products->count() }} produk)
                </h6>
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-secondary btn-sm" 
                            style="border-radius: 6px; padding: 6px 12px;">
                        <i class="fas fa-filter me-1"></i>Filter
                    </button>
                    <button class="btn btn-outline-secondary btn-sm" 
                            style="border-radius: 6px; padding: 6px 12px;">
                        <i class="fas fa-download me-1"></i>Export
                    </button>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            @forelse ($products as $product)
                <div class="border-bottom product-row" 
                     style="padding: 20px 24px; transition: background-color 0.2s ease;"
                     onmouseover="this.style.backgroundColor='#f8f9fa'"
                     onmouseout="this.style.backgroundColor='transparent'">
                    
                    <div class="row align-items-center">
                        {{-- Product Info --}}
                        <div class="col-lg-5 col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="product-avatar me-3 d-flex align-items-center justify-content-center"
                                     style="width: 48px; height: 48px; 
                                            background-color: #e3f2fd; 
                                            border-radius: 8px; 
                                            color: #1976d2;">
                                    <i class="fas fa-box" style="font-size: 18px;"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1 fw-semibold text-dark" style="font-size: 15px;">
                                        {{ $product->name }}
                                    </h6>
                                    <span class="text-muted small">ID: #{{ str_pad($product->id, 4, '0', STR_PAD_LEFT) }}</span>
                                </div>
                            </div>
                        </div>

                        {{-- Price --}}
                        <div class="col-lg-2 col-md-3 col-6">
                            <div class="text-start text-md-center">
                                <span class="fw-semibold text-dark" style="font-size: 15px;">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>

                        {{-- Stock --}}
                        <div class="col-lg-2 col-md-3 col-6">
                            <div class="text-start text-md-center">
                                @if($product->stock > 10)
                                    <span class="badge bg-success-subtle text-success" 
                                          style="padding: 6px 12px; border-radius: 6px; font-weight: 500;">
                                        {{ $product->stock }} unit
                                    </span>
                                @elseif($product->stock > 0)
                                    <span class="badge bg-warning-subtle text-warning" 
                                          style="padding: 6px 12px; border-radius: 6px; font-weight: 500;">
                                        {{ $product->stock }} unit
                                    </span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger" 
                                          style="padding: 6px 12px; border-radius: 6px; font-weight: 500;">
                                        Habis
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- Actions --}}
                        <div class="col-lg-3 col-12">
                            <div class="d-flex justify-content-end gap-2 mt-2 mt-lg-0">
                                @if (auth()->user()->is_admin)
                                    {{-- Admin Actions --}}
                                    <a href="{{ route('products.show', $product->id) }}" 
                                       class="btn btn-outline-primary btn-sm"
                                       style="border-radius: 6px; padding: 6px 12px; font-size: 13px;">
                                        <i class="fas fa-eye me-1"></i>Lihat
                                    </a>
                                    
                                    <a href="{{ route('products.edit', $product->id) }}" 
                                       class="btn btn-outline-warning btn-sm"
                                       style="border-radius: 6px; padding: 6px 12px; font-size: 13px;">
                                        <i class="fas fa-edit me-1"></i>Edit
                                    </a>
                                    
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-outline-danger btn-sm"
                                                style="border-radius: 6px; padding: 6px 12px; font-size: 13px;"
                                                onclick="return confirm('Yakin ingin menghapus produk ini?')">
                                            <i class="fas fa-trash me-1"></i>Hapus
                                        </button>
                                    </form>
                                @else
                                    {{-- Customer Actions --}}
                                    <form action="{{ route('wishlist.store', $product->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" 
                                                class="btn btn-outline-secondary btn-sm"
                                                style="border-radius: 6px; padding: 6px 12px; font-size: 13px;">
                                            <i class="fas fa-heart me-1"></i>Wishlist
                                        </button>
                                    </form>
                                    
                                    <form action="{{ route('orders.store') }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button type="submit" 
                                                class="btn btn-primary btn-sm"
                                                style="border-radius: 6px; padding: 6px 12px; font-size: 13px;"
                                                {{ $product->stock <= 0 ? 'disabled' : '' }}>
                                            <i class="fas fa-shopping-cart me-1"></i>
                                            {{ $product->stock <= 0 ? 'Habis' : 'Pesan' }}
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                {{-- Empty State --}}
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-box-open text-muted" style="font-size: 4rem; opacity: 0.3;"></i>
                    </div>
                    <h5 class="text-muted mb-2">Belum Ada Produk</h5>
                    <p class="text-muted mb-4">Produk yang ditambahkan akan muncul di sini.</p>
                    @if (auth()->user()->is_admin)
                        <a href="{{ route('products.create') }}" 
                           class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Tambah Produk Pertama
                        </a>
                    @endif
                </div>
            @endforelse
        </div>
    </div>

    {{-- Statistics Cards (Optional for Admin) --}}
    @if (auth()->user()->is_admin && $products->count() > 0)
        <div class="row mt-4">
            <div class="col-md-3">
                <div class="card border-0 shadow-sm" style="border-radius: 10px;">
                    <div class="card-body text-center py-4">
                        <i class="fas fa-box text-primary mb-2" style="font-size: 2rem;"></i>
                        <h4 class="fw-bold mb-1">{{ $products->count() }}</h4>
                        <p class="text-muted mb-0 small">Total Produk</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm" style="border-radius: 10px;">
                    <div class="card-body text-center py-4">
                        <i class="fas fa-check-circle text-success mb-2" style="font-size: 2rem;"></i>
                        <h4 class="fw-bold mb-1">{{ $products->where('stock', '>', 0)->count() }}</h4>
                        <p class="text-muted mb-0 small">Tersedia</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm" style="border-radius: 10px;">
                    <div class="card-body text-center py-4">
                        <i class="fas fa-exclamation-triangle text-warning mb-2" style="font-size: 2rem;"></i>
                        <h4 class="fw-bold mb-1">{{ $products->where('stock', '<=', 10)->where('stock', '>', 0)->count() }}</h4>
                        <p class="text-muted mb-0 small">Stok Rendah</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm" style="border-radius: 10px;">
                    <div class="card-body text-center py-4">
                        <i class="fas fa-times-circle text-danger mb-2" style="font-size: 2rem;"></i>
                        <h4 class="fw-bold mb-1">{{ $products->where('stock', 0)->count() }}</h4>
                        <p class="text-muted mb-0 small">Habis</p>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

{{-- Professional Styles --}}
<style>
    .product-row {
        transition: all 0.2s ease;
    }
    
    .product-avatar {
        transition: all 0.2s ease;
    }
    
    .product-row:hover .product-avatar {
        background-color: #bbdefb !important;
    }
    
    .btn {
        font-weight: 500;
        transition: all 0.2s ease;
    }
    
    .btn:hover {
        transform: translateY(-1px);
    }
    
    .badge {
        font-size: 12px;
        font-weight: 500;
    }
    
    .card {
        transition: all 0.2s ease;
    }
    
    .text-success { color: #198754 !important; }
    .text-warning { color: #fd7e14 !important; }
    .text-danger { color: #dc3545 !important; }
    
    .bg-success-subtle { background-color: #d1f2eb !important; }
    .bg-warning-subtle { background-color: #fff3cd !important; }
    .bg-danger-subtle { background-color: #f8d7da !important; }
    
    @media (max-width: 768px) {
        .product-row {
            padding: 16px 20px !important;
        }
        
        .product-row .row > div {
            margin-bottom: 8px;
        }
        
        .product-row .d-flex.gap-2 {
            justify-content: start !important;
        }
        
        .card-header {
            padding: 16px 20px !important;
        }
    }
    
    /* Loading state for buttons */
    .btn.loading {
        pointer-events: none;
        opacity: 0.7;
    }
    
    .btn.loading::after {
        content: '';
        display: inline-block;
        width: 12px;
        height: 12px;
        margin-left: 8px;
        border: 2px solid currentColor;
        border-radius: 50%;
        border-top-color: transparent;
        animation: spin 0.8s linear infinite;
    }
    
    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }
</style>

{{-- Professional JavaScript --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add loading state to form buttons
    const formButtons = document.querySelectorAll('form button[type="submit"]');
    formButtons.forEach(button => {
        button.addEventListener('click', function() {
            if (!this.disabled) {
                this.classList.add('loading');
                
                // Remove loading state after 3 seconds (fallback)
                setTimeout(() => {
                    this.classList.remove('loading');
                }, 3000);
            }
        });
    });
    
    // Smooth scroll for any anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // Auto-hide alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 5000);
    });
});
</script>
@endsection