@extends('layouts.app')
@section('title', 'Danh sách Bất động sản')

@php
// Helper function format giá - CHỈ KHAI BÁO 1 LẦN
if (!function_exists('formatPrice')) {
    function formatPrice($price) {
        if ($price >= 1000000000) {
            return number_format($price / 1000000000, 1) . ' tỷ';
        } elseif ($price >= 1000000) {
            return number_format($price / 1000000) . ' triệu';
        }
        return number_format($price) . 'đ';
    }
}
@endphp

@section('content')
<!-- Breadcrumb -->
<div class="bg-light" style="padding: 12px 0; border-bottom: 1px solid var(--border);">
    <div class="container">
        <a href="{{ route('home') }}" style="color: var(--gray);">Trang chủ</a> 
        <span style="margin: 0 8px;">/</span> 
        <span style="color: var(--dark); font-weight: 500;">Bất động sản</span>
    </div>
</div>

<div class="container" style="padding: 30px 16px;">
    <div style="display: grid; grid-template-columns: 280px 1fr; gap: 24px;">
        
        <!-- Sidebar Filter -->
        <aside style="background: white; padding: 20px; border-radius: var(--radius); box-shadow: var(--shadow); height: fit-content;">
            <h3 style="color: var(--dark); margin-bottom: 16px; font-size: 18px;">🔍 Bộ lọc</h3>
            
            <form action="{{ route('properties.index') }}" method="GET">
                <!-- Vị trí -->
                <div class="form-group">
                    <label class="form-label">Vị trí</label>
                    <select name="location" class="form-control">
                        <option value="">Tất cả</option>
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}" {{ request('location') == $city->id ? 'selected' : '' }}>
                                {{ $city->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <!-- Loại BĐS -->
                <div class="form-group">
                    <label class="form-label">Loại hình</label>
                    <select name="type" class="form-control">
                        <option value="">Tất cả</option>
                        @foreach($types as $type)
                            <option value="{{ $type->id }}" {{ request('type') == $type->id ? 'selected' : '' }}>
                                {{ $type->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <!-- Giá min -->
                <div class="form-group">
                    <label class="form-label">Giá min</label>
                    <select name="min_price" class="form-control">
                        <option value="">Bất kỳ</option>
                        <option value="500000000" {{ request('min_price') == 500000000 ? 'selected' : '' }}>500 triệu</option>
                        <option value="1000000000" {{ request('min_price') == 1000000000 ? 'selected' : '' }}>1 tỷ</option>
                        <option value="2000000000" {{ request('min_price') == 2000000000 ? 'selected' : '' }}>2 tỷ</option>
                        <option value="5000000000" {{ request('min_price') == 5000000000 ? 'selected' : '' }}>5 tỷ</option>
                    </select>
                </div>
                
                <!-- Giá max -->
                <div class="form-group">
                    <label class="form-label">Giá max</label>
                    <select name="max_price" class="form-control">
                        <option value="">Bất kỳ</option>
                        <option value="1000000000" {{ request('max_price') == 1000000000 ? 'selected' : '' }}>1 tỷ</option>
                        <option value="2000000000" {{ request('max_price') == 2000000000 ? 'selected' : '' }}>2 tỷ</option>
                        <option value="5000000000" {{ request('max_price') == 5000000000 ? 'selected' : '' }}>5 tỷ</option>
                        <option value="10000000000" {{ request('max_price') == 10000000000 ? 'selected' : '' }}>10 tỷ</option>
                    </select>
                </div>
                
                <!-- Số phòng ngủ -->
                <div class="form-group">
                    <label class="form-label">Phòng ngủ</label>
                    <select name="bedrooms" class="form-control">
                        <option value="">Tất cả</option>
                        <option value="1" {{ request('bedrooms') == 1 ? 'selected' : '' }}>1+ phòng</option>
                        <option value="2" {{ request('bedrooms') == 2 ? 'selected' : '' }}>2+ phòng</option>
                        <option value="3" {{ request('bedrooms') == 3 ? 'selected' : '' }}>3+ phòng</option>
                        <option value="4" {{ request('bedrooms') == 4 ? 'selected' : '' }}>4+ phòng</option>
                    </select>
                </div>
                
                <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 8px;">
                    🔍 Áp dụng bộ lọc
                </button>
                
                @if(request()->anyFilled(['location', 'type', 'min_price', 'max_price', 'bedrooms']))
                    <a href="{{ route('properties.index') }}" class="btn btn-outline" style="width: 100%; margin-top: 8px;">
                        🔄 Xóa bộ lọc
                    </a>
                @endif
            </form>
        </aside>
        
        <!-- Main Content -->
        <main>
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h1 style="font-size: 22px; color: var(--dark);">
                    {{ $properties->total() }} bất động sản
                </h1>
                
                <select class="form-control" style="width: auto;" onchange="location.href=this.value">
                    <option value="{{ route('properties.index', request()->all()) }}" selected>Sắp xếp</option>
                    <option value="{{ route('properties.index', array_merge(request()->all(), ['sort' => 'price', 'order' => 'asc'])) }}">Giá tăng dần</option>
                    <option value="{{ route('properties.index', array_merge(request()->all(), ['sort' => 'price', 'order' => 'desc'])) }}">Giá giảm dần</option>
                    <option value="{{ route('properties.index', array_merge(request()->all(), ['sort' => 'created_at', 'order' => 'desc'])) }}">Mới nhất</option>
                </select>
            </div>
            
            @if($properties->count() > 0)
                <div class="property-grid">
                   @foreach($properties as $property)
    <a href="{{ route('properties.show', $property->slug) }}" class="property-card" style="display: block; color: inherit;">
        <div class="card-img">
            <span class="card-badge">{{ $property->price_type == 'sale' ? 'Bán' : 'Cho thuê' }}</span>
            @if($property->images->count() > 0)
                <img src="{{ asset('storage/' . $property->images->first()->image_path) }}" alt="{{ $property->title }}">
            @else
                <img src="https://placehold.co/400x300/E74C3C/white?text={{ urlencode($property->propertyType->name ?? 'BDS') }}" alt="{{ $property->title }}">
            @endif
        </div>
        <div class="card-body">
            <div class="card-price">{{ formatPrice($property->price) }}</div>
            <div class="card-title">{{ $property->title }}</div>
            <div class="card-location">📍 {{ $property->location->name ?? 'N/A' }}</div>
            <div class="card-specs">
                @if($property->bedrooms)
                    <div class="card-spec">🛏️ {{ $property->bedrooms }}</div>
                @endif
                @if($property->bathrooms)
                    <div class="card-spec">🚿 {{ $property->bathrooms }}</div>
                @endif
                <div class="card-spec">📐 {{ $property->area }}m²</div>
            </div>
        </div>
    </a>
@endforeach
                </div>
                
                <!-- Pagination -->
                <div style="margin-top: 30px;">
                    {{ $properties->links() }}
                </div>
            @else
                <div style="text-align: center; padding: 60px 20px; background: white; border-radius: var(--radius);">
                    <div style="font-size: 48px; margin-bottom: 16px;">🔍</div>
                    <h3 style="color: var(--dark); margin-bottom: 8px;">Không tìm thấy bất động sản</h3>
                    <p style="color: var(--gray);">Hãy thử thay đổi bộ lọc tìm kiếm</p>
                    <a href="{{ route('properties.index') }}" class="btn btn-primary" style="margin-top: 16px;">
                        Xem tất cả BĐS
                    </a>
                </div>
            @endif
        </main>
    </div>
</div>
@endsection