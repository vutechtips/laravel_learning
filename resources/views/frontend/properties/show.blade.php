@extends('layouts.app')
@section('title', $property->title . ' - Cozy Estate')

@php
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
        <a href="{{ route('properties.index') }}" style="color: var(--gray);">Bất động sản</a>
        <span style="margin: 0 8px;">/</span>
        <span style="color: var(--dark); font-weight: 500;">{{ $property->title }}</span>
    </div>
</div>

<div class="container" style="padding: 30px 16px;">
    <div style="display: grid; grid-template-columns: 1fr 350px; gap: 24px;">
        
        <!-- Main Content -->
        <main>
            <!-- Image Gallery -->
            <div style="background: white; border-radius: var(--radius); overflow: hidden; box-shadow: var(--shadow); margin-bottom: 24px;">
                <div style="position: relative; height: 450px; background: #f0f0f0;">
                    @if($property->images->count() > 0)
                        <img id="mainImage" src="{{ asset('storage/' . $property->images->first()->image_path) }}" 
                             alt="{{ $property->title }}" 
                             style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                        <img id="mainImage" src="https://placehold.co/800x450/E74C3C/white?text={{ urlencode($property->propertyType->name) }}" 
                             alt="{{ $property->title }}" 
                             style="width: 100%; height: 100%; object-fit: cover;">
                    @endif
                    
                    @if($property->images->count() > 1)
                        <button id="prevBtn" style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); background: rgba(0,0,0,0.5); color: white; border: none; padding: 12px 16px; border-radius: 50%; cursor: pointer; font-size: 18px;">❮</button>
                        <button id="nextBtn" style="position: absolute; right: 16px; top: 50%; transform: translateY(-50%); background: rgba(0,0,0,0.5); color: white; border: none; padding: 12px 16px; border-radius: 50%; cursor: pointer; font-size: 18px;">❯</button>
                    @endif
                </div>
                
                <!-- Thumbnail -->
                @if($property->images->count() > 1)
                    <div style="display: flex; gap: 8px; padding: 16px; overflow-x: auto;">
                        @foreach($property->images as $index => $image)
                            <img src="{{ asset('storage/' . $image->image_path) }}" 
                                 alt="Image {{ $index + 1 }}"
                                 class="thumb {{ $index === 0 ? 'active' : '' }}"
                                 data-index="{{ $index }}"
                                 style="width: 80px; height: 60px; object-fit: cover; border-radius: 4px; cursor: pointer; border: 2px solid {{ $index === 0 ? 'var(--primary)' : 'transparent' }};">
                        @endforeach
                    </div>
                @endif
            </div>
            
            <!-- Property Info -->
            <div style="background: white; padding: 24px; border-radius: var(--radius); box-shadow: var(--shadow); margin-bottom: 24px;">
                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 16px;">
                    <div>
                        <h1 style="font-size: 24px; color: var(--dark); margin-bottom: 8px;">{{ $property->title }}</h1>
                        <div style="color: var(--gray); font-size: 14px;">
                            📍 {{ $property->address }}, {{ $property->location->name ?? 'N/A' }}
                        </div>
                    </div>
                    <div style="text-align: right;">
                        <div style="font-size: 28px; font-weight: 700; color: var(--primary);">{{ formatPrice($property->price) }}</div>
                        @if($property->price_negotiable)
                            <span style="font-size: 12px; color: var(--success);">✅ Có thương lượng</span>
                        @endif
                    </div>
                </div>
                
                <!-- Specs -->
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(120px, 1fr)); gap: 16px; padding: 20px 0; border-top: 1px solid var(--border); border-bottom: 1px solid var(--border);">
                    <div style="text-align: center;">
                        <div style="font-size: 24px; margin-bottom: 4px;">📐</div>
                        <div style="font-weight: 600; color: var(--dark);">{{ $property->area }}m²</div>
                        <div style="font-size: 12px; color: var(--gray);">Diện tích</div>
                    </div>
                    @if($property->bedrooms)
                    <div style="text-align: center;">
                        <div style="font-size: 24px; margin-bottom: 4px;">🛏️</div>
                        <div style="font-weight: 600; color: var(--dark);">{{ $property->bedrooms }}</div>
                        <div style="font-size: 12px; color: var(--gray);">Phòng ngủ</div>
                    </div>
                    @endif
                    @if($property->bathrooms)
                    <div style="text-align: center;">
                        <div style="font-size: 24px; margin-bottom: 4px;">🚿</div>
                        <div style="font-weight: 600; color: var(--dark);">{{ $property->bathrooms }}</div>
                        <div style="font-size: 12px; color: var(--gray);">Phòng tắm</div>
                    </div>
                    @endif
                    @if($property->floors)
                    <div style="text-align: center;">
                        <div style="font-size: 24px; margin-bottom: 4px;">🏢</div>
                        <div style="font-weight: 600; color: var(--dark);">{{ $property->floors }}</div>
                        <div style="font-size: 12px; color: var(--gray);">Tầng</div>
                    </div>
                    @endif
                </div>
                
                <!-- Description -->
                <div style="margin-top: 24px;">
                    <h3 style="font-size: 18px; color: var(--dark); margin-bottom: 12px;">📋 Mô tả chi tiết</h3>
                    <div style="color: var(--gray); line-height: 1.8;">
                        {!! nl2br(e($property->description ?? 'Đang cập nhật...')) !!}
                    </div>
                </div>
                
                <!-- Features -->
                <div style="margin-top: 24px;">
                    <h3 style="font-size: 18px; color: var(--dark); margin-bottom: 12px;">✨ Tiện ích</h3>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 12px;">
                        <div style="display: flex; align-items: center; gap: 8px; color: var(--gray);">
                            <span style="color: var(--success);">✓</span> Sổ hồng riêng
                        </div>
                        <div style="display: flex; align-items: center; gap: 8px; color: var(--gray);">
                            <span style="color: var(--success);">✓</span> Pháp lý rõ ràng
                        </div>
                        <div style="display: flex; align-items: center; gap: 8px; color: var(--gray);">
                            <span style="color: var(--success);">✓</span> Hỗ trợ vay ngân hàng
                        </div>
                        <div style="display: flex; align-items: center; gap: 8px; color: var(--gray);">
                            <span style="color: var(--success);">✓</span> Xem nhà 24/7
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Related Properties -->
            @if($relatedProperties->count() > 0)
                <div style="background: white; padding: 24px; border-radius: var(--radius); box-shadow: var(--shadow);">
                    <h3 style="font-size: 20px; color: var(--dark); margin-bottom: 20px;">🏠 Bất động sản tương tự</h3>
                    <div class="property-grid" style="grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));">
                        @foreach($relatedProperties as $related)
                            <a href="{{ route('properties.show', $related->slug) }}" class="property-card" style="display: block;">
                                <div class="card-img">
                                    <span class="card-badge">{{ $related->price_type == 'sale' ? 'Bán' : 'Cho thuê' }}</span>
                                    @if($related->images->count() > 0)
                                        <img src="{{ asset('storage/' . $related->images->first()->image_path) }}" alt="{{ $related->title }}">
                                    @else
                                        <img src="https://placehold.co/300x200/ddd/999?text=BDS" alt="{{ $related->title }}">
                                    @endif
                                </div>
                                <div class="card-body">
                                    <div class="card-price">{{ formatPrice($related->price) }}</div>
                                    <div class="card-title">{{ $related->title }}</div>
                                    <div class="card-location">📍 {{ $related->location->name ?? 'N/A' }}</div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </main>
        
        <!-- Sidebar - Contact Form -->
        <aside>
            <div style="background: white; padding: 24px; border-radius: var(--radius); box-shadow: var(--shadow); position: sticky; top: 80px;">
                <h3 style="font-size: 18px; color: var(--dark); margin-bottom: 16px;">📞 Liên hệ ngay</h3>
                
                <!-- Agent Info -->
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 20px; padding-bottom: 16px; border-bottom: 1px solid var(--border);">
                    <div style="width: 50px; height: 50px; border-radius: 50%; background: var(--primary); display: flex; align-items: center; justify-content: center; color: white; font-weight: 600;">
                        {{ substr($property->user->name ?? 'A', 0, 1) }}
                    </div>
                    <div>
                        <div style="font-weight: 600; color: var(--dark);">{{ $property->user->name ?? 'Nhân viên' }}</div>
                        <div style="font-size: 12px; color: var(--gray);">📞 {{ $property->user->phone ?? '1900 xxxx' }}</div>
                    </div>
                </div>
                
                <!-- Contact Form -->
                <form action="#" method="POST">
                    @csrf
                    <input type="hidden" name="property_id" value="{{ $property->id }}">
                    
                    <div class="form-group">
                        <label class="form-label">Họ tên *</label>
                        <input type="text" name="name" class="form-control" required placeholder="Nhập họ tên">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Số điện thoại *</label>
                        <input type="tel" name="phone" class="form-control" required placeholder="Nhập số điện thoại">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Nhập email">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Lời nhắn</label>
                        <textarea name="message" class="form-control" rows="4" placeholder="Tôi quan tâm đến BĐS này..."></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary" style="width: 100%;">
                        📩 Gửi yêu cầu
                    </button>
                </form>
                
                <!-- Quick Contact -->
                <div style="margin-top: 16px; display: grid; gap: 8px;">
                    <a href="tel:1900xxxx" class="btn btn-outline" style="width: 100%; justify-content: center;">
                        📞 Gọi ngay
                    </a>
                    <a href="https://zalo.me/xxxx" target="_blank" class="btn btn-outline" style="width: 100%; justify-content: center;">
                        💬 Zalo
                    </a>
                </div>
            </div>
        </aside>
    </div>
