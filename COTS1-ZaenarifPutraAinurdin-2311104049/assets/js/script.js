// GamingLap - Modern Gaming Laptop Store JavaScript

// Product Data for Gaming Laptops
const products = [
    {
        id: 1,
        name: "ASUS ROG STRIX SCAR 18",
        price: 42999000,
        oldPrice: 45999000,
        image: "assets/image/laptop1.png",
        images: [
            "assets/image/laptop1.png",
            "assets/image/laptop2.png", 
            "assets/image/laptop3.png"
        ],
        specs: "i9-14900HX • RTX 4090 • 64GB DDR5 • 2TB SSD • 18\" 2K 240Hz",
        category: "Flagship",
        rating: 4.8,
        reviews: 156,
        description: "Laptop gaming ultimate dengan performa maksimal untuk gaming 4K dan content creation.",
        features: [
            "Liquid Metal Cooling",
            "MUX Switch", 
            "Wi-Fi 6E",
            "Dolby Atmos",
            "330W Adapter",
            "Aura Sync RGB"
        ],
        specsDetail: {
            processor: "Intel Core i9-14900HX",
            graphics: "NVIDIA RTX 4090 16GB",
            memory: "64GB DDR5 5600MHz",
            storage: "2TB NVMe PCIe 4.0 SSD",
            display: '18" 2K 240Hz ROG Nebula',
            keyboard: "Mechanical RGB Per-Key"
        }
    },
    {
        id: 2,
        name: "MSI TITAN GT77 HX",
        price: 38999000,
        oldPrice: 41999000,
        image: "assets/image/laptop2.png",
        images: [
            "assets/image/laptop2.png",
            "assets/image/laptop1.png",
            "assets/image/laptop3.png"
        ],
        specs: "i9-14900HX • RTX 4090 • 32GB DDR5 • 2TB SSD • 17\" 4K 144Hz",
        category: "Flagship",
        rating: 5.0,
        reviews: 89,
        description: "Titan series dengan cooling system terbaik dan performa tanpa kompromi.",
        features: [
            "Cooler Boost 5",
            "Steel Series Keyboard",
            "4K 144Hz Display",
            "Dynaudio Sound",
            "Killer Networking",
            "Mystic Light"
        ],
        specsDetail: {
            processor: "Intel Core i9-14900HX",
            graphics: "NVIDIA RTX 4090 16GB",
            memory: "32GB DDR5 5600MHz",
            storage: "2TB NVMe PCIe 4.0 SSD",
            display: '17" 4K 144Hz IPS',
            keyboard: "Steel Series Per-Key RGB"
        }
    },
    {
        id: 3,
        name: "ALIENWARE X16 R2",
        price: 35999000,
        oldPrice: 38999000,
        image: "assets/image/laptop3.png",
        images: [
            "assets/image/laptop3.png",
            "assets/image/laptop1.png",
            "assets/image/laptop2.png"
        ],
        specs: "i9-13900HK • RTX 4080 • 32GB DDR5 • 1TB SSD • 16\" QHD+ 240Hz",
        category: "Premium",
        rating: 4.7,
        reviews: 203,
        description: "Desain premium dengan AlienFX lighting dan performa gaming yang exceptional.",
        features: [
            "AlienFX Lighting",
            "Cryo-Tech Cooling",
            "Dolby Vision",
            "Tobii Eye Tracking",
            "Killer Wi-Fi 6E",
            "Alienware Command Center"
        ],
        specsDetail: {
            processor: "Intel Core i9-13900HK",
            graphics: "NVIDIA RTX 4080 12GB",
            memory: "32GB DDR5 5200MHz",
            storage: "1TB NVMe PCIe 4.0 SSD",
            display: '16" QHD+ 240Hz ComfortView',
            keyboard: "AlienFX Per-Key RGB"
        }
    },
    {
        id: 4,
        name: "RAZER BLADE 16",
        price: 32999000,
        oldPrice: 34999000,
        image: "assets/image/laptop4.png",
        images: [
            "assets/image/laptop4.png",
            "assets/image/laptop1.png",
            "assets/image/laptop2.png"
        ],
        specs: "i9-13950HX • RTX 4070 • 32GB DDR5 • 1TB SSD • 16\" Dual Mode",
        category: "Premium",
        rating: 4.6,
        reviews: 167,
        description: "Sleek design dengan dual-mode display untuk gaming dan produktivitas.",
        features: [
            "Dual-Mode Mini-LED",
            "Vapor Chamber Cooling",
            "Razer Chroma RGB",
            "THX Spatial Audio",
            "CNC Aluminum Body",
            "Razer Synapse"
        ],
        specsDetail: {
            processor: "Intel Core i9-13950HX",
            graphics: "NVIDIA RTX 4070 8GB",
            memory: "32GB DDR5 5200MHz",
            storage: "1TB NVMe PCIe 4.0 SSD",
            display: '16" Dual-Mode Mini-LED',
            keyboard: "Razer Chroma Per-Key RGB"
        }
    },
    {
        id: 5,
        name: "LENOVO LEGION 7i",
        price: 27999000,
        oldPrice: 29999000,
        image: "assets/image/laptop5.png",
        images: [
            "assets/image/laptop5.png",
            "assets/image/laptop1.png",
            "assets/image/laptop2.png"
        ],
        specs: "i9-13900HX • RTX 4070 • 32GB DDR5 • 1TB SSD • 16\" WQXGA 240Hz",
        category: "Performance",
        rating: 4.8,
        reviews: 234,
        description: "Performance beast dengan harga terbaik di kelasnya.",
        features: [
            "Coldfront 5.0 Cooling",
            "TrueStrike Keyboard",
            "Nahimic Audio",
            "Lenovo AI Engine+",
            "PureSight Display",
            "Legion Spectrum RGB"
        ],
        specsDetail: {
            processor: "Intel Core i9-13900HX",
            graphics: "NVIDIA RTX 4070 8GB",
            memory: "32GB DDR5 5200MHz",
            storage: "1TB NVMe PCIe 4.0 SSD",
            display: '16" WQXGA 240Hz IPS',
            keyboard: "TrueStrike Per-Key RGB"
        }
    }
];

