<?php

namespace App\Assembly\Generators\UUIdv4;

use Ramsey\Uuid\Uuid;

/**
 * Class UUIDNext
 * @package App\Assembly\Generators\UUIdv4
 */
class UUIDNext implements UUIDNextContract
{
    /**
     * @inheritDoc
     */
    public static function next(): Identity
    {
        return new Identity(Uuid::uuid4()->toString());
    }

    /**
     * @inheritDoc
     */
    public static function isValid(string $string): bool
    {
        return Uuid::isValid($string);
    }
}
