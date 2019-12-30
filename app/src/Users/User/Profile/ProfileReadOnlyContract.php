<?php

namespace App\Src\Users\User\Profile;

use App\Assembly\Generators\Entities\Contracts\UUIDContract;

/**
 * Interface ProfileReadOnlyContract
 * @package App\Src\Users\User\Profile
 */
interface ProfileReadOnlyContract extends UUIDContract
{
    /**
     * @return string
     */
    public function firstName(): string;

    /**
     * @return string
     */
    public function lastName(): string;
}
