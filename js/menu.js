// 初始化購物車陣列
let cartItems = [];

// 加入購物車函數
function addToCart(item) {
    // 檢查商品是否已在購物車中
    const existingItem = cartItems.find(cartItem => cartItem.id === item.id);

    if (existingItem) {
        // 如果商品已存在，增加數量
        existingItem.quantity += 1;
    } else {
        // 如果是新商品，加入購物車
        cartItems.push({
            id: item.id,
            name: item.name,
            price: item.price,
            quantity: 1
        });
    }

    // 更新購物車顯示
    updateCartDisplay();
}

// 更新購物車顯示
function updateCartDisplay() {
    const itemCount = document.getElementById('itemCount');
    const cartTotalAmount = document.getElementById('cartTotalAmount');
    const sidebarTotal = document.getElementById('sidebarTotal');
    const cartItemsContainer = document.getElementById('cartItems');

    // 計算總數量和總金額
    const totalQuantity = cartItems.reduce((sum, item) => sum + item.quantity, 0);
    const totalAmount = cartItems.reduce((sum, item) => sum + (item.price * item.quantity), 0);

    // 更新顯示
    itemCount.textContent = totalQuantity;
    cartTotalAmount.textContent = totalAmount.toFixed(0);
    sidebarTotal.textContent = totalAmount.toFixed(0);

    // 更新購物車項目列表
    cartItemsContainer.innerHTML = '';

    if (cartItems.length === 0) {
        cartItemsContainer.innerHTML = '<div class="empty-cart">購物車是空的</div>';
        return;
    }

    cartItems.forEach(item => {
        const itemElement = document.createElement('div');
        itemElement.className = 'cart-item';
        itemElement.innerHTML = `
            <div class="cart-item-name">${item.name}</div>
            <div class="cart-item-price">NT$ ${item.price}</div>
            <div class="cart-item-quantity">
                <button class="quantity-btn" onclick="updateQuantity(${item.id}, -1)">-</button>
                <span>${item.quantity}</span>
                <button class="quantity-btn" onclick="updateQuantity(${item.id}, 1)">+</button>
            </div>
            <button onclick="removeFromCart(${item.id})" class="remove-item">×</button>
        `;
        cartItemsContainer.appendChild(itemElement);
    });
}

// 更新商品數量
function updateQuantity(itemId, change) {
    const item = cartItems.find(item => item.id === itemId);
    if (item) {
        item.quantity += change;
        if (item.quantity <= 0) {
            removeFromCart(itemId);
        } else {
            updateCartDisplay();
        }
    }
}

// 從購物車移除商品
function removeFromCart(itemId) {
    cartItems = cartItems.filter(item => item.id !== itemId);
    updateCartDisplay();
}

// 初始化購物車功能
document.addEventListener('DOMContentLoaded', function() {
    // 綁定購物車按鈕事件
    const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function() {
            const id = parseInt(this.dataset.id);
            const name = this.dataset.name;
            const price = parseFloat(this.dataset.price);
            addToCart({ id, name, price });
        });
    });

    // 綁定查看購物車按鈕
    const viewCartBtn = document.getElementById('viewCartBtn');
    const cartSidebar = document.getElementById('cartSidebar');
    const closeCartBtn = document.getElementById('closeCartBtn');
    const checkoutBtn = document.getElementById('checkoutBtn');

    viewCartBtn.addEventListener('click', function() {
        cartSidebar.classList.add('open');
    });

    closeCartBtn.addEventListener('click', function() {
        cartSidebar.classList.remove('open');
    });

    // 綁定結帳按鈕
    checkoutBtn.addEventListener('click', function() {
        if (cartItems.length === 0) {
            alert('購物車是空的！');
            return;
        }

        // 發送訂單到後端
        fetch('process_order.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    items: cartItems
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('訂單已成功送出！');
                    cartItems = [];
                    updateCartDisplay();
                    cartSidebar.classList.remove('open');
                } else {
                    alert('訂單送出失敗：' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('發生錯誤，請稍後再試');
            });
    });

    // 初始化購物車顯示
    updateCartDisplay();
});

// 初始化分類功能
document.addEventListener('DOMContentLoaded', function() {
    // 獲取所有分類按鈕和菜單項目
    const categoryButtons = document.querySelectorAll('.category-btn');
    const menuItems = document.querySelectorAll('.menu-item');

    // 為每個分類按鈕添加點擊事件
    categoryButtons.forEach(button => {
        button.addEventListener('click', function() {
            // 移除所有按鈕的 active 類別
            categoryButtons.forEach(btn => btn.classList.remove('active'));
            // 為當前點擊的按鈕添加 active 類別
            this.classList.add('active');

            // 獲取選擇的分類
            const selectedCategory = this.dataset.category;

            // 顯示/隱藏相應的菜單項目
            menuItems.forEach(item => {
                if (selectedCategory === 'all') {
                    item.style.display = 'block';
                } else {
                    if (item.dataset.category === selectedCategory) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                }
            });
        });
    });
});