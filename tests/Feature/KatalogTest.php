<?php

namespace Tests\Feature;

use App\Enums\KategoriProduk;
use App\Models\Merek;
use App\Models\Produk;
use App\Models\User;
use App\Models\VarianProduk;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KatalogTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test tamu dapat mengakses halaman publik katalog.
     */
    public function test_tamu_bisa_mengakses_katalog_publik(): void
    {
        $response = $this->get(route('katalog.index'));
        $response->assertStatus(200);
        $response->assertSee('Katalog Smartphone');
    }

    /**
     * Test tamu dapat melihat detail produk smartphone.
     */
    public function test_tamu_bisa_melihat_detail_produk(): void
    {
        $merek = Merek::create(['nama' => 'Xiaomi']);
        $produk = Produk::create([
            'merek_id'  => $merek->id,
            'nama'      => 'Xiaomi 14 Ultra',
            'kategori'  => KategoriProduk::Flagship,
            'deskripsi' => 'Flagship kamera Leica',
        ]);
        $varian = VarianProduk::create([
            'produk_id'   => $produk->id,
            'ram'         => '16 GB',
            'penyimpanan' => '512 GB',
            'warna'       => 'Black',
            'harga'       => 17999000,
            'stok'        => 5,
        ]);

        $response = $this->get(route('katalog.show', $produk));
        $response->assertStatus(200);
        $response->assertSee('Xiaomi 14 Ultra');
        $response->assertSee('Flagship');
        $response->assertSee('16 GB / 512 GB');
    }

    /**
     * Test pencarian nama smartphone di katalog publik.
     */
    public function test_pencarian_nama_produk_berfungsi(): void
    {
        $merek = Merek::create(['nama' => 'Samsung']);
        $p1 = Produk::create([
            'merek_id'  => $merek->id,
            'nama'      => 'Samsung Galaxy S24 Ultra',
            'kategori'  => KategoriProduk::Flagship,
        ]);
        $p2 = Produk::create([
            'merek_id'  => $merek->id,
            'nama'      => 'Xiaomi Redmi Note 13',
            'kategori'  => KategoriProduk::MidRange,
        ]);

        $response = $this->get(route('katalog.index', ['cari' => 'Galaxy']));
        $response->assertStatus(200);
        $response->assertSee('Samsung Galaxy S24 Ultra');
        $response->assertDontSee('Xiaomi Redmi Note 13');
    }

    /**
     * Test filter berdasarkan merek dan kategori enum.
     */
    public function test_filter_merek_dan_kategori_enum_berfungsi(): void
    {
        $merekA = Merek::create(['nama' => 'POCO']);
        $merekB = Merek::create(['nama' => 'OPPO']);

        $p1 = Produk::create([
            'merek_id'  => $merekA->id,
            'nama'      => 'POCO F6 Pro',
            'kategori'  => KategoriProduk::Gaming,
        ]);
        $p2 = Produk::create([
            'merek_id'  => $merekB->id,
            'nama'      => 'OPPO Reno 11 Pro',
            'kategori'  => KategoriProduk::MidRange,
        ]);

        $response = $this->get(route('katalog.index', [
            'merek'    => $merekA->id,
            'kategori' => KategoriProduk::Gaming->value,
        ]));

        $response->assertStatus(200);
        $response->assertSee('POCO F6 Pro');
        $response->assertDontSee('OPPO Reno 11 Pro');
    }

    /**
     * Test proteksi akses admin: tamu dan non-admin dilarang mengakses route admin.
     */
    public function test_tamu_dan_non_admin_dilarang_akses_admin(): void
    {
        // 1. Tamu diarahkan ke login
        $responseTamu = $this->get(route('admin.produk.index'));
        $responseTamu->assertRedirect(route('login'));

        // 2. Pembeli ditolak dengan 403 Forbidden
        $pembeli = new User([
            'id'    => 1,
            'name'  => 'Pembeli Test',
            'email' => 'pembeli@example.com',
        ]);
        $pembeli->role = 'pembeli';

        $responsePembeli = $this->actingAs($pembeli)->get(route('admin.produk.index'));
        $responsePembeli->assertStatus(403);
    }

    /**
     * Test admin diizinkan mengakses panel admin katalog.
     */
    public function test_admin_bisa_mengakses_admin_katalog(): void
    {
        $admin = new User([
            'id'    => 2,
            'name'  => 'Admin Test',
            'email' => 'admin@example.com',
        ]);
        $admin->role = 'admin';

        $response = $this->actingAs($admin)->get(route('admin.produk.index'));
        $response->assertStatus(200);
    }

    /**
     * Test validasi hapus merek yang masih dipakai produk (ditolak ramah, tidak 500).
     */
    public function test_merek_tidak_bisa_dihapus_jika_masih_memiliki_produk(): void
    {
        $admin = new User(['id' => 3, 'name' => 'Admin']);
        $admin->role = 'admin';

        $merek = Merek::create(['nama' => 'Vivo']);
        Produk::create([
            'merek_id'  => $merek->id,
            'nama'      => 'Vivo X100',
            'kategori'  => KategoriProduk::Flagship,
        ]);

        $response = $this->actingAs($admin)->delete(route('admin.merek.destroy', $merek));
        $response->assertSessionHas('gagal');

        $this->assertDatabaseHas('merek', ['id' => $merek->id]);
    }
}
