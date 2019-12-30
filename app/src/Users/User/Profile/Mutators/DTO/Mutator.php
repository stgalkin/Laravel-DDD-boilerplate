<?php

namespace App\Src\Users\User\Profile\Mutators\DTO;

use App\Src\Users\User\Profile\ProfileContract;
use App\Src\Users\User\Profile\ProfileDTO;

/**
 * Class Mutator
 * @package app\src\Users\User\Profile\Mutators\DTO
 */
final class Mutator
{
    /**
     * @param ProfileContract $profile
     * @return ProfileDTO
     */
    public function toDTO(ProfileContract $profile): ProfileDTO
    {
        $profileDTO = new ProfileDTO();
        $profileDTO->id = (string) $profile->id();
        $profileDTO->firstName = $profile->firstName();
        $profileDTO->lastName = $profile->lastName();

        return $profileDTO;
    }
}
