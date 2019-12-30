<?php

namespace App\Src\Users\User;

use App\Assembly\Generators\ValueObjets\UUID\UUID;
use App\Src\Users\User\Profile\ProfileContract;
use App\Src\Users\User\Profile\ProfileReadOnlyContract;
use App\Src\Users\ValueObjects\Credentials;
use App\Src\Users\ValueObjects\Email;
use App\Src\Users\ValueObjects\HashedPassword;

/**
 * Class UserEntity
 * @package App\Src\Users\User
 */
class UserEntity implements UserContract
{
    /**
     * @var UUID
     */
    private UUID $id;

    /**
     * @var null|ProfileContract
     */
    private ?ProfileContract $profile;

    /**
     * @var Email
     */
    private Email $email;

    /**
     * @var HashedPassword
     */
    private HashedPassword $password;

    /**
     * @inheritDoc
     */
    public function __construct(
        UUID $id,
        Credentials $credentials)
    {
        $this->setId($id);
        $this->setEmail($credentials->email());
        $this->setPassword($credentials->password());
    }

    /**
     * @inheritDoc
     */
    public function id(): UUID
    {
        return $this->id;
    }

    /**
     * @param UUID $id
     * @return UserEntity
     */
    private function setId(UUID $id): UserEntity
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function email(): string
    {
        return $this->email->toString();
    }

    /**
     * @inheritDoc
     */
    public function changeEmail(Email $email): UserContract
    {
        return $this->setEmail($email);
    }

    /**
     * @param Email $email
     * @return UserEntity
     */
    private function setEmail(Email $email): UserEntity
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function password(): string
    {
        return $this->password->toString();
    }

    /**
     * @inheritDoc
     */
    public function changePassword(HashedPassword $password): UserContract
    {
        return $this->setPassword($password);
    }

    /**
     * @param HashedPassword $password
     * @return UserEntity
     */
    private function setPassword(HashedPassword $password): UserEntity
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function profile(): ProfileContract
    {
        if (!$this->profile instanceof ProfileContract) {
            throw new \UnexpectedValueException('Profile should be assigned to user');
        }

        return $this->profile;
    }

    /**
     * @inheritDoc
     */
    public function profileReadonly(): ProfileReadOnlyContract
    {
        if (!$this->profile instanceof ProfileContract) {
            throw new \UnexpectedValueException('Profile should be assigned to user');
        }

        return $this->profile;
    }

    /**
     * @inheritDoc
     */
    public function assignProfile(ProfileContract $profile): UserContract
    {
        if ($this->profile instanceof ProfileContract) {
            throw new \UnexpectedValueException('Profile already assigned');
        }

        $this->profile = $profile;

        return $this;
    }
}
