// Konfigurasi API
const API_BASE = '/api/mahasiswa';

// Format JSON untuk tampilan
function formatJSON(data) {
    return JSON.stringify(data, null, 2);
}

// Tampilkan response di box
function showResponse(data) {
    const responseBox = document.getElementById('apiResponse');
    responseBox.innerHTML = `<pre>${formatJSON(data)}</pre>`;
}

// Update data table
function updateTable(data) {
    const tableBody = document.getElementById('tableBody');
    const totalData = document.getElementById('totalData');
    
    if (!data || data.length === 0) {
        tableBody.innerHTML = `
            <tr>
                <td colspan="7" class="text-center text-muted">
                    Tidak ada data mahasiswa
                </td>
            </tr>
        `;
        totalData.textContent = '0';
        return;
    }
    
    let html = '';
    data.forEach(student => {
        html += `
            <tr>
                <td>${student.id}</td>
                <td><strong>${student.nim}</strong></td>
                <td>${student.nama}</td>
                <td>${student.jurusan}</td>
                <td>${student.semester || '-'}</td>
                <td>${student.email || '-'}</td>
                <td>
                    <button class="btn btn-sm btn-warning me-1" onclick="showEditForm(${student.id})">
                        ✏️ Edit
                    </button>
                    <button class="btn btn-sm btn-danger" onclick="confirmDelete(${student.id})">
                        🗑️ Hapus
                    </button>
                </td>
            </tr>
        `;
    });
    
    tableBody.innerHTML = html;
    totalData.textContent = data.length;
}

// Ambil semua data mahasiswa
async function getAllStudents() {
    try {
        const response = await fetch(API_BASE);
        const data = await response.json();
        
        showResponse(data);
        if (data.success && data.data) {
            updateTable(data.data);
        }
        
        return data;
    } catch (error) {
        showResponse({ error: 'Gagal mengambil data: ' + error.message });
    }
}

// Ambil data berdasarkan ID
async function getById() {
    const id = document.getElementById('searchId').value;
    if (!id) {
        alert('Masukkan ID terlebih dahulu');
        return;
    }
    
    try {
        const response = await fetch(`${API_BASE}/${id}`);
        const data = await response.json();
        showResponse(data);
    } catch (error) {
        showResponse({ error: 'Gagal mengambil data: ' + error.message });
    }
}

// Cari mahasiswa
async function searchStudents() {
    const keyword = document.getElementById('searchKeyword').value;
    if (!keyword) {
        alert('Masukkan kata kunci pencarian');
        return;
    }
    
    try {
        const response = await fetch(`${API_BASE}/search/all?keyword=${encodeURIComponent(keyword)}`);
        const data = await response.json();
        showResponse(data);
        if (data.success && data.data) {
            updateTable(data.data);
        }
    } catch (error) {
        showResponse({ error: 'Gagal mencari: ' + error.message });
    }
}

// Tampilkan form tambah
function showAddForm() {
    const modal = new bootstrap.Modal(document.getElementById('addModal'));
    modal.show();
}

// Submit form tambah
async function submitAddForm() {
    const data = {
        nim: document.getElementById('addNim').value,
        nama: document.getElementById('addNama').value,
        jurusan: document.getElementById('addJurusan').value,
        semester: document.getElementById('addSemester').value || null,
        email: document.getElementById('addEmail').value || null
    };
    
    // Validasi
    if (!data.nim || !data.nama || !data.jurusan) {
        alert('NIM, Nama, dan Jurusan wajib diisi!');
        return;
    }
    
    try {
        const response = await fetch(API_BASE, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });
        
        const result = await response.json();
        showResponse(result);
        
        if (result.success) {
            // Tutup modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('addModal'));
            modal.hide();
            
            // Reset form
            document.getElementById('addForm').reset();
            
            // Refresh data
            getAllStudents();
        }
    } catch (error) {
        showResponse({ error: 'Gagal menambah data: ' + error.message });
    }
}

