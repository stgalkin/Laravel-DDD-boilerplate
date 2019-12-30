<?php

namespace App\Assembly\Generators\UUIdv4;


use App\Assembly\Generators\ValueObjets\UUID\UUID;

/**
 * Class UUIDNext
 * @package App\Assembly\Generators\UUIdv4
 */
class UUIDNext implements UUIDNextContract
{
    /**
     * @inheritDoc
     */
    public static function next(): UUID
    {
        return new UUID(\Ramsey\Uuid\Uuid::uuid4()->toString());
    }

    /**
     * @inheritDoc
     */
    public static function isValid(string $string): bool
    {
        return \Ramsey\Uuid\Uuid::isValid($string);
    }
}
