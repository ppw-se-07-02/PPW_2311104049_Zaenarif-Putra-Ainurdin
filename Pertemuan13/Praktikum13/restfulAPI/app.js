// app.js
const express = require("express");
const dbOperations = require("./crud");

const app = express();
const port = 3000;

app.use(express.json());

// =====================
// CREATE
// =====================
app.post("/mahasiswaCreate", (req, res) => {
  const { nama, nim, jurusan, email } = req.body;

  dbOperations.createMahasiswa(
    nama,
    nim,
    jurusan,
    email,
    (error) => {
      if (error) {
        return res.status(500).send("Error creating mahasiswa");
      }
      res.status(201).send("Mahasiswa created");
    }
  );
});

// =====================
// READ
// =====================
app.get("/mahasiswaGet", (req, res) => {
  dbOperations.getAllMahasiswa((error, users) => {
    if (error) {
      return res.status(500).send("Error fetching mahasiswa");
    }
    res.json(users);
  });
});

// =====================
// UPDATE
// =====================
app.put("/mahasiswaUpdate/:id", (req, res) => {
  const { id } = req.params;
  const { nama, nim, jurusan, email } = req.body;

  dbOperations.updateMahasiswa(
    id,
    nama,
    nim,
    jurusan,
    email,
    (error) => {
      if (error) {
        return res.status(500).send("Error updating mahasiswa");
      }
      res.send("Mahasiswa updated");
    }
  );
});

// =====================
// DELETE
// =====================
app.delete("/mahasiswaDelete/:id", (req, res) => {
  const { id } = req.params;

  dbOperations.deleteMahasiswa(id, (error) => {
    if (error) {
      return res.status(500).send("Error deleting mahasiswa");
    }
    res.send("Mahasiswa deleted");
  });
});

// =====================
// SERVER
// =====================
app.listen(port, () => {
  console.log(`Server running on http://localhost:${port}`);
});
