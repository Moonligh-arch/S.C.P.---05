<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VarianProduk extends Model
{
    protected $table = 'varian_produk';

    protected $fillable = [
        'produk_id',
        'ram',
        'penyimpanan',
        'warna',
        'harga',
        'stok',
    ];

    /**
     * Cast tipe data supaya konsisten.
     */
    protected function casts(): array
    {
        return [
            'harga' => 'decimal:2',
            'stok'  => 'integer',
        ];
    }

    /**
     * Relasi: varian milik satu produk.
     */
    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }

    /**
     * Label stok untuk tampilan di halaman detail.
     */
    public function getLabelStokAttribute(): string
    {
        if ($this->stok === 0) {
            return 'Habis';
        }

        if ($this->stok <= 5) {
            return 'Stok Menipis';
        }

        return 'Tersedia';
    }

    /**
     * Warna badge sesuai status stok (untuk Bootstrap).
     */
    public function getBadgeStokAttribute(): string
    {
        return match (true) {
            $this->stok === 0  => 'danger',
            $this->stok <= 5   => 'warning',
            default            => 'success',
        };
    }

    /**
     * Cek apakah varian bisa dihapus.
     * Saat ini selalu true. Nanti modul Transaksi bisa override logic ini
     * untuk mengecek apakah varian sudah pernah dipesan.
     *
     * TODO: tambahkan pengecekan relasi detailPesanan oleh tim Transaksi
     */
    public function bisaDihapus(): bool
    {
        return true;
    }

    /**
     * Deskripsi ringkas varian (untuk label).
     */
    public function getLabelAttribute(): string
    {
        return "{$this->ram} / {$this->penyimpanan} - {$this->warna}";
    }
}
