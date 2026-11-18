<?php

namespace App\Models;

use App\Enums\KategoriProduk;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Produk extends Model
{
    protected $table = 'produk';

    protected $fillable = [
        'merek_id',
        'nama',
        'kategori',
        'deskripsi',
        'gambar',
    ];

    /**
     * Cast attributes.
     */
    protected function casts(): array
    {
        return [
            'kategori' => KategoriProduk::class,
        ];
    }

    /**
     * Relasi: produk milik satu merek.
     */
    public function merek(): BelongsTo
    {
        return $this->belongsTo(Merek::class, 'merek_id');
    }

    /**
     * Relasi: satu produk punya banyak varian.
     */
    public function varian(): HasMany
    {
        return $this->hasMany(VarianProduk::class, 'produk_id');
    }

    /**
     * Harga terendah dari semua varian (untuk tampilan "mulai dari").
     * Gunakan withMin('varian', 'harga') saat query untuk hindari N+1.
     */
    public function getHargaMulaiAttribute(): ?float
    {
        return (float) ($this->varian_min_harga ?? $this->varian()->min('harga') ?? 0);
    }

    /**
     * Total stok dari seluruh varian produk ini.
     */
    public function getTotalStokAttribute(): int
    {
        return (int) ($this->varian_sum_stok ?? $this->varian()->sum('stok') ?? 0);
    }

    /**
     * URL gambar produk, atau placeholder jika belum ada.
     */
    public function getGambarUrlAttribute(): string
    {
        if ($this->gambar && Storage::disk('public')->exists($this->gambar)) {
            return asset('storage/' . $this->gambar);
        }

        return asset('images/placeholder.png');
    }

    /**
     * Hapus file gambar dari storage.
     */
    public function hapusGambar(): void
    {
        if ($this->gambar && Storage::disk('public')->exists($this->gambar)) {
            Storage::disk('public')->delete($this->gambar);
        }
    }

    /**
     * Event: saat produk dihapus, hapus juga file gambar.
     * Varian dihapus otomatis oleh cascade di level database.
     */
    protected static function booted(): void
    {
        static::deleting(function (Produk $produk) {
            $produk->hapusGambar();
        });
    }
}
