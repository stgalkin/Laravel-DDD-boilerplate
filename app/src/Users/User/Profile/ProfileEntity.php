<?php

namespace App\Src\Users\User\Profile;

use App\Assembly\Generators\ValueObjets\UUID\UUID;
use App\Src\Users\User\UserContract;

/**
 * Class ProfileEntity
 * @package App\Src\Users\User\Profile
 */
class ProfileEntity implements ProfileContract
{
    /**
     * @var UUID
     */
    private UUID $id;

    /**
     * @var UserContract
     */
    private UserContract $user;

    /**
     * @var string
     */
    private string $firstName;

    /**
     * @var string
     */
    private string $lastName;

    /**
     * @inheritDoc
     */
    public function __construct(UUID $id, UserContract $user, string $firstName, string $lastName)
    {
        $this->setId($id)
            ->setUser($user)
            ->setFirstName($firstName)
            ->setLastName($lastName);
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
     * @return ProfileEntity
     */
    private function setId(UUID $id): ProfileEntity
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @param UserContract $user
     * @return ProfileEntity
     */
    private function setUser(UserContract $user): ProfileEntity
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function firstName(): string
    {
        return $this->firstName;
    }

    /**
     * @inheritDoc
     */
    public function changeFirstName(string $firstName): ProfileContract
    {
        return $this->setFirstName($firstName);
    }

    /**
     * @param string $firstName
     * @return ProfileEntity
     */
    private function setFirstName(string $firstName): ProfileEntity
    {
        if (trim($firstName) === '') {
            throw new \InvalidArgumentException("First name can't be empty");
        }

        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function lastName(): string
    {
        return $this->lastName;
    }

    /**
     * @inheritDoc
     */
    public function changeLastName(string $lastName): ProfileContract
    {
        return $this->setLastName($lastName);
    }

    /**
     * @param string $lastName
     * @return ProfileEntity
     */
    private function setLastName(string $lastName): ProfileEntity
    {
        if (trim($lastName) === '') {
            throw new \InvalidArgumentException("Last name can't be empty");
        }

        $this->lastName = $lastName;

        return $this;
    }
}
