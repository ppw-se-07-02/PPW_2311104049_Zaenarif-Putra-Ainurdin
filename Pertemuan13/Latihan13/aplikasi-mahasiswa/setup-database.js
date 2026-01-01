const mysql = require('mysql2');
require('dotenv').config();

const connection = mysql.createConnection({
    host: process.env.DB_HOST || 'localhost',
    user: process.env.DB_USER || 'root',
    password: process.env.DB_PASSWORD || ''
});

async function setupDatabase() {
    try {
        console.log('🔧 Setting up database...');
        
        // Create database
        await connection.promise().query(`CREATE DATABASE IF NOT EXISTS \`${process.env.DB_NAME || 'db_mahasiswa'}\``);
        console.log('✅ Database created');
        
        // Use database
        await connection.promise().query(`USE \`${process.env.DB_NAME || 'db_mahasiswa'}\``);
        
        // Create table
        const createTableSQL = `
            CREATE TABLE IF NOT EXISTS mahasiswa (
                id INT PRIMARY KEY AUTO_INCREMENT,
                nim VARCHAR(20) UNIQUE NOT NULL,
                nama VARCHAR(100) NOT NULL,
                jurusan VARCHAR(50) NOT NULL,
                semester INT,
                email VARCHAR(100),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )
        `;
        
        await connection.promise().query(createTableSQL);
        console.log('✅ Table created');
        
        // Insert sample data
        const sampleData = [
            ['20210001', 'Ahmad Rizki', 'Teknik Informatika', 5, 'ahmad@example.com'],
            ['20210002', 'Siti Nurhaliza', 'Sistem Informasi', 3, 'siti@example.com'],
            ['20210003', 'Budi Santoso', 'Teknik Komputer', 7, 'budi@example.com'],
            ['20210004', 'Dewi Lestari', 'Manajemen Informatika', 4, 'dewi@example.com'],
            ['20210005', 'Rina Wijaya', 'Teknik Elektro', 6, 'rina@example.com']
        ];
        
        for (const data of sampleData) {
            await connection.promise().query(
                'INSERT IGNORE INTO mahasiswa (nim, nama, jurusan, semester, email) VALUES (?, ?, ?, ?, ?)',
                data
            );
        }
        
        console.log('✅ Sample data inserted');
        console.log('🎉 Database setup completed!');
        
    } catch (error) {
        console.error('❌ Error:', error.message);
    } finally {
        connection.end();
    }
}

setupDatabase();