@extends('layouts.app')

@section('title', 'Pesanan Saya - HugoFPW')

@section('content')
<div class="container-fluid">
    {{-- Header Section --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1 fw-semibold text-dark">Riwayat Pesanan</h1>
            <p class="text-muted mb-0">Kelola dan lacak semua pesanan Anda</p>
        </div>
        <div class="d-flex gap-2">
            <div class="dropdown">
                <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="fas fa-filter me-1"></i>Filter Status
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#" onclick="filterOrders('all')">Semua</a></li>
                    <li><a class="dropdown-item" href="#" onclick="filterOrders('pending')">Pending</a></li>
                    <li><a class="dropdown-item" href="#" onclick="filterOrders('processing')">Processing</a></li>
                    <li><a class="dropdown-item" href="#" onclick="filterOrders('completed')">Completed</a></li>
                </ul>
            </div>
            <button class="btn btn-outline-secondary btn-sm" onclick="exportOrders()">
                <i class="fas fa-download me-1"></i>Export
            </button>
        </div>
    </div>

    {{-- Orders List --}}
    @forelse ($orders as $order)
        <div class="card border-0 shadow-sm mb-4 order-card" style="border-radius: 12px; transition: all 0.2s ease;"
             onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.1)'"
             onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 1px 3px rgba(0,0,0,0.1)'">
            
            {{-- Order Header --}}
            <div class="card-header border-0 bg-white" style="padding: 20px 24px; border-radius: 12px 12px 0 0;">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <div class="order-icon me-3"
                                 style="width: 48px; height: 48px; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white;">
                                <i class="fas fa-shopping-bag" style="font-size: 20px;"></i>
                            </div>
                            <div>
                                <h6 class="mb-1 fw-semibold text-dark">Pesanan #{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</h6>
                                <p class="text-muted small mb-0">
                                    <i class="fas fa-calendar me-1"></i>
                                    {{ $order->created_at->format('d M Y, H:i') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 text-center">
                        <div class="total-price">
                            <p class="text-muted small mb-1">Total Pembayaran</p>
                            <h5 class="mb-0 fw-bold text-dark">Rp {{ number_format($order->total_price, 0, ',', '.') }}</h5>
                        </div>
                    </div>
                    <div class="col-md-3 text-end">
                        @php
                            $statusConfig = [
                                'pending' => ['class' => 'bg-warning-subtle text-warning', 'icon' => 'clock', 'text' => 'Menunggu'],
                                'processing' => ['class' => 'bg-info-subtle text-info', 'icon' => 'cog', 'text' => 'Diproses'],
                                'completed' => ['class' => 'bg-success-subtle text-success', 'icon' => 'check-circle', 'text' => 'Selesai'],
                                'cancelled' => ['class' => 'bg-danger-subtle text-danger', 'icon' => 'times-circle', 'text' => 'Dibatalkan']
                            ];
                            $status = $statusConfig[$order->status] ?? ['class' => 'bg-secondary-subtle text-secondary', 'icon' => 'question', 'text' => ucfirst($order->status)];
                        @endphp
                        <span class="badge {{ $status['class'] }}" style="padding: 8px 16px; border-radius: 8px; font-size: 12px; font-weight: 500;">
                            <i class="fas fa-{{ $status['icon'] }} me-1"></i>{{ $status['text'] }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- Order Items --}}
            <div class="card-body" style="padding: 0 24px 20px 24px;">
                <div class="order-items">
                    <h6 class="mb-3 fw-semibold text-dark">Detail Pesanan</h6>
                    @foreach ($order->items as $item)
                        <div class="order-item-row d-flex align-items-center justify-content-between py-3 border-bottom">
                            <div class="d-flex align-items-center">
                                <div class="item-image me-3"
                                     style="width: 50px; height: 50px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white;">
                                    <i class="fas fa-box" style="font-size: 16px;"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1 fw-semibold text-dark" style="font-size: 14px;">{{ $item->product->name }}</h6>
                                    <p class="text-muted small mb-0">
                                        Qty: {{ $item->quantity }} × Rp {{ number_format($item->price, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                            <div class="item-total">
                                <span class="fw-semibold text-dark">
                                    Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Order Actions --}}
                <div class="order-actions mt-4 pt-3 border-top">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="order-tracking">
                            @if($order->status !== 'cancelled')
                                <button class="btn btn-outline-primary btn-sm" onclick="trackOrder({{ $order->id }})">
                                    <i class="fas fa-truck me-1"></i>Lacak Pesanan
                                </button>
                            @endif
                        </div>
                        <div class="order-controls d-flex gap-2">
                            @if($order->status === 'pending')
                                <button class="btn btn-outline-danger btn-sm" onclick="cancelOrder({{ $order->id }})">
                                    <i class="fas fa-times me-1"></i>Batalkan
                                </button>
                            @endif
                            @if($order->status === 'completed')
                                <button class="btn btn-outline-secondary btn-sm" onclick="reorder({{ $order->id }})">
                                    <i class="fas fa-redo me-1"></i>Pesan Lagi
                                </button>
                                <button class="btn btn-outline-warning btn-sm" onclick="reviewOrder({{ $order->id }})">
                                    <i class="fas fa-star me-1"></i>Beri Ulasan
                                </button>
                            @endif
                            <button class="btn btn-outline-secondary btn-sm" onclick="downloadInvoice({{ $order->id }})">
                                <i class="fas fa-file-pdf me-1"></i>Invoice
                            </button>
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
                     style="width: 120px; height: 120px; background: linear-gradient(135deg, rgba(245, 158, 11, 0.1) 0%, rgba(217, 119, 6, 0.1) 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-shopping-bag" style="font-size: 3rem; color: #f59e0b; opacity: 0.7;"></i>
                </div>
                <h4 class="text-muted mb-3">Belum Ada Pesanan</h4>
                <p class="text-muted mb-4">Anda belum memiliki riwayat pesanan.<br>Mulai berbelanja dan buat pesanan pertama Anda!</p>
                <a href="{{ route('products.index') }}" class="btn btn-primary"
                   style="border-radius: 8px; padding: 12px 24px; font-weight: 500;">
                    <i class="fas fa-shopping-cart me-2"></i>Mulai Berbelanja
                </a>
            </div>
        </div>
    @endforelse

    {{-- Order Statistics --}}
    @if($orders->count() > 0)
        <div class="row mt-4">
            <div class="col-md-3">
                <div class="card border-0 shadow-sm text-center" style="border-radius: 10px;">
                    <div class="card-body py-4">
                        <i class="fas fa-shopping-bag text-primary mb-2" style="font-size: 2rem;"></i>
                        <h4 class="fw-bold mb-1">{{ $orders->count() }}</h4>
                        <p class="text-muted mb-0 small">Total Pesanan</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm text-center" style="border-radius: 10px;">
                    <div class="card-body py-4">
                        <i class="fas fa-check-circle text-success mb-2" style="font-size: 2rem;"></i>
                        <h4 class="fw-bold mb-1">{{ $orders->where('status', 'completed')->count() }}</h4>
                        <p class="text-muted mb-0 small">Selesai</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm text-center" style="border-radius: 10px;">
                    <div class="card-body py-4">
                        <i class="fas fa-clock text-warning mb-2" style="font-size: 2rem;"></i>
                        <h4 class="fw-bold mb-1">{{ $orders->where('status', 'pending')->count() }}</h4>
                        <p class="text-muted mb-0 small">Menunggu</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm text-center" style="border-radius: 10px;">
                    <div class="card-body py-4">
                        <i class="fas fa-chart-line text-info mb-2" style="font-size: 2rem;"></i>
                        <h4 class="fw-bold mb-1">Rp {{ number_format($orders->sum('total_price'), 0, ',', '.') }}</h4>
                        <p class="text-muted mb-0 small">Total Belanja</p>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

{{-- Custom Styles --}}
<style>
    .order-card {
        position: relative;
        overflow: hidden;
    }
    
    .order-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        opacity: 0;
        transition: opacity 0.2s ease;
    }
    
    .order-card:hover::before {
        opacity: 1;
    }
    
    .order-item-row:last-child {
        border-bottom: none !important;
    }
    
    .badge {
        font-weight: 500;
    }
    
    .bg-warning-subtle { background-color: #fff3cd !important; }
    .bg-info-subtle { background-color: #cff4fc !important; }
    .bg-success-subtle { background-color: #d1f2eb !important; }
    .bg-danger-subtle { background-color: #f8d7da !important; }
    .bg-secondary-subtle { background-color: #e9ecef !important; }
    
    .text-warning { color: #fd7e14 !important; }
    .text-info { color: #0dcaf0 !important; }
    .text-success { color: #198754 !important; }
    .text-danger { color: #dc3545 !important; }
    .text-secondary { color: #6c757d !important; }
</style>

{{-- JavaScript --}}
<script>
function filterOrders(status) {
    console.log('Filtering orders by status:', status);
    // Implement filter functionality
}

function exportOrders() {
    console.log('Exporting orders');
    // Implement export functionality
}

function trackOrder(orderId) {
    alert('Fitur pelacakan pesanan untuk Order #' + orderId);
    // Implement order tracking
}

function cancelOrder(orderId) {
    if (confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')) {
        console.log('Cancelling order:', orderId);
        // Implement cancel order functionality
    }
}

function reorder(orderId) {
    if (confirm('Pesan ulang produk yang sama?')) {
        console.log('Reordering:', orderId);
        // Implement reorder functionality
    }
}

function reviewOrder(orderId) {
    console.log('Opening review modal for order:', orderId);
    // Implement review functionality
}

function downloadInvoice(orderId) {
    console.log('Downloading invoice for order:', orderId);
    // Implement invoice download
}
</script>
@endsection