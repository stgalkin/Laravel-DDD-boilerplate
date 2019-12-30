<?php

namespace App\Assembly\Generators\UUIdv4;


use App\Assembly\Generators\ValueObjets\UUID\UUID;

/**
 * Interface UUIDNextContract
 * @package App\Assembly\Generators\UUIdv4
 */
interface UUIDNextContract
{
    /**
     * Generate new Identity
     *
     * @return UUID
     * @throws \InvalidArgumentException|\Exception
     */
    public static function next(): UUID;

    /**
     * @param string $string
     * @return bool
     */
    public static function isValid(string $string): bool;
}
