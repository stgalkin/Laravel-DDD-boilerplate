<?php

namespace App\Src\Users\ValueObjects;

use Illuminate\Support\Facades\Hash;

/**
 * Class HashedPassword
 * @package App\Src\Users\ValueObjects
 */
final class HashedPassword
{
    /**
     * @var string
     */
    private string $password;

    /**
     * Credentials constructor.
     * @param string $password
     */
    public function __construct(string $password)
    {
        $this->setPassword($password);
    }

    /**
     * @param string $password
     * @return HashedPassword
     */
    private function setPassword(string $password): HashedPassword
    {
        $this->password = Hash::make($password);

        return $this;
    }
    /**
     * @param HashedPassword $credentials
     * @return bool
     */
    public function equals(HashedPassword $credentials): bool
    {
        return $this->toString() === $credentials->toString();
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toString();
    }
}
