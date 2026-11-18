<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Merek extends Model
{
    protected $table = 'merek';

    protected $fillable = ['nama'];

    /**
     * Relasi: satu merek punya banyak produk.
     */
    public function produk(): HasMany
    {
        return $this->hasMany(Produk::class, 'merek_id');
    }

    /**
     * Cek apakah merek masih dipakai oleh produk.
     * Digunakan sebelum hapus supaya tidak error FK.
     */
    public function bisaDihapus(): bool
    {
        return $this->produk()->count() === 0;
    }
}
