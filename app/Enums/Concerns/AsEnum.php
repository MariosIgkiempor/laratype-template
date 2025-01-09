<?php

declare(strict_types=1);

namespace App\Enums\Concerns;

/**
 * @source https://github.com/kongulov/interact-with-enum
 */

/**
 * Trait for comfortable working with Enums
 *
 * @phpstan-ignore trait.unused
 */
trait AsEnum
{
    /**
     * Get all ENUM names
     *
     * @return array<string>
     */
    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    /**
     * Get all ENUM values
     *
     * @return array<string>
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Get all ENUM name => value
     *
     * @return array<string, string>
     */
    public static function array(): array
    {
        return array_combine(self::values(), self::names());
    }
}
