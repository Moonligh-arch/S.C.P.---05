<?php

namespace App\Enums;

enum KategoriProduk: string
{
    case Flagship = 'Flagship';
    case MidRange = 'Mid-range';
    case EntryLevel = 'Entry-level';
    case Gaming = 'Gaming';

    /**
     * Label manusiawi untuk ditampilkan di view / dropdown.
     */
    public function label(): string
    {
        return match ($this) {
            self::Flagship   => 'Flagship',
            self::MidRange   => 'Mid-range',
            self::EntryLevel => 'Entry-level',
            self::Gaming     => 'Gaming',
        };
    }

    /**
     * Mengambil semua nilai string enum.
     *
     * @return array<string>
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
