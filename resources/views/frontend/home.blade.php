@extends('layouts.app')
@section('title', 'Cozy Real Estate - Tìm nhà mơ ước')

@section('content')
<!-- Hero Section -->
<section class="hero">
    <div>
        <h1>Tìm ngôi nhà mơ ước của bạn</h1>
        <p>Hàng nghìn bất động sản đang chờ đón</p>
        
        <!-- Search Form -->
        <form action="{{ route('properties.search') }}" method="GET" class="search-box">
            <div class="search-grid">
                <!-- Vị trí -->
                <div class="form-group">
                    <label class="form-label">Vị trí</label>
                    <select name="location" class="form-control">
                        <option value="">Tất cả</option>
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <!-- Loại BĐS -->
                <div class="form-group">
                    <label class="form-label">Loại BĐS</label>
                    <select name="type" class="form-control">
                        <option value="">Tất cả</option>
                        @foreach($types as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <!-- Giá min -->
                <div class="form-group">
                    <label class="form-label">Giá min</label>
                    <select name="min_price" class="form-control">
                        <option value="">Bất kỳ</option>
                        <option value="500000000">500 triệu</option>
                        <option value="1000000000">1 tỷ</option>
                        <option value="2000000000">2 tỷ</option>
                        <option value="5000000000">5 tỷ</option>
                    </select>
                </div>
                
                <!-- Giá max -->
                <div class="form-group">
                    <label class="form-label">Giá max</label>
                    <select name="max_price" class="form-control">
                        <option value="">Bất kỳ</option>
                        <option value="1000000000">1 tỷ</option>
                        <option value="2000000000">2 tỷ</option>
                        <option value="5000000000">5 tỷ</option>
                        <option value="10000000000">10 tỷ</option>
                    </select>
                </div>
                
                <!-- Submit -->
                <div class="search-submit">
                    <button type="submit" class="btn btn-primary" style="width:100%">🔍 Tìm kiếm</button>
                </div>
            </div>
        </form>
    </div>
</section>

<!-- Featured Properties -->
<section class="container" style="padding: 40px 16px;">
    <h2 style="text-align:center; color:var(--dark); margin-bottom:20px;">Bất động sản nổi bật</h2>
    
    @if($featuredProperties->count() > 0)
        <div class="property-grid">
            @foreach($featuredProperties as $property)
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
                        <div class="card-price">{{ number_format($property->price / 1000000000, 1) }} tỷ</div>
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
    @else
        <div style="text-align: center; padding: 40px; background: var(--light-gray); border-radius: var(--radius);">
            <p style="color: var(--gray);">Chưa có bất động sản nổi bật</p>
        </div>
    @endif
</section>

<!-- Property Types -->
<section style="padding: 60px 0; background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);">
    <div class="container">
        <h2 style="text-align:center; color:var(--dark); margin-bottom:16px; font-size: 32px; font-weight: 700;">
            Loại hình bất động sản
        </h2>
        <p style="text-align:center; color:var(--gray); margin-bottom:40px;">
            Chọn loại hình phù hợp với nhu cầu của bạn
        </p>
        
        <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 20px;">
            @foreach($types as $type)
                <a href="{{ route('properties.index', ['type' => $type->id]) }}" 
                   style="background: white; padding: 24px 20px; border-radius: 12px; text-align: center; box-shadow: 0 4px 16px rgba(0,0,0,0.08); transition: all 0.3s ease; text-decoration: none; display: block; width: 160px; flex-shrink: 0;"
                   onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 12px 32px rgba(231,76,60,0.2)';"
                   onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 16px rgba(0,0,0,0.08)';">
                    <div style="width: 60px; height: 60px; margin: 0 auto 12px; background: linear-gradient(135deg, #E74C3C 0%, #c0392b 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <i class="fas {{ $type->icon ?? 'fa-home' }}" style="font-size: 24px; color: white;"></i>
                    </div>
                    <div style="font-weight: 600; color: var(--dark); font-size: 14px;">{{ $type->name }}</div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endsection 