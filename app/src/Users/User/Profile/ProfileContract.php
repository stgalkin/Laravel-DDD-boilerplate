<?php

namespace App\Src\Users\User\Profile;

use App\Assembly\Generators\ValueObjets\UUID\UUID;
use App\Src\Users\User\UserContract;

/**
 * Interface ProfileContract
 * @package App\Src\Users\User\Profile
 */
interface ProfileContract extends ProfileReadOnlyContract
{
    /**
     * ProfileContract constructor.
     * @param UUID $id
     * @param UserContract $user
     * @param string $firstName
     * @param string $lastName
     */
    public function __construct(UUID $id,UserContract $user, string $firstName, string $lastName);

    /**
     * @param string $firstName
     * @return ProfileContract
     */
    public function changeFirstName(string $firstName): ProfileContract;

    /**
     * @param string $lastName
     * @return ProfileContract
     */
    public function changeLastName(string $lastName): ProfileContract;
}