</div>

@push('scripts')
<script>
// Gallery Slider
document.addEventListener('DOMContentLoaded', function() {
    const mainImage = document.getElementById('mainImage');
    const thumbs = document.querySelectorAll('.thumb');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    let currentIndex = 0;
    
    // Click thumbnail
    thumbs.forEach((thumb, index) => {
        thumb.addEventListener('click', function() {
            currentIndex = index;
            updateGallery();
        });
    });
    
    // Previous button
    if (prevBtn) {
        prevBtn.addEventListener('click', function() {
            currentIndex = (currentIndex - 1 + thumbs.length) % thumbs.length;
            updateGallery();
        });
    }
    
    // Next button
    if (nextBtn) {
        nextBtn.addEventListener('click', function() {
            currentIndex = (currentIndex + 1) % thumbs.length;
            updateGallery();
        });
    }
    
    function updateGallery() {
        if (thumbs.length === 0) return;
        
        // Update main image
        mainImage.src = thumbs[currentIndex].src;
        
        // Update active thumbnail
        thumbs.forEach((thumb, index) => {
            thumb.style.borderColor = index === currentIndex ? 'var(--primary)' : 'transparent';
        });
    }
});
</script>
@endpush

@push('styles')
<style>
.thumb:hover, .thumb.active {
    border-color: var(--primary) !important;
}
</style>
@endpush
@endsection