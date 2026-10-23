<?php

namespace App\Support;

class Locale
{
    public const EN = 'en';

    public const KM = 'km';

    public static function all(): array
    {
        return [
            self::EN => 'English',
            self::KM => 'ខ្មែរ',
        ];
    }

    public static function current(): string
    {
        $locale = session('locale', config('app.locale', self::EN));

        return array_key_exists($locale, self::all()) ? $locale : self::EN;
    }

    public static function isKhmer(): bool
    {
        return self::current() === self::KM;
    }

    public static function set(string $locale): void
    {
        if (! array_key_exists($locale, self::all())) {
            $locale = self::EN;
        }

        session(['locale' => $locale]);
        app()->setLocale($locale);
    }

    /**
     * Prefer localized value, fall back to English.
     */
    public static function pick(?string $en, ?string $km = null): ?string
    {
        if (self::isKhmer()) {
            return filled($km) ? $km : $en;
        }

        return $en;
    }

    public static function pickArray(?array $en, ?array $km = null): array
    {
        if (self::isKhmer() && is_array($km) && count($km) > 0) {
            return $km;
        }

        return is_array($en) ? $en : [];
    }
}
 