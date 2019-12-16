<?php

namespace App\Assembly\Generators\UUIdv4;

use App\Convention\ValueObjects\Identity\Identity;
use Ramsey\Uuid\Uuid;

interface UUIDNextContract
{
    /**
     * Generate new Identity
     *
     * @return Identity
     * @throws \InvalidArgumentException
     */
    public static function next(): Identity;

    /**
     * @param string $string
     * @return bool
     */
    public static function isValid(string $string): bool;
}
