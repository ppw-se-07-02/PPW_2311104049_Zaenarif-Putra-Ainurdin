// Detail Page JavaScript
$(document).ready(function() {
    console.log('🚀 Detail Page initialized');
    
    // Get product ID from URL
    const productId = getUrlParameter('id');
    
    if (productId) {
        loadProductDetail(parseInt(productId));
    } else {
        showProductNotFound();
    }

    // Add to cart functionality
    $(document).on('click', '#addToCartBtn', function() {
        showToast('🎮 Laptop berhasil ditambahkan ke keranjang!');
        
        // Add animation effect
        $(this).html('<i class="fas fa-check me-2"></i>ADDED TO CART');
        $(this).addClass('btn-success').removeClass('btn-danger');
        
        setTimeout(() => {
            $(this).html('<i class="fas fa-shopping-cart me-2"></i>ADD TO CART');
            $(this).addClass('btn-danger').removeClass('btn-success');
        }, 2000);
    });

    // Quantity selector functionality
    $(document).on('click', '#decreaseQty', function() {
        const quantityInput = $('#quantity');
        let currentValue = parseInt(quantityInput.val());
        if (currentValue > 1) {
            quantityInput.val(currentValue - 1);
        }
    });

    $(document).on('click', '#increaseQty', function() {
        const quantityInput = $('#quantity');
        let currentValue = parseInt(quantityInput.val());
        if (currentValue < 5) {
            quantityInput.val(currentValue + 1);
        }
    });

    // Thumbnail click event
    $(document).on('click', '.img-thumbnail', function() {
        $('.img-thumbnail').removeClass('active');
        $(this).addClass('active');
    });
});

// Load product detail
function loadProductDetail(productId) {
    const product = products.find(p => p.id === productId);
    
    if (product) {
        displayProductDetail(product);
    } else {
        showProductNotFound();
    }
}

