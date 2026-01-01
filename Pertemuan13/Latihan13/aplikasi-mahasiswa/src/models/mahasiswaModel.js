const db = require('../config/database');

class MahasiswaModel {
    // Get all students
    static async getAll() {
        const [rows] = await db.query('SELECT * FROM mahasiswa ORDER BY id DESC');
        return rows;
    }

    // Get student by ID
    static async getById(id) {
        const [rows] = await db.query('SELECT * FROM mahasiswa WHERE id = ?', [id]);
        return rows[0];
    }

    // Create new student
    static async create(data) {
        const { nim, nama, jurusan, semester, email } = data;
        const [result] = await db.query(
            'INSERT INTO mahasiswa (nim, nama, jurusan, semester, email) VALUES (?, ?, ?, ?, ?)',
            [nim, nama, jurusan, semester, email]
        );
        return { id: result.insertId, ...data };
    }

    // Update student
    static async update(id, data) {
        const { nim, nama, jurusan, semester, email } = data;
        await db.query(
            'UPDATE mahasiswa SET nim = ?, nama = ?, jurusan = ?, semester = ?, email = ? WHERE id = ?',
            [nim, nama, jurusan, semester, email, id]
        );
        return { id, ...data };
    }

    // Delete student
    static async delete(id) {
        await db.query('DELETE FROM mahasiswa WHERE id = ?', [id]);
        return true;
    }

    // Search students
    static async search(keyword) {
        const [rows] = await db.query(
            'SELECT * FROM mahasiswa WHERE nama LIKE ? OR nim LIKE ? OR jurusan LIKE ?',
            [`%${keyword}%`, `%${keyword}%`, `%${keyword}%`]
        );
        return rows;
    }
}

module.exports = MahasiswaModel;