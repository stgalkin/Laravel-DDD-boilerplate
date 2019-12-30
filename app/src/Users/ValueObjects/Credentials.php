<?php

namespace App\Src\Users\ValueObjects;

/**
 * Class Credentials
 * @package App\Src\Users\ValueObjects
 */
final class Credentials
{
    /**
     * @var Email
     */
    private Email $email;

    /**
     * @var HashedPassword
     */
    private HashedPassword $password;

    /**
     * Credentials constructor.
     * @param Email $email
     * @param HashedPassword $password
     */
    public function __construct(Email $email, HashedPassword $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * @return Email
     */
    public function email(): Email
    {
        return $this->email;
    }

    /**
     * @return HashedPassword
     */
    public function password(): HashedPassword
    {
        return $this->password;
    }

    /**
     * @param Credentials $credentials
     * @return bool
     */
    public function equals(Credentials $credentials): bool
    {
        return $this->email()->equals($credentials->email()) &&
            $this->password()->equals($credentials->password());
    }
}
