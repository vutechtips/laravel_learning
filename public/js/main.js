document.addEventListener('DOMContentLoaded', () => {
    // Mobile menu toggle
    const toggle = document.getElementById('mobileToggle');
    const nav = document.getElementById('mainNav');
    if (toggle && nav) {
        toggle.addEventListener('click', () => {
            nav.classList.toggle('active');
            toggle.innerHTML = nav.classList.contains('active') ? '✕' : '☰';
        });
    }

    // Auto format giá tiền VND (nếu cần)
    const prices = document.querySelectorAll('.format-vnd');
    prices.forEach(el => {
        const num = parseInt(el.dataset.price);
        if (!isNaN(num)) el.textContent = num.toLocaleString('vi-VN') + '₫';
    });
});