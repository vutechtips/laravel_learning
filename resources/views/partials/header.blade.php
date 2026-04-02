<header class="header">
    {{-- <div class="header-top">
        <div class="container" style="display:flex;justify-content:space-between;">
            <span>📞 1900 xxxx | ✉️ info@cozy.com</span>
            <div>
                @auth <span>👤 {{ Auth::user()->name }}</span> @else <a href="{{ route('login') }}">Đăng nhập</a> @endauth
            </div>
        </div>
    </div> --}}
    <div class="header-top">
    <div class="container" style="display:flex;justify-content:space-between;">
        <span>📞 1900 xxxx | ✉️ info@cozy.com</span>
        <div>
            {{-- Tạm ẩn auth, sẽ thêm sau khi học xong phần cơ bản --}}
            <a href="#" onclick="alert('Chức năng đang phát triển!')">👤 Đăng nhập</a>
        </div>
    </div>
</div>
    <div class="header-main container">
        <a href="{{ route('home') }}" class="logo">🏠 Cozy Estate</a>
        <nav class="nav" id="mainNav">
            <a href="{{ route('home') }}">Trang chủ</a>
            <a href="#">Bất động sản</a>
            <a href="#">Môi giới</a>
            <a href="#">Về chúng tôi</a>
            <a href="#">Liên hệ</a>
        </nav>
        <div class="header-actions">
            <a href="#" class="btn btn-primary" style="padding: 6px 12px; font-size: 14px;">Đăng tin</a>
            <button class="mobile-toggle" id="mobileToggle">☰</button>
        </div>
    </div>
</header>