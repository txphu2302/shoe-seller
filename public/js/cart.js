document.addEventListener('DOMContentLoaded', function() {
    const addButtons = document.querySelectorAll('.ajax-add-to-cart');
    
    addButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation(); // Prevent card click
            
            const productId = this.getAttribute('data-id');
            const productName = this.getAttribute('data-name');
            
            // Disable button during request
            this.disabled = true;
            const originalHtml = this.innerHTML;
            this.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Đang thêm...';

            const formData = new FormData();
            formData.append('product_id', productId);
            formData.append('quantity', 1);
            formData.append('size', '41'); // Default size

            fetch(BASE_URL + '/cart/add', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                this.disabled = false;
                this.innerHTML = originalHtml;

                if (data.success) {
                    flyToCart(this, function() {
                        showCartNotification(productName);
                        updateCartBadge(data.cart_count);
                    });
                } else {
                    alert(data.message || 'Có lỗi xảy ra!');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                this.disabled = false;
                this.innerHTML = originalHtml;
                alert('Không thể kết nối đến máy chủ!');
            });
        });
    });

    function flyToCart(buttonElement, callback) {
        const cartIcon = document.getElementById('cartIcon');
        // Find the image within the closest product card or product image container
        let productCard = buttonElement.closest('.product-card');
        if (!productCard) {
            productCard = buttonElement.closest('.product-image'); // Fallback for some layouts
        }
        
        if (!productCard || !cartIcon) {
            if (callback) callback();
            return;
        }

        const img = productCard.querySelector('img');
        if (!img) {
            if (callback) callback();
            return;
        }

        // Get coordinates
        const imgRect = img.getBoundingClientRect();
        const cartRect = cartIcon.getBoundingClientRect();

        // Create clone
        const clone = img.cloneNode(true);
        clone.classList.add('fly-to-cart-img');
        clone.style.top = imgRect.top + 'px';
        clone.style.left = imgRect.left + 'px';
        clone.style.width = imgRect.width + 'px';
        clone.style.height = imgRect.height + 'px';
        document.body.appendChild(clone);

        // Trigger reflow
        void clone.offsetWidth;

        // Animate to cart
        clone.style.top = (cartRect.top + cartRect.height / 2 - 15) + 'px';
        clone.style.left = (cartRect.left + cartRect.width / 2 - 15) + 'px';
        clone.style.width = '30px';
        clone.style.height = '30px';
        clone.style.opacity = '0.5';
        clone.style.transform = 'scale(0.2)';

        // Remove clone and trigger callback when animation finishes
        setTimeout(() => {
            clone.remove();
            if (callback) callback();
        }, 800); // Matches the 0.8s transition in CSS
    }

    function showCartNotification(name) {
        // Create notification element
        const notification = document.createElement('div');
        notification.className = 'cart-notification';
        notification.innerHTML = `
            <div class="cart-notif-content">
                <i class="fa-solid fa-circle-check"></i>
                <div class="cart-notif-text">
                    <p><strong>Thành công!</strong></p>
                    <p>Đã thêm ${name} vào giỏ hàng.</p>
                </div>
            </div>
        `;
        
        document.body.appendChild(notification);
        
        // Animate in
        setTimeout(() => notification.classList.add('show'), 10);
        
        // Remove after 3 seconds
        setTimeout(() => {
            notification.classList.remove('show');
            setTimeout(() => notification.remove(), 500);
        }, 3000);
    }

    function updateCartBadge(count) {
        const badges = document.querySelectorAll('.cart-badge');
        badges.forEach(badge => {
            badge.textContent = count;
            // Hiển thị badge nếu count > 0, ẩn nếu = 0
            badge.style.display = (count > 0) ? 'flex' : 'none';
            badge.classList.add('pulse');
            setTimeout(() => badge.classList.remove('pulse'), 500);
        });
    }
});