// Display product detail
function displayProductDetail(product) {
    const productDetail = $('#productDetail');
    
    // Calculate discount
    const discount = Math.round(((product.oldPrice - product.price) / product.oldPrice) * 100);
    
    // Generate stars for rating
    const stars = generateStars(product.rating);
    
    const detailHTML = `
        <div class="col-lg-6">
            <!-- Gambar Produk (Image Slider) -->
            <div id="productCarousel" class="carousel slide product-carousel" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    ${product.images.map((_, index) => `
                        <button type="button" data-bs-target="#productCarousel" data-bs-slide-to="${index}" 
                                class="${index === 0 ? 'active' : ''}"></button>
                    `).join('')}
                </div>
                <div class="carousel-inner">
                    ${product.images.map((image, index) => `
                        <div class="carousel-item ${index === 0 ? 'active' : ''}">
                            <img src="${image}" class="d-block w-100 product-image" alt="${product.name} ${index + 1}">
                        </div>
                    `).join('')}
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
            
            <!-- Thumbnail Images -->
            <div class="thumbnail-container mt-3">
                <div class="row g-2">
                    ${product.images.map((image, index) => `
                        <div class="col-4">
                            <img src="${image}" class="img-thumbnail ${index === 0 ? 'active' : ''}" 
                                 data-bs-target="#productCarousel" data-bs-slide-to="${index}">
                        </div>
                    `).join('')}
                </div>
            </div>
        </div>
        
        <div class="col-lg-6">
            <!-- Deskripsi Barang -->
            <div class="product-info">
                <div class="product-badge mb-3">
                    <span class="badge bg-danger me-2"><i class="fas fa-fire me-1"></i>HOT</span>
                    <span class="badge bg-primary me-2"><i class="fas fa-star me-1"></i>NEW</span>
                    <span class="badge bg-success"><i class="fas fa-bolt me-1"></i>READY STOCK</span>
                </div>
                
                <h1 class="product-title">${product.name}</h1>
                
                <div class="product-rating mb-3">
                    <span class="text-warning">
                        ${stars}
                    </span>
                    <span class="ms-2">(${product.rating}/5) • ${product.reviews} Reviews</span>
                </div>
                
                <p class="product-description mb-4">${product.description}</p>
                
                <div class="product-price-container mb-4">
                    <p class="product-price">Rp ${formatPrice(product.price)}</p>
                    ${product.oldPrice ? `
                        <p class="product-old-price">Rp ${formatPrice(product.oldPrice)}</p>
                        <span class="discount-badge">Save ${discount}%</span>
                    ` : ''}
                </div>
                
                <div class="product-highlights mb-4">
                    <div class="highlight-item">
                        <i class="fas fa-shipping-fast text-success"></i>
                        <span>Gratis Ongkir & Pengembalian</span>
                    </div>
                    <div class="highlight-item">
                        <i class="fas fa-shield-alt text-primary"></i>
                        <span>Garansi 2 Tahun Resmi</span>
                    </div>
                    <div class="highlight-item">
                        <i class="fas fa-clock text-warning"></i>
                        <span>Pengiriman 1-2 Hari</span>
                    </div>
                </div>

                <div class="product-specs mb-4">
                    <h5 class="specs-title">Spesifikasi Monster:</h5>
                    <div class="specs-grid">
                        <div class="spec-item">
                            <i class="fas fa-microchip text-primary"></i>
                            <div>
                                <strong>Processor</strong>
                                <span>${product.specsDetail.processor}</span>
                            </div>
                        </div>
                        <div class="spec-item">
                            <i class="fas fa-bolt text-warning"></i>
                            <div>
                                <strong>Graphics</strong>
                                <span>${product.specsDetail.graphics}</span>
                            </div>
                        </div>
                        <div class="spec-item">
                            <i class="fas fa-memory text-info"></i>
                            <div>
                                <strong>Memory</strong>
                                <span>${product.specsDetail.memory}</span>
                            </div>
                        </div>
                        <div class="spec-item">
                            <i class="fas fa-hdd text-success"></i>
                            <div>
                                <strong>Storage</strong>
                                <span>${product.specsDetail.storage}</span>
                            </div>
                        </div>
                        <div class="spec-item">
                            <i class="fas fa-desktop text-danger"></i>
                            <div>
                                <strong>Display</strong>
                                <span>${product.specsDetail.display}</span>
                            </div>
                        </div>
                        <div class="spec-item">
                            <i class="fas fa-keyboard text-secondary"></i>
                            <div>
                                <strong>Keyboard</strong>
                                <span>${product.specsDetail.keyboard}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="product-features mb-4">
                    <h5 class="features-title">Fitur Gaming:</h5>
                    <div class="features-grid">
                        ${product.features.map(feature => `
                            <span class="feature-tag"><i class="fas fa-check"></i> ${feature}</span>
                        `).join('')}
                    </div>
                </div>

                <!-- Quantity & Add to Cart -->
                <div class="product-actions">
                    <div class="quantity-selector mb-3">
                        <label class="form-label">Jumlah:</label>
                        <div class="input-group quantity-group">
                            <button class="btn btn-outline-secondary" type="button" id="decreaseQty">-</button>
                            <input type="number" class="form-control text-center" id="quantity" value="1" min="1" max="5">
                            <button class="btn btn-outline-secondary" type="button" id="increaseQty">+</button>
                        </div>
                    </div>

                    <button class="btn btn-danger btn-lg w-100 add-to-cart-btn" id="addToCartBtn">
                        <i class="fas fa-shopping-cart me-2"></i>ADD TO CART
                    </button>
                    
                    <div class="action-buttons mt-3">
                        <button class="btn btn-outline-primary w-100 mb-2">
                            <i class="fas fa-heart me-2"></i>Add to Wishlist
                        </button>
                        <button class="btn btn-outline-secondary w-100">
                            <i class="fas fa-sync-alt me-2"></i>Compare
                        </button>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    productDetail.html(detailHTML);
    
    // Update page title
    document.title = `${product.name} - ComputerArea GamingLap`;
}

// Generate star rating
function generateStars(rating) {
    const fullStars = Math.floor(rating);
    const hasHalfStar = rating % 1 !== 0;
    let stars = '';
    
    for (let i = 0; i < fullStars; i++) {
        stars += '<i class="fas fa-star"></i>';
    }
    
    if (hasHalfStar) {
        stars += '<i class="fas fa-star-half-alt"></i>';
    }
    
    const emptyStars = 5 - Math.ceil(rating);
    for (let i = 0; i < emptyStars; i++) {
        stars += '<i class="far fa-star"></i>';
    }
    
    return stars;
}

// Show product not found
function showProductNotFound() {
    const productDetail = $('#productDetail');
    productDetail.html(`
        <div class="col-12 text-center">
            <div class="product-not-found">
                <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                <h3 class="text-warning">Produk Tidak Ditemukan</h3>
                <p class="text-muted">Produk yang Anda cari tidak tersedia.</p>
                <a href="index.html" class="btn btn-primary mt-3">
                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Beranda
                </a>
            </div>
        </div>
    `);
}