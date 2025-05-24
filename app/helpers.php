<?php

use Alkoumi\LaravelArabicNumbers\Numbers;

/**
 * Translate numbers to a locale-specific format.
 *
 * Converts a given number to a formatted string with a specific number of decimal digits.
 * If the locale is 'ar' (Arabic), it transforms the digits to Eastern Arabic numerals.
 *
 * @param string $locale The target locale, e.g., 'en' or 'ar'.
 * @param float|int $number The number to format and localize.
 * @param int $digits Optional. The number of decimal digits to display (default is 2).
 *
 * @return string The localized number as a formatted string.
 */

function translateNumberToLocale($locale, $number, int $digits = 2)
{
    return $locale === 'ar' ? Numbers::ShowInArabicDigits(number_format($number, $digits)) : number_format($number, $digits);
}
