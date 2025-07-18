@extends('layouts.app')

@section('title', 'Admin Dashboard - HugoFPW')

@section('content')
<div class="container-fluid">
    {{-- Header Section --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1 fw-semibold text-dark">Dashboard Admin</h1>
            <p class="text-muted mb-0">Selamat datang kembali, {{ Auth::user()->name }}</p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-secondary btn-sm" onclick="refreshDashboard()">
                <i class="fas fa-sync-alt me-1"></i>Refresh
            </button>
            <div class="dropdown">
                <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="fas fa-calendar me-1"></i>Periode
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#" onclick="changePeriod('today')">Hari Ini</a></li>
                    <li><a class="dropdown-item" href="#" onclick="changePeriod('week')">Minggu Ini</a></li>
                    <li><a class="dropdown-item" href="#" onclick="changePeriod('month')">Bulan Ini</a></li>
                </ul>
            </div>
        </div>
    </div>

    {{-- Statistics Cards --}}
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted mb-1 small fw-medium">TOTAL PENGGUNA</p>
                            <h3 class="mb-0 fw-bold text-dark">{{ number_format($userCount) }}</h3>
                            <div class="d-flex align-items-center mt-2">
                                <span class="badge bg-success-subtle text-success small">
                                    <i class="fas fa-arrow-up me-1"></i>+12%
                                </span>
                                <span class="text-muted small ms-2">vs bulan lalu</span>
                            </div>
                        </div>
                        <div class="stat-icon">
                            <div class="icon-wrapper" style="width: 56px; height: 56px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-users text-white" style="font-size: 24px;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted mb-1 small fw-medium">TOTAL PRODUK</p>
                            <h3 class="mb-0 fw-bold text-dark">{{ number_format($productCount) }}</h3>
                            <div class="d-flex align-items-center mt-2">
                                <span class="badge bg-info-subtle text-info small">
                                    <i class="fas fa-arrow-up me-1"></i>+5%
                                </span>
                                <span class="text-muted small ms-2">vs bulan lalu</span>
                            </div>
                        </div>
                        <div class="stat-icon">
                            <div class="icon-wrapper" style="width: 56px; height: 56px; background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-box text-white" style="font-size: 24px;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted mb-1 small fw-medium">TOTAL PESANAN</p>
                            <h3 class="mb-0 fw-bold text-dark">{{ number_format($orderCount) }}</h3>
                            <div class="d-flex align-items-center mt-2">
                                <span class="badge bg-warning-subtle text-warning small">
                                    <i class="fas fa-arrow-down me-1"></i>-3%
                                </span>
                                <span class="text-muted small ms-2">vs bulan lalu</span>
                            </div>
                        </div>
                        <div class="stat-icon">
                            <div class="icon-wrapper" style="width: 56px; height: 56px; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-shopping-cart text-white" style="font-size: 24px;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted mb-1 small fw-medium">TOTAL REVENUE</p>
                            <h3 class="mb-0 fw-bold text-dark">Rp {{ number_format($recentOrders->sum('total_price'), 0, ',', '.') }}</h3>
                            <div class="d-flex align-items-center mt-2">
                                <span class="badge bg-success-subtle text-success small">
                                    <i class="fas fa-arrow-up me-1"></i>+18%
                                </span>
                                <span class="text-muted small ms-2">vs bulan lalu</span>
                            </div>
                        </div>
                        <div class="stat-icon">
                            <div class="icon-wrapper" style="width: 56px; height: 56px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-chart-line text-white" style="font-size: 24px;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Charts Section --}}
    <div class="row mb-4">
        <div class="col-xl-8 mb-3">
            <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                <div class="card-header bg-white border-0" style="padding: 20px 24px; border-radius: 12px 12px 0 0;">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 fw-semibold text-dark">Grafik Penjualan</h6>
                        <div class="d-flex gap-2">
                            <button class="btn btn-outline-secondary btn-sm" onclick="changeChartType('line')">Line</button>
                            <button class="btn btn-outline-secondary btn-sm" onclick="changeChartType('bar')">Bar</button>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="padding: 0 24px 24px 24px;">
                    <canvas id="salesChart" height="300"></canvas>
                </div>
            </div>
        </div>

        <div class="col-xl-4 mb-3">
            <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                <div class="card-header bg-white border-0" style="padding: 20px 24px; border-radius: 12px 12px 0 0;">
                    <h6 class="mb-0 fw-semibold text-dark">Status Pesanan</h6>
                </div>
                <div class="card-body" style="padding: 0 24px 24px 24px;">
                    <canvas id="orderStatusChart" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- Data Tables Section --}}
    <div class="row">
        <div class="col-xl-6 mb-4">
            <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                <div class="card-header bg-white border-0" style="padding: 20px 24px; border-radius: 12px 12px 0 0;">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 fw-semibold text-dark">Produk Terbaru</h6>
                        <a href="{{ route('products.index') }}" class="btn btn-outline-primary btn-sm">
                            Lihat Semua
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    @forelse($recentProducts as $product)
                        <div class="border-bottom product-item" style="padding: 16px 24px; transition: background-color 0.2s ease;"
                             onmouseover="this.style.backgroundColor='#f8f9fa'"
                             onmouseout="this.style.backgroundColor='transparent'">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div class="product-avatar me-3"
                                         style="width: 40px; height: 40px; background-color: #e3f2fd; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #1976d2;">
                                        <i class="fas fa-box" style="font-size: 16px;"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1 fw-semibold text-dark" style="font-size: 14px;">{{ $product->name }}</h6>
                                        <div class="d-flex align-items-center gap-3">
                                            <span class="text-muted small">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                            <span class="badge {{ $product->stock > 10 ? 'bg-success-subtle text-success' : ($product->stock > 0 ? 'bg-warning-subtle text-warning' : 'bg-danger-subtle text-danger') }}" 
                                                  style="font-size: 11px;">
                                                Stok: {{ $product->stock }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    @if($product->is_publish ?? true)
                                        <span class="badge bg-success-subtle text-success small">Published</span>
                                    @else
                                        <span class="badge bg-secondary-subtle text-secondary small">Draft</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4">
                            <i class="fas fa-box-open text-muted mb-2" style="font-size: 2rem; opacity: 0.3;"></i>
                            <p class="text-muted mb-0">Belum ada produk</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-xl-6 mb-4">
            <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                <div class="card-header bg-white border-0" style="padding: 20px 24px; border-radius: 12px 12px 0 0;">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 fw-semibold text-dark">Pesanan Terbaru</h6>
                        <a href="{{ route('orders.index') }}" class="btn btn-outline-primary btn-sm">
                            Lihat Semua
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    @forelse($recentOrders as $order)
                        <div class="border-bottom order-item" style="padding: 16px 24px; transition: background-color 0.2s ease;"
                             onmouseover="this.style.backgroundColor='#f8f9fa'"
                             onmouseout="this.style.backgroundColor='transparent'">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div class="order-avatar me-3"
                                         style="width: 40px; height: 40px; background-color: #fff3e0; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #f57c00;">
                                        <i class="fas fa-shopping-bag" style="font-size: 16px;"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1 fw-semibold text-dark" style="font-size: 14px;">#{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</h6>
                                        <div class="d-flex align-items-center gap-3">
                                            <span class="text-muted small">{{ $order->user->name }}</span>
                                            <span class="fw-semibold text-dark small">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    @php
                                        $statusColors = [
                                            'pending' => 'bg-warning-subtle text-warning',
                                            'processing' => 'bg-info-subtle text-info',
                                            'completed' => 'bg-success-subtle text-success',
                                            'cancelled' => 'bg-danger-subtle text-danger'
                                        ];
                                        $statusColor = $statusColors[$order->status] ?? 'bg-secondary-subtle text-secondary';
                                    @endphp
                                    <span class="badge {{ $statusColor }} small">{{ ucfirst($order->status) }}</span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4">
                            <i class="fas fa-shopping-cart text-muted mb-2" style="font-size: 2rem; opacity: 0.3;"></i>
                            <p class="text-muted mb-0">Belum ada pesanan</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Chart.js CDN --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

{{-- Custom Styles --}}
<style>
    .stat-icon .icon-wrapper {
        transition: transform 0.2s ease;
    }
    
    .card:hover .stat-icon .icon-wrapper {
        transform: scale(1.05);
    }
    
    .product-item:last-child,
    .order-item:last-child {
        border-bottom: none !important;
    }
    
    .badge {
        font-size: 11px;
        font-weight: 500;
        padding: 4px 8px;
        border-radius: 4px;
    }
    
    .bg-success-subtle { background-color: #d1f2eb !important; }
    .bg-info-subtle { background-color: #cff4fc !important; }
    .bg-warning-subtle { background-color: #fff3cd !important; }
    .bg-danger-subtle { background-color: #f8d7da !important; }
    .bg-secondary-subtle { background-color: #e9ecef !important; }
    
    .text-success { color: #198754 !important; }
    .text-info { color: #0dcaf0 !important; }
    .text-warning { color: #fd7e14 !important; }
    .text-danger { color: #dc3545 !important; }
    .text-secondary { color: #6c757d !important; }
    
    canvas {
        max-height: 300px !important;
    }
</style>

{{-- Dashboard JavaScript --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Sales Chart
    const salesCtx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(salesCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
            datasets: [{
                label: 'Penjualan',
                data: [12, 19, 3, 5, 2, 3, 10],
                borderColor: '#667eea',
                backgroundColor: 'rgba(102, 126, 234, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    // Order Status Chart
    const orderStatusCtx = document.getElementById('orderStatusChart').getContext('2d');
    const orderStatusChart = new Chart(orderStatusCtx, {
        type: 'doughnut',
        data: {
            labels: ['Pending', 'Processing', 'Completed', 'Cancelled'],
            datasets: [{
                data: [30, 25, 35, 10],
                backgroundColor: [
                    '#b59050ff',
                    '#06b6d4',
                    '#10b981',
                    '#ef4444'
                ],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true
                    }
                }
            }
        }
    });

    // Global functions
    window.refreshDashboard = function() {
        location.reload();
    };

    window.changePeriod = function(period) {
        console.log('Changing period to:', period);
        // Implement period change logic here
    };

    window.changeChartType = function(type) {
        salesChart.config.type = type;
        salesChart.update();
        
        // Update button states
        document.querySelectorAll('[onclick*="changeChartType"]').forEach(btn => {
            btn.classList.remove('btn-primary');
            btn.classList.add('btn-outline-secondary');
        });
        event.target.classList.remove('btn-outline-secondary');
        event.target.classList.add('btn-primary');
    };
});
</script>
@endsection