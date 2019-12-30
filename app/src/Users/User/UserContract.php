<?php

namespace App\Src\Users\User;

use App\Assembly\Generators\ValueObjets\UUID\UUID;
use App\Src\Users\User\Profile\ProfileContract;
use App\Src\Users\ValueObjects\Credentials;
use App\Src\Users\ValueObjects\Email;
use App\Src\Users\ValueObjects\HashedPassword;

/**
 * Interface UserContract
 * @package App\Src\Users\User
 */
interface UserContract extends UserReadOnlyContract
{
    /**
     * UserContract constructor.
     * @param UUID $id
     * @param Credentials $credentials
     */
    public function __construct(
        UUID $id,
        Credentials $credentials);

    /**
     * @param Email $email
     * @return UserContract
     */
    public function changeEmail(Email $email): UserContract;

    /**
     * @param HashedPassword $password
     * @return UserContract
     */
    public function changePassword(HashedPassword $password): UserContract;

    /**
     * @param ProfileContract $profile
     * @return UserContract
     */
    public function assignProfile(ProfileContract $profile): UserContract;

    /**
     * @return ProfileContract
     * @throws \UnexpectedValueException
     */
    public function profile(): ProfileContract;
}
