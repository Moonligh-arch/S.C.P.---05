<?php

namespace Database\Seeders;

use App\Enums\KategoriProduk;
use App\Models\Merek;
use App\Models\Produk;
use App\Models\VarianProduk;
use Illuminate\Database\Seeder;

class KatalogSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Merek Smartphone
        $daftarMerek = ['Xiaomi', 'POCO', 'OPPO', 'vivo', 'Samsung', 'Realme'];
        $merek = collect($daftarMerek)->mapWithKeys(fn ($nama) => [
            $nama => Merek::firstOrCreate(['nama' => $nama]),
        ]);

        // 2. Data Produk Smartphone (deskripsi memuat ringkasan dan rincian spesifikasi)
        $dataProduk = [
            // Xiaomi
            [
                'nama' => 'Xiaomi 14 Ultra',
                'merek' => 'Xiaomi',
                'kategori' => KategoriProduk::Flagship,
                'deskripsi' => "Smartphone flagship Xiaomi dengan konfigurasi kamera Leica profesional dan bodi premium.\n\nLayar: 6.73 inci LTPO AMOLED, 120Hz, 3200x1440 piksel\nChipset: Qualcomm Snapdragon 8 Gen 3 (4 nm)\nKamera Belakang: Quad 50 MP (Leica) + 50 MP Ultrawide + 50 MP Telephoto + 50 MP Periscope\nKamera Depan: 32 MP\nBaterai: 5000 mAh, 90W HyperCharge, 80W Wireless\nSistem Operasi: Android 14, Xiaomi HyperOS\nFitur: IP68 tahan air, In-display fingerprint, NFC, Stereo Speakers",
                'varian' => [
                    ['ram' => '12 GB', 'penyimpanan' => '256 GB', 'warna' => 'Black', 'harga' => 15999000, 'stok' => 10],
                    ['ram' => '16 GB', 'penyimpanan' => '512 GB', 'warna' => 'White', 'harga' => 17999000, 'stok' => 4],
                    ['ram' => '16 GB', 'penyimpanan' => '512 GB', 'warna' => 'Black', 'harga' => 17999000, 'stok' => 2],
                ],
            ],
            [
                'nama' => 'Xiaomi Redmi Note 13',
                'merek' => 'Xiaomi',
                'kategori' => KategoriProduk::MidRange,
                'deskripsi' => "Smartphone harian andalan dengan kamera 108 MP dan layar AMOLED 120Hz yang jernih.\n\nLayar: 6.67 inci AMOLED, 120Hz, FHD+\nChipset: Qualcomm Snapdragon 685 (6 nm)\nKamera Belakang: 108 MP Utama + 8 MP Ultrawide + 2 MP Macro\nKamera Depan: 16 MP\nBaterai: 5000 mAh, 33W Fast Charging\nSistem Operasi: Android 13, MIUI 14 (dapat update HyperOS)\nFitur: 3.5mm headphone jack, NFC, IP54",
                'varian' => [
                    ['ram' => '6 GB', 'penyimpanan' => '128 GB', 'warna' => 'Midnight Black', 'harga' => 2399000, 'stok' => 20],
                    ['ram' => '8 GB', 'penyimpanan' => '256 GB', 'warna' => 'Ice Blue', 'harga' => 2799000, 'stok' => 12],
                    ['ram' => '8 GB', 'penyimpanan' => '256 GB', 'warna' => 'Mint Green', 'harga' => 2799000, 'stok' => 0], // Stok habis
                ],
            ],

            // POCO
            [
                'nama' => 'POCO F6 Pro',
                'merek' => 'POCO',
                'kategori' => KategoriProduk::Gaming,
                'deskripsi' => "Monster gaming dengan Snapdragon 8 Gen 2 dan pengisian daya super cepat 120W.\n\nLayar: 6.67 inci Flow AMOLED, 120Hz, WQHD+ (3200x1440)\nChipset: Qualcomm Snapdragon 8 Gen 2 (4 nm)\nKamera Belakang: 50 MP OIS + 8 MP Ultrawide + 2 MP Macro\nBaterai: 5000 mAh, 120W HyperCharge (100% dalam 19 menit)\nSistem Pendingin: LiquidCool Technology 4.0 dengan Iceloop\nSistem Operasi: Android 14, Xiaomi HyperOS",
                'varian' => [
                    ['ram' => '12 GB', 'penyimpanan' => '256 GB', 'warna' => 'Black', 'harga' => 6499000, 'stok' => 15],
                    ['ram' => '16 GB', 'penyimpanan' => '512 GB', 'warna' => 'White', 'harga' => 7499000, 'stok' => 8],
                    ['ram' => '16 GB', 'penyimpanan' => '1 TB', 'warna' => 'Black', 'harga' => 8499000, 'stok' => 3], // Stok menipis
                ],
            ],
            [
                'nama' => 'POCO M6 Pro',
                'merek' => 'POCO',
                'kategori' => KategoriProduk::EntryLevel,
                'deskripsi' => "Smartphone entry-level bertenaga Helio G99 Ultra dengan layar AMOLED 120Hz pertama di M series.\n\nLayar: 6.67 inci Flow AMOLED FHD+, 120Hz\nChipset: MediaTek Helio G99-Ultra (6 nm)\nKamera Belakang: 64 MP OIS + 8 MP Ultrawide + 2 MP Macro\nBaterai: 5000 mAh, 67W Turbo Charging\nFitur: Dual Speakers, IR Blaster, NFC, Jack Audio 3.5mm",
                'varian' => [
                    ['ram' => '8 GB', 'penyimpanan' => '256 GB', 'warna' => 'Black', 'harga' => 2699000, 'stok' => 25],
                    ['ram' => '8 GB', 'penyimpanan' => '256 GB', 'warna' => 'Blue', 'harga' => 2699000, 'stok' => 18],
                ],
            ],

            // OPPO
            [
                'nama' => 'OPPO Find X7 Ultra',
                'merek' => 'OPPO',
                'kategori' => KategoriProduk::Flagship,
                'deskripsi' => "Fotografi mobile tanpa kompromi dengan sistem Quad Main Camera Hasselblad dan dual periscope.\n\nLayar: 6.82 inci LTPO AMOLED, 120Hz, QHD+\nChipset: Qualcomm Snapdragon 8 Gen 3\nKamera: Quad 50 MP (Sensor 1 inci Sony LYT-900) + 50 MP Ultrawide + 50 MP Periscope 3x + 50 MP Periscope 6x\nBaterai: 5000 mAh, 100W SUPERVOOC, 50W AIRVOOC\nSertifikasi: IP68 dust/water resistant",
                'varian' => [
                    ['ram' => '12 GB', 'penyimpanan' => '256 GB', 'warna' => 'Ocean Blue', 'harga' => 16499000, 'stok' => 6],
                    ['ram' => '16 GB', 'penyimpanan' => '512 GB', 'warna' => 'Sepia Brown', 'harga' => 18499000, 'stok' => 3],
                ],
            ],
            [
                'nama' => 'OPPO Reno 11 Pro 5G',
                'merek' => 'OPPO',
                'kategori' => KategoriProduk::MidRange,
                'deskripsi' => "Spesialis potret dengan desain bodi kurva 3D elegan dan kamera telefoto 32 MP.\n\nLayar: 6.7 inci Curved OLED, 120Hz, HDR10+\nChipset: MediaTek Dimensity 8200 (4 nm)\nKamera: 50 MP OIS + 32 MP Telephoto Portrait + 8 MP Ultrawide\nBaterai: 4600 mAh, 80W SUPERVOOC\nSistem Operasi: ColorOS 14 berbasis Android 14",
                'varian' => [
                    ['ram' => '12 GB', 'penyimpanan' => '512 GB', 'warna' => 'Pearl White', 'harga' => 8999000, 'stok' => 9],
                    ['ram' => '12 GB', 'penyimpanan' => '512 GB', 'warna' => 'Rock Grey', 'harga' => 8999000, 'stok' => 5],
                ],
            ],

            // vivo
            [
                'nama' => 'vivo X100 Pro',
                'merek' => 'vivo',
                'kategori' => KategoriProduk::Flagship,
                'deskripsi' => "Master fotografi telefoto dengan optik ZEISS APO dan chip imaging vivo V3.\n\nLayar: 6.78 inci LTPO AMOLED, 120Hz, 3000 nits peak\nChipset: MediaTek Dimensity 9300 (4 nm)\nKamera: 50 MP 1 inci ZEISS + 50 MP Ultrawide + 50 MP ZEISS APO Telephoto\nBaterai: 5400 mAh, 100W FlashCharge, 50W Wireless\nSistem Operasi: Funtouch OS 14 berbasis Android 14",
                'varian' => [
                    ['ram' => '16 GB', 'penyimpanan' => '512 GB', 'warna' => 'Asteroid Black', 'harga' => 15999000, 'stok' => 7],
                    ['ram' => '16 GB', 'penyimpanan' => '512 GB', 'warna' => 'Sunset Orange', 'harga' => 15999000, 'stok' => 2],
                ],
            ],
            [
                'nama' => 'vivo Y27s',
                'merek' => 'vivo',
                'kategori' => KategoriProduk::EntryLevel,
                'deskripsi' => "Smartphone entry-level andal dengan baterai awet, desain memukau, dan tahan percikan air.\n\nLayar: 6.64 inci LCD FHD+, 90Hz\nChipset: Qualcomm Snapdragon 680\nKamera: 50 MP Kamera Utama + 2 MP Bokeh\nBaterai: 5000 mAh, 44W FlashCharge\nSertifikasi: IP54 Tahan Debu dan Percikan Air",
                'varian' => [
                    ['ram' => '8 GB', 'penyimpanan' => '128 GB', 'warna' => 'Burgundy Black', 'harga' => 2199000, 'stok' => 15],
                    ['ram' => '8 GB', 'penyimpanan' => '256 GB', 'warna' => 'Garden Green', 'harga' => 2599000, 'stok' => 10],
                ],
            ],

            // Samsung
            [
                'nama' => 'Samsung Galaxy S24 Ultra',
                'merek' => 'Samsung',
                'kategori' => KategoriProduk::Flagship,
                'deskripsi' => "Era baru Galaxy AI dengan bingkai Titanium, stylus S-Pen terintegrasi, dan kamera 200 MP.\n\nLayar: 6.8 inci Dynamic AMOLED 2X, 120Hz, QHD+, Corning Gorilla Armor\nChipset: Qualcomm Snapdragon 8 Gen 3 for Galaxy\nKamera: 200 MP Utama OIS + 50 MP Periscope 5x + 10 MP Telephoto 3x + 12 MP Ultrawide\nBaterai: 5000 mAh, 45W Fast Charging\nFitur AI: Circle to Search, Live Translate, Note Assist\nProteksi: IP68 tahan air dan debu",
                'varian' => [
                    ['ram' => '12 GB', 'penyimpanan' => '256 GB', 'warna' => 'Titanium Gray', 'harga' => 21999000, 'stok' => 8],
                    ['ram' => '12 GB', 'penyimpanan' => '512 GB', 'warna' => 'Titanium Black', 'harga' => 23999000, 'stok' => 5],
                    ['ram' => '12 GB', 'penyimpanan' => '1 TB', 'warna' => 'Titanium Violet', 'harga' => 27999000, 'stok' => 1], // Stok menipis
                ],
            ],
            [
                'nama' => 'Samsung Galaxy A55 5G',
                'merek' => 'Samsung',
                'kategori' => KategoriProduk::MidRange,
                'deskripsi' => "Pilihan mid-range premium dengan bodi metal, keamanan Samsung Knox Vault, dan kamera Nightography.\n\nLayar: 6.6 inci Super AMOLED, 120Hz, FHD+, HDR10+\nChipset: Samsung Exynos 1480 dengan GPU AMD Xclipse 530\nKamera: 50 MP OIS + 12 MP Ultrawide + 5 MP Macro\nBaterai: 5000 mAh, 25W Fast Charging\nSertifikasi: IP67 tahan air hingga 1 meter selama 30 menit",
                'varian' => [
                    ['ram' => '8 GB', 'penyimpanan' => '128 GB', 'warna' => 'Awesome Navy', 'harga' => 5999000, 'stok' => 14],
                    ['ram' => '8 GB', 'penyimpanan' => '256 GB', 'warna' => 'Awesome Iceblue', 'harga' => 6499000, 'stok' => 11],
                    ['ram' => '12 GB', 'penyimpanan' => '256 GB', 'warna' => 'Awesome Lilac', 'harga' => 6899000, 'stok' => 0], // Stok habis
                ],
            ],

            // Realme
            [
                'nama' => 'Realme GT 6',
                'merek' => 'Realme',
                'kategori' => KategoriProduk::Gaming,
                'deskripsi' => "Flagship killer bertenaga Snapdragon 8s Gen 3 dengan layar 6000 nits Ultra Bright Display.\n\nLayar: 6.78 inci 8T LTPO AMOLED, 120Hz, 6000 nits Peak Brightness\nChipset: Qualcomm Snapdragon 8s Gen 3 (4 nm)\nKamera: 50 MP Sony LYT-808 OIS + 50 MP Telephoto + 8 MP Ultrawide\nBaterai: 5500 mAh, 120W SUPERVOOC (50% dalam 10 menit)\nFitur Gaming: Dual VC Cooling, Geek Power Tuning",
                'varian' => [
                    ['ram' => '12 GB', 'penyimpanan' => '256 GB', 'warna' => 'Fluid Silver', 'harga' => 7499000, 'stok' => 12],
                    ['ram' => '16 GB', 'penyimpanan' => '512 GB', 'warna' => 'Razor Green', 'harga' => 8499000, 'stok' => 6],
                ],
            ],
            [
                'nama' => 'Realme C67',
                'merek' => 'Realme',
                'kategori' => KategoriProduk::EntryLevel,
                'deskripsi' => "Juara smartphone entry level dengan kamera 108 MP 3x In-sensor Zoom dan bodi tertipis 7.59mm.\n\nLayar: 6.72 inci FHD+, 90Hz\nChipset: Qualcomm Snapdragon 685 (6 nm)\nKamera: 108 MP Utama + 2 MP Depth\nBaterai: 5000 mAh, 33W SUPERVOOC Charge\nFitur: Mini Capsule 2.0, IP54 Water Resistance, Stereo Speakers",
                'varian' => [
                    ['ram' => '8 GB', 'penyimpanan' => '128 GB', 'warna' => 'Sunny Oasis', 'harga' => 2299000, 'stok' => 22],
                    ['ram' => '8 GB', 'penyimpanan' => '256 GB', 'warna' => 'Black Rock', 'harga' => 2699000, 'stok' => 16],
                ],
            ],
        ];

        // 3. Masukkan Produk dan Varian ke Database
        foreach ($dataProduk as $item) {
            $produk = Produk::create([
                'merek_id'  => $merek[$item['merek']]->id,
                'kategori'  => $item['kategori'],
                'nama'      => $item['nama'],
                'deskripsi' => $item['deskripsi'],
                'gambar'    => null, // Placeholder gambar digunakan saat gambar null
            ]);

            foreach ($item['varian'] as $v) {
                VarianProduk::create(array_merge($v, ['produk_id' => $produk->id]));
            }
        }
    }
}
