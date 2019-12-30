<?php

namespace App\Assembly\Generators\Entities\Contracts;

use App\Assembly\Generators\ValueObjets\UUID\UUID;
use App\Convention\ValueObjects\Identity\Identity;

/**
 * Interface UUIDContract
 * @package App\Assembly\Generators\Entities\Contracts
 */
interface UUIDContract
{
    /**
     * @return UUID
     */
    public function id(): UUID;
}
