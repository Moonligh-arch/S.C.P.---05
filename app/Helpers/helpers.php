<?php

/**
 * Helper format harga ke format Rupiah Indonesia.
 * Contoh: formatRupiah(5999000) → "Rp 5.999.000"
 */
if (!function_exists('formatRupiah')) {
    function formatRupiah(float|int|null $angka): string
    {
        if ($angka === null) {
            return 'Rp 0';
        }

        return 'Rp ' . number_format($angka, 0, ',', '.');
    }
}
