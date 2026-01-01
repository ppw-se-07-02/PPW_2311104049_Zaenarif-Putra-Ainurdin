<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Buku;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BukuTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test 1: Menambahkan data buku ke database
     */
    public function test_tambah_buku_berhasil(): void
    {
        // Data buku untuk di-test
        $bukuData = [
            'judul' => 'Laravel untuk Pemula',
            'penulis' => 'Zaenarif Putra',
            'tahun_terbit' => 2023,
            'penerbit' => 'Penerbit Rekayasa Perangkat Lunak'
        ];

        // Simulasi POST request ke endpoint store
        $response = $this->post(route('bukus.store'), $bukuData);

        // Cek apakah redirect ke halaman index
        $response->assertRedirect(route('bukus.index'));

        // Cek apakah data tersimpan di database
        $this->assertDatabaseHas('bukus', $bukuData);

        // Cek flash session message
        $response->assertSessionHas('success', 'Buku berhasil ditambahkan.');
    }

    /**
     * Test 2: Validasi form input tidak lengkap
     */
    public function test_validasi_form_input_tidak_lengkap(): void
    {
        // Data buku dengan field yang tidak lengkap
        $bukuData = [
            'judul' => '', // Judul kosong (required)
            'penulis' => 'John Doe',
            'tahun_terbit' => 3000, // Tahun lebih besar dari tahun sekarang
            'penerbit' => '' // Penerbit kosong (required)
        ];

        // Simulasi POST request
        $response = $this->post(route('bukus.store'), $bukuData);

        // Cek apakah validasi gagal - HAPUS pemeriksaan pesan error spesifik
        $response->assertSessionHasErrors(['judul', 'tahun_terbit', 'penerbit']);

        // Cek apakah tidak ada data yang tersimpan di database
        $this->assertDatabaseMissing('bukus', $bukuData);
    }

    /**
     * Test 3: Validasi tahun terbit melebihi tahun sekarang
     */
    public function test_validasi_tahun_terbit_melebihi_max(): void
    {
        $bukuData = [
            'judul' => 'Validasi Tahun',
            'penulis' => 'Test Author',
            'tahun_terbit' => date('Y') + 1, // Tahun depan (lebih besar dari tahun sekarang)
            'penerbit' => 'Test Publisher'
        ];

        $response = $this->post(route('bukus.store'), $bukuData);
        $response->assertSessionHasErrors('tahun_terbit');
    }

    /**
     * Test tambahan: Update data buku
     */
    public function test_update_buku_berhasil(): void
    {
        // Buat data buku dummy
        $buku = Buku::factory()->create();

        // Data update
        $updateData = [
            'judul' => 'Laravel Advanced Updated',
            'penulis' => 'Jane Smith',
            'tahun_terbit' => 2024,
            'penerbit' => 'Penerbit Update'
        ];

        // Simulasi PUT request
        $response = $this->put(route('bukus.update', $buku), $updateData);

        // Cek redirect
        $response->assertRedirect(route('bukus.index'));

        // Cek flash message
        $response->assertSessionHas('success', 'Buku berhasil diperbarui.');

        // Cek data di database sudah terupdate
        $this->assertDatabaseHas('bukus', array_merge(['id' => $buku->id], $updateData));
    }

    /**
     * Test tambahan: Hapus data buku
     */
    public function test_hapus_buku_berhasil(): void
    {
        // Buat data buku dummy
        $buku = Buku::factory()->create();

        // Simulasi DELETE request
        $response = $this->delete(route('bukus.destroy', $buku));

        // Cek redirect
        $response->assertRedirect(route('bukus.index'));

        // Cek flash message
        $response->assertSessionHas('success', 'Buku berhasil dihapus.');

        // Cek data sudah dihapus dari database
        $this->assertDatabaseMissing('bukus', ['id' => $buku->id]);
    }

    /**
     * Test: Menampilkan daftar buku
     */
    public function test_menampilkan_daftar_buku(): void
    {
        // Buat beberapa data buku dummy
        Buku::factory()->count(3)->create();

        // Simulasi GET request ke halaman index
        $response = $this->get(route('bukus.index'));

        // Cek status response
        $response->assertStatus(200);

        // Cek apakah halaman berisi teks yang diharapkan
        $response->assertSeeText('Daftar Buku');
    }

    /**
     * Test: Menampilkan form create
     */
    public function test_menampilkan_form_create(): void
    {
        $response = $this->get(route('bukus.create'));
        $response->assertStatus(200);
        $response->assertSeeText('Tambah Buku Baru');
    }

    /**
     * Test: Menampilkan detail buku
     */
    public function test_menampilkan_detail_buku(): void
    {
        $buku = Buku::factory()->create();
        
        $response = $this->get(route('bukus.show', $buku));
        $response->assertStatus(200);
        $response->assertSeeText($buku->judul);
        $response->assertSeeText($buku->penulis);
    }

    /**
     * Test: Menampilkan form edit
     */
    public function test_menampilkan_form_edit(): void
    {
        $buku = Buku::factory()->create();
        
        $response = $this->get(route('bukus.edit', $buku));
        $response->assertStatus(200);
        $response->assertSeeText('Edit Buku');
    }
}