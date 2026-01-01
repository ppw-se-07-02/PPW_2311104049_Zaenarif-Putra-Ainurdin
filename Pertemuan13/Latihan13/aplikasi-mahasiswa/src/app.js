const express = require('express');
const cors = require('cors');
require('dotenv').config();

const mahasiswaRoutes = require('./routes/mahasiswaRoutes');

const app = express();
const PORT = process.env.PORT || 3000;

// Middleware
app.use(cors());
app.use(express.json());
app.use(express.urlencoded({ extended: true }));
app.use(express.static('src/public'));

// Routes
app.use('/api/mahasiswa', mahasiswaRoutes);

// Test route
app.get('/api/test', (req, res) => {
    res.json({ 
        success: true, 
        message: 'API Mahasiswa is running!',
        endpoints: {
            getAll: 'GET /api/mahasiswa',
            getById: 'GET /api/mahasiswa/:id',
            create: 'POST /api/mahasiswa',
            update: 'PUT /api/mahasiswa/:id',
            delete: 'DELETE /api/mahasiswa/:id',
            search: 'GET /api/mahasiswa/search/all?keyword=...'
        }
    });
});

// Home route
app.get('/', (req, res) => {
    res.sendFile(__dirname + '/public/index.html');
});

// 404 handler
app.use((req, res) => {
    res.status(404).json({
        success: false,
        error: 'Endpoint tidak ditemukan'
    });
});

// Error handler
app.use((err, req, res, next) => {
    console.error(err.stack);
    res.status(500).json({
        success: false,
        error: 'Terjadi kesalahan server'
    });
});

// Start server
app.listen(PORT, () => {
    console.log('='.repeat(50));
    console.log(`🚀 SERVER BERJALAN DI: http://localhost:${PORT}`);
    console.log(`📊 DATABASE: ${process.env.DB_NAME}`);
    console.log('='.repeat(50));
    console.log('📌 ENDPOINTS:');
    console.log(`   Halaman Web: http://localhost:${PORT}`);
    console.log(`   Test API: http://localhost:${PORT}/api/test`);
    console.log(`   Data Mahasiswa: http://localhost:${PORT}/api/mahasiswa`);
    console.log('='.repeat(50));
});