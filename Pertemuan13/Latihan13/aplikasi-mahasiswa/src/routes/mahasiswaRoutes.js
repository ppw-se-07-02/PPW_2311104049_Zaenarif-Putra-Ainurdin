const express = require('express');
const router = express.Router();
const MahasiswaController = require('../controllers/mahasiswaController');

// GET all students
router.get('/', MahasiswaController.getAll);

// GET student by ID
router.get('/:id', MahasiswaController.getById);

// POST create new student
router.post('/', MahasiswaController.create);

// PUT update student
router.put('/:id', MahasiswaController.update);

// DELETE student
router.delete('/:id', MahasiswaController.delete);

// GET search students
router.get('/search/all', MahasiswaController.search);

module.exports = router;