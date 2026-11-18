<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('varian_produk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produk_id')->constrained('produk')->cascadeOnDelete();
            $table->string('ram', 50);
            $table->string('penyimpanan', 50);
            $table->string('warna', 100);
            $table->decimal('harga', 12, 2);
            $table->unsignedInteger('stok')->default(0);
            $table->timestamps();

            // Kombinasi unik: satu produk tidak boleh punya varian duplikat
            $table->unique(['produk_id', 'ram', 'penyimpanan', 'warna'], 'varian_unik');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('varian_produk');
    }
};