// Initialize when document is ready
$(document).ready(function() {
    console.log('🚀 GamingLap Store initialized');
    
    // Generate product cards on index page
    if ($('#productGrid').length) {
        generateProductCards();
        initializeCarousel();
    }

    // Search functionality
    $('#searchForm').on('submit', function(e) {
        e.preventDefault();
        const searchTerm = $('#searchInput').val().toLowerCase();
        filterProducts(searchTerm);
    });

    // Smooth scrolling for anchor links
    $('a[href^="#"]').on('click', function(e) {
        e.preventDefault();
        const target = $(this.getAttribute('href'));
        if (target.length) {
            $('html, body').animate({
                scrollTop: target.offset().top - 80
            }, 1000);
        }
    });

    // Add hover effects to product cards
    $(document).on('mouseenter', '.product-card', function() {
        $(this).find('.detail-btn').addClass('glow-text');
    }).on('mouseleave', '.product-card', function() {
        $(this).find('.detail-btn').removeClass('glow-text');
    });

    // Initialize carousel with custom settings
    function initializeCarousel() {
        $('#mainCarousel').carousel({
            interval: 5000,
            pause: 'hover',
            wrap: true
        });
    }
});

// Generate product cards
function generateProductCards() {
    const productGrid = $('#productGrid');
    productGrid.empty();

    products.forEach(product => {
        const productCard = `
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card product-card h-100">
                    <img src="${product.image}" class="card-img-top" alt="${product.name}">
                    <div class="card-body d-flex flex-column">
                        <div class="product-badge mb-2">
                            <span class="badge bg-danger">${product.category}</span>
                        </div>
                        <h5 class="product-name">${product.name}</h5>
                        <p class="product-specs">${product.specs}</p>
                        <p class="product-price">Rp ${formatPrice(product.price)}</p>
                        <div class="mt-auto">
                            <button class="btn detail-btn view-detail" data-product-id="${product.id}">
                                <i class="fas fa-eye me-2"></i>VIEW DETAILS
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `;
        productGrid.append(productCard);
    });

    // Add click event to detail buttons
    $('.view-detail').on('click', function() {
        const productId = $(this).data('product-id');
        // Redirect to detail page with product ID
        window.location.href = `detail.html?id=${productId}`;
    });
}

// Filter products based on search term
function filterProducts(searchTerm) {
    if (searchTerm.trim() === '') {
        generateProductCards();
        return;
    }

    const filteredProducts = products.filter(product => 
        product.name.toLowerCase().includes(searchTerm) ||
        product.specs.toLowerCase().includes(searchTerm) ||
        product.category.toLowerCase().includes(searchTerm)
    );

    const productGrid = $('#productGrid');
    productGrid.empty();

    if (filteredProducts.length === 0) {
        productGrid.html(`
            <div class="col-12 text-center">
                <div class="no-products">
                    <i class="fas fa-search fa-3x mb-3 text-muted"></i>
                    <h4 class="text-muted">Laptop tidak ditemukan</h4>
                    <p class="text-muted">Coba kata kunci lain seperti "ASUS", "RTX", atau "Gaming"</p>
                </div>
            </div>
        `);
    } else {
        filteredProducts.forEach(product => {
            const productCard = `
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card product-card h-100">
                        <img src="${product.image}" class="card-img-top" alt="${product.name}">
                        <div class="card-body d-flex flex-column">
                            <div class="product-badge mb-2">
                                <span class="badge bg-danger">${product.category}</span>
                            </div>
                            <h5 class="product-name">${product.name}</h5>
                            <p class="product-specs">${product.specs}</p>
                            <p class="product-price">Rp ${formatPrice(product.price)}</p>
                            <div class="mt-auto">
                                <button class="btn detail-btn view-detail" data-product-id="${product.id}">
                                    <i class="fas fa-eye me-2"></i>VIEW DETAILS
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            productGrid.append(productCard);
        });

        // Re-attach event listeners
        $('.view-detail').on('click', function() {
            const productId = $(this).data('product-id');
            window.location.href = `detail.html?id=${productId}`;
        });
    }
}

// Format price with thousand separators
function formatPrice(price) {
    return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

// Get URL parameters
function getUrlParameter(name) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(name);
}

// Show toast notification
function showToast(message) {
    // Remove existing toasts
    $('.toast-container').remove();

    // Create new toast
    const toast = $(`
        <div class="toast-container">
            <div class="custom-toast">
                <div class="d-flex align-items-center">
                    <i class="fas fa-gamepad me-2"></i>
                    <span>${message}</span>
                </div>
            </div>
        </div>
    `);

    $('body').append(toast);

    // Auto remove after 3 seconds
    setTimeout(() => {
        toast.fadeOut(300, function() {
            $(this).remove();
        });
    }, 3000);
}

// Add some gaming-style effects
function addGamingEffects() {
    // Add random glowing effect to some elements
    setInterval(() => {
        $('.brand-text').css('text-shadow', 
            `0 0 10px rgba(${Math.random() * 255}, ${Math.random() * 255}, ${Math.random() * 255}, 0.8)`
        );
    }, 2000);
}

// Initialize gaming effects
addGamingEffects();