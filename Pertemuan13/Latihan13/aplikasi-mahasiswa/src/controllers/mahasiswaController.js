const MahasiswaModel = require('../models/mahasiswaModel');

class MahasiswaController {
    // Get all students
    static async getAll(req, res) {
        try {
            const mahasiswa = await MahasiswaModel.getAll();
            res.json({ 
                success: true, 
                count: mahasiswa.length,
                data: mahasiswa 
            });
        } catch (error) {
            res.status(500).json({ 
                success: false, 
                error: error.message 
            });
        }
    }

    // Get student by ID
    static async getById(req, res) {
        try {
            const mahasiswa = await MahasiswaModel.getById(req.params.id);
            
            if (!mahasiswa) {
                return res.status(404).json({ 
                    success: false, 
                    error: 'Mahasiswa tidak ditemukan' 
                });
            }
            
            res.json({ success: true, data: mahasiswa });
        } catch (error) {
            res.status(500).json({ 
                success: false, 
                error: error.message 
            });
        }
    }

    // Create new student
    static async create(req, res) {
        try {
            const { nim, nama, jurusan, semester, email } = req.body;
            
            // Validation
            if (!nim || !nama || !jurusan) {
                return res.status(400).json({ 
                    success: false, 
                    error: 'NIM, Nama, dan Jurusan wajib diisi' 
                });
            }

            const newMahasiswa = await MahasiswaModel.create(req.body);
            res.status(201).json({ 
                success: true, 
                message: 'Mahasiswa berhasil ditambahkan',
                data: newMahasiswa 
            });
        } catch (error) {
            res.status(500).json({ 
                success: false, 
                error: error.message 
            });
        }
    }

    // Update student
    static async update(req, res) {
        try {
            const { id } = req.params;
            const { nim, nama, jurusan, semester, email } = req.body;
            
            // Validation
            if (!nim || !nama || !jurusan) {
                return res.status(400).json({ 
                    success: false, 
                    error: 'NIM, Nama, dan Jurusan wajib diisi' 
                });
            }

            const updatedMahasiswa = await MahasiswaModel.update(id, req.body);
            res.json({ 
                success: true, 
                message: 'Mahasiswa berhasil diperbarui',
                data: updatedMahasiswa 
            });
        } catch (error) {
            res.status(500).json({ 
                success: false, 
                error: error.message 
            });
        }
    }

    // Delete student
    static async delete(req, res) {
        try {
            await MahasiswaModel.delete(req.params.id);
            res.json({ 
                success: true, 
                message: 'Mahasiswa berhasil dihapus' 
            });
        } catch (error) {
            res.status(500).json({ 
                success: false, 
                error: error.message 
            });
        }
    }

    // Search students
    static async search(req, res) {
        try {
            const { keyword } = req.query;
            const results = await MahasiswaModel.search(keyword);
            res.json({ 
                success: true, 
                keyword: keyword,
                count: results.length,
                data: results 
            });
        } catch (error) {
            res.status(500).json({ 
                success: false, 
                error: error.message 
            });
        }
    }
}

module.exports = MahasiswaController;