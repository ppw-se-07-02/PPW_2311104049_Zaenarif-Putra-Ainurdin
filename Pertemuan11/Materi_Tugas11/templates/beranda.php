<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Batik Nusantara | Toko Online</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

  <!-- HEADER -->
  <header class="header navbar navbar-expand-lg fixed-top">
    <div class="container">
      <div class="logo navbar-brand">🪡 Batik Nusantara</div>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon">☰</span>
      </button>
      <nav class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a href="#" class="nav-link active">Beranda</a></li>
          <li class="nav-item"><a href="#" class="nav-link">Koleksi</a></li>
          <li class="nav-item"><a href="#" class="nav-link">Tentang</a></li>
          <li class="nav-item"><a href="#" class="nav-link">Kontak</a></li>
          <li class="nav-item"><a href="#" class="nav-link">Login</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <!-- SLIDER -->
  <section class="banner">
    <div class="banner-slides">
      <div class="slide s1"></div>
      <div class="slide s2"></div>
      <div class="slide s3"></div>
    </div>
    <div class="banner-text">
      <h2>Batik Nusantara</h2>
      <p>Memadukan Warisan Budaya dengan Gaya Modern</p>
      <a href="#" class="btn-banner">Jelajahi Koleksi</a>
    </div>
  </section>

  <!-- KOLEKSI PRODUK -->
  <main class="content container py-5">
    <div class="row">
      <section class="product-list col-lg-8">
        <h3 class="text-center mb-3">🧵 Koleksi Pilihan Kami</h3>
        <p class="subtitle text-center mb-4">Kain batik terbaik dari berbagai daerah Indonesia, dibuat dengan cinta dan tradisi.</p>

        <div class="row">
          <!-- Kartu Produk -->
          <div class="col-md-6 col-lg-4 mb-4">
            <div class="product-card card h-100">
              <img src="https://i.pinimg.com/1200x/6a/7c/35/6a7c35f521eebd88d02e034c3d387a3d.jpg" class="card-img-top" alt="Batik Tulis Eksklusif">
              <div class="card-body d-flex flex-column">
                <h4 class="card-title">Batik Tulis Eksklusif</h4>
                <p class="card-text">Motif parang klasik, sentuhan emas di setiap helai.</p>
                <span class="price mb-2">Rp 450.000</span>
                <button class="btn-detail mt-auto" data-bs-toggle="modal" data-bs-target="#productModal" 
                  data-title="Batik Tulis Eksklusif" 
                  data-desc="Motif parang klasik dengan warna lembut. Dibuat manual oleh pengrajin batik Yogyakarta." 
                  data-price="Rp 450.000">
                  Lihat Detail
                </button>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-4 mb-4">
            <div class="product-card card h-100">
              <img src="https://i.pinimg.com/736x/17/b2/c4/17b2c4f291eabeadec6fbb15a24f3e6f.jpg" class="card-img-top" alt="Batik Cap Parang">
              <div class="card-body d-flex flex-column">
                <h4 class="card-title">Batik Cap Parang</h4>
                <p class="card-text">Cocok untuk acara semi-formal dan kasual.</p>
                <span class="price mb-2">Rp 220.000</span>
                <button class="btn-detail mt-auto" data-bs-toggle="modal" data-bs-target="#productModal" 
                  data-title="Batik Cap Parang" 
                  data-desc="Batik cap dengan desain kontemporer yang tetap mempertahankan pola klasik parang." 
                  data-price="Rp 220.000">
                  Lihat Detail
                </button>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-4 mb-4">
            <div class="product-card card h-100">
              <img src="https://i.pinimg.com/1200x/a2/6a/03/a26a03b2531c20f0db8d010927f68b41.jpg" class="card-img-top" alt="Batik Couple Premium">
              <div class="card-body d-flex flex-column">
                <h4 class="card-title">Batik Couple Premium</h4>
                <p class="card-text">Kemewahan untuk pasangan modern.</p>
                <span class="price mb-2">Rp 550.000</span>
                <button class="btn-detail mt-auto" data-bs-toggle="modal" data-bs-target="#productModal" 
                  data-title="Batik Couple Premium" 
                  data-desc="Set couple batik eksklusif dengan warna senada. Cocok untuk acara istimewa." 
                  data-price="Rp 550.000">
                  Lihat Detail
                </button>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-4 mb-4">
            <div class="product-card card h-100">
              <img src="https://i.pinimg.com/736x/02/bf/00/02bf008b09d1d8a125f3e193fb06efc4.jpg" class="card-img-top" alt="Batik Gamis Elegan">
              <div class="card-body d-flex flex-column">
                <h4 class="card-title">Batik Gamis Elegan</h4>
                <p class="card-text">Anggun dengan nuansa pastel lembut.</p>
                <span class="price mb-2">Rp 320.000</span>
                <button class="btn-detail mt-auto" data-bs-toggle="modal" data-bs-target="#productModal" 
                  data-title="Batik Gamis Elegan" 
                  data-desc="Gamis batik modern yang ringan dan nyaman, cocok untuk acara keluarga." 
                  data-price="Rp 320.000">
                  Lihat Detail
                </button>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-4 mb-4">
            <div class="product-card card h-100">
              <img src="https://i.pinimg.com/1200x/e8/bc/c3/e8bcc32cc115f5c6d45f5f766a8c7503.jpg" class="card-img-top" alt="Batik Modern Kasual">
              <div class="card-body d-flex flex-column">
                <h4 class="card-title">Batik Modern Kasual</h4>
                <p class="card-text">Desain ringan untuk gaya sehari-hari.</p>
                <span class="price mb-2">Rp 250.000</span>
                <button class="btn-detail mt-auto" data-bs-toggle="modal" data-bs-target="#productModal" 
                  data-title="Batik Modern Kasual" 
                  data-desc="Desain modern untuk tampilan santai namun tetap berbudaya." 
                  data-price="Rp 250.000">
                  Lihat Detail
                </button>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- REKOMENDASI -->
      <aside class="recommend col-lg-4">
        <div class="card">
          <div class="card-body">
            <h3 class="card-title">🌸 Rekomendasi Minggu Ini</h3>
            <div class="recommend-card mt-3">
              <img src="https://i.pinimg.com/1200x/5f/20/d7/5f20d706c762cfaae2f4a0ae6cdef4e9.jpg" class="card-img-top mb-3" alt="Batik Coklat Klasik">
              <h4>Batik Coklat Klasik</h4>
              <p>Motif tradisional, sentuhan elegan.</p>
              <span>Rp 180.000</span>
            </div>
          </div>
        </div>
      </aside>
    </div>
  </main>

  <!-- BAGIAN TENTANG -->
  <section class="about py-5">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6 mb-4 mb-md-0">
          <img src="https://i.pinimg.com/1200x/d4/cc/67/d4cc67cf796c0b79bb29d0e62c5fea4e.jpg" class="img-fluid rounded" alt="Pengrajin Batik">
        </div>
        <div class="col-md-6">
          <div class="about-text">
            <h3>Tentang Batik Nusantara</h3>
            <p>Kami hadir untuk melestarikan warisan batik Indonesia dengan gaya modern dan kualitas terbaik. Setiap helai kain adalah karya seni yang dibuat dengan hati, menghadirkan keindahan dalam setiap kesempatan.</p>
            <a href="#" class="btn-banner">Pelajari Lebih Lanjut</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- TESTIMONI -->
  <section class="testimoni py-5">
    <div class="container">
      <h3 class="text-center mb-4">💬 Apa Kata Pelanggan Kami</h3>
      <div class="row">
        <div class="col-md-4 mb-4">
          <div class="testi-card card h-100">
            <div class="card-body">
              <p class="card-text">"Batiknya halus banget, warnanya mewah. Sangat puas!"</p>
              <h4 class="card-title">- Rina, Surabaya</h4>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="testi-card card h-100">
            <div class="card-body">
              <p class="card-text">"Kualitas premium, pengiriman cepat, dan packaging rapi."</p>
              <h4 class="card-title">- Dimas, Bandung</h4>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="testi-card card h-100">
            <div class="card-body">
              <p class="card-text">"Batik Nusantara bikin tampil elegan tanpa kehilangan nilai budaya."</p>
              <h4 class="card-title">- Sari, Jakarta</h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- MODAL DETAIL PRODUK -->
  <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalTitle">Detail Produk</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p id="modalDesc">Deskripsi produk akan muncul di sini.</p>
          <p id="modalPrice" class="price mt-3">Harga: Rp 0</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="button" class="btn btn-primary">Beli Sekarang</button>
        </div>
      </div>
    </div>
  </div>

  <!-- FOOTER -->
  <footer class="py-4">
    <div class="container">
      <div class="row">
        <div class="col-md-4 mb-4 mb-md-0">
          <h4>Tentang Kami</h4>
          <p>Batik Nusantara mengangkat keindahan kain tradisional dengan inovasi modern. Setiap produk dibuat dengan keahlian tangan terbaik dari pengrajin lokal.</p>
        </div>
        <div class="col-md-4 mb-4 mb-md-0">
          <h4>Bantuan</h4>
          <p>Cara Pemesanan</p>
          <p>Pengiriman</p>
          <p>Retur Barang</p>
        </div>
        <div class="col-md-4">
          <h4>Ikuti Kami</h4>
          <p>Instagram</p>
          <p>Facebook</p>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-12 text-center">
          <p class="copyright">© 2025 Batik Nusantara — by Zaenarif Putra</p>
        </div>
      </div>
    </div>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Custom JS -->
  <script>
    // Event listener untuk modal produk
    document.addEventListener('DOMContentLoaded', function() {
      const productModal = document.getElementById('productModal');
      
      productModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;
        const title = button.getAttribute('data-title');
        const desc = button.getAttribute('data-desc');
        const price = button.getAttribute('data-price');
        
        document.getElementById('modalTitle').textContent = title;
        document.getElementById('modalDesc').textContent = desc;
        document.getElementById('modalPrice').textContent = `Harga: ${price}`;
      });
    });
  </script>

</body>
</html>