<?php

namespace App\Src\Users\User;

use App\Assembly\Generators\Entities\Contracts\UUIDContract;
use App\Src\Users\User\Profile\ProfileReadOnlyContract;

/**
 * Interface UserReadOnlyContract
 * @package App\Src\Users\User
 */
interface UserReadOnlyContract extends UUIDContract
{
    /**
     * @return string
     */
    public function email(): string;

    /**
     * @return string
     */
    public function password(): string;

    /**
     * @return ProfileReadOnlyContract
     * @throws \UnexpectedValueException
     */
    public function profileReadonly(): ProfileReadOnlyContract;
}