// Fungsi untuk menampilkan form edit berdasarkan ID dari tabel
async function showEditForm(id) {
    try {
        // Ambil data mahasiswa berdasarkan ID
        const response = await fetch(`${API_BASE}/${id}`);
        const result = await response.json();
        
        if (result.success && result.data) {
            const student = result.data;
            
            // Isi form dengan data yang ada
            document.getElementById('editId').value = student.id;
            document.getElementById('editNim').value = student.nim;
            document.getElementById('editNama').value = student.nama;
            document.getElementById('editJurusan').value = student.jurusan;
            document.getElementById('editSemester').value = student.semester || '';
            document.getElementById('editEmail').value = student.email || '';
            
            // Tampilkan modal
            const modal = new bootstrap.Modal(document.getElementById('editModal'));
            modal.show();
        } else {
            alert('Data tidak ditemukan');
        }
    } catch (error) {
        showResponse({ error: 'Gagal mengambil data: ' + error.message });
    }
}

// Fungsi untuk menampilkan form edit berdasarkan input ID
async function showEditFormById() {
    const id = document.getElementById('editIdInput').value;
    if (!id) {
        alert('Masukkan ID terlebih dahulu');
        return;
    }
    
    await showEditForm(id);
}

// Fungsi untuk submit form edit
async function submitEditForm() {
    const id = document.getElementById('editId').value;
    const data = {
        nim: document.getElementById('editNim').value,
        nama: document.getElementById('editNama').value,
        jurusan: document.getElementById('editJurusan').value,
        semester: document.getElementById('editSemester').value || null,
        email: document.getElementById('editEmail').value || null
    };
    
    // Validasi
    if (!data.nim || !data.nama || !data.jurusan) {
        alert('NIM, Nama, dan Jurusan wajib diisi!');
        return;
    }
    
    try {
        const response = await fetch(`${API_BASE}/${id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });
        
        const result = await response.json();
        showResponse(result);
        
        if (result.success) {
            // Tutup modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('editModal'));
            modal.hide();
            
            // Refresh data
            getAllStudents();
        }
    } catch (error) {
        showResponse({ error: 'Gagal mengupdate data: ' + error.message });
    }
}

// Hapus data
async function deleteStudent() {
    const id = document.getElementById('deleteId').value;
    if (!id) {
        alert('Masukkan ID terlebih dahulu');
        return;
    }
    
    if (!confirm(`Apakah Anda yakin ingin menghapus data dengan ID ${id}?`)) {
        return;
    }
    
    try {
        const response = await fetch(`${API_BASE}/${id}`, {
            method: 'DELETE'
        });
        
        const result = await response.json();
        showResponse(result);
        
        if (result.success) {
            // Refresh data
            getAllStudents();
            document.getElementById('deleteId').value = '';
        }
    } catch (error) {
        showResponse({ error: 'Gagal menghapus data: ' + error.message });
    }
}

// Konfirmasi hapus dari tabel
function confirmDelete(id) {
    if (confirm(`Hapus mahasiswa dengan ID ${id}?`)) {
        fetch(`${API_BASE}/${id}`, {
            method: 'DELETE'
        })
        .then(response => response.json())
        .then(result => {
            showResponse(result);
            if (result.success) {
                getAllStudents();
            }
        })
        .catch(error => {
            showResponse({ error: 'Gagal menghapus: ' + error.message });
        });
    }
}

// Test API connection
async function testAPI() {
    try {
        const response = await fetch('/api/test');
        const data = await response.json();
        showResponse(data);
    } catch (error) {
        showResponse({ error: 'API tidak terhubung: ' + error.message });
    }
}

// Tambah data contoh
async function addSampleData() {
    const sampleData = {
        nim: '2021' + Math.floor(Math.random() * 10000).toString().padStart(4, '0'),
        nama: 'Mahasiswa Contoh',
        jurusan: 'Teknik Informatika',
        semester: Math.floor(Math.random() * 8) + 1,
        email: `contoh${Math.floor(Math.random() * 1000)}@example.com`
    };
    
    try {
        const response = await fetch(API_BASE, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(sampleData)
        });
        
        const result = await response.json();
        showResponse(result);
        
        if (result.success) {
            getAllStudents();
        }
    } catch (error) {
        showResponse({ error: 'Gagal menambah data contoh: ' + error.message });
    }
}

// Inisialisasi saat halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
    // Load data awal
    getAllStudents();
    testAPI();
    
    // Update port info
    const serverPort = window.location.port || '3000';
    document.getElementById('serverPort').textContent = serverPort;
});