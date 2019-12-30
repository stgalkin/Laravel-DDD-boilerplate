<?php

namespace App\Assembly\Generators\ValueObjets\UUID;

use App\Assembly\Generators\UUIdv4\UUIDNext;

/**
 * Class UUID
 * @package App\Assembly\Generators\ValueObjets\UUID
 */
final class UUID
{
    /**
     * @var string
     */
    private string $id;

    /**
     * @param string $id
     * @throws \InvalidArgumentException
     */
    public function __construct(string $id)
    {
        if (UUIDNext::isValid($id)) {
            throw new \InvalidArgumentException('Incorrect id format, should be UUIDv4');
        }

        $this->id = $id;
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toString();
    }

    /**
     * @param UUID $id
     * @return bool
     */
    public function equals(UUID $id): bool
    {
        return strtolower((string) $this) === strtolower((string) $id);
    }
}
