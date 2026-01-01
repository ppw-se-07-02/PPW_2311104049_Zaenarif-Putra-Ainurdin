const mysql = require('mysql2');
require('dotenv').config();

const pool = mysql.createPool({
    host: process.env.DB_HOST || 'localhost',
    user: process.env.DB_USER || 'root',
    password: process.env.DB_PASSWORD || '',
    database: process.env.DB_NAME || 'db_mahasiswa',
    waitForConnections: true,
    connectionLimit: 10,
    queueLimit: 0
});

// Test connection
pool.getConnection((err, connection) => {
    if (err) {
        console.error('❌ Database Tidak Berhasil Tersambung:', err.message);
    } else {
        console.log('✅ Database Berhasil Tersambung');
        connection.release();
    }
});

module.exports = pool.promise();