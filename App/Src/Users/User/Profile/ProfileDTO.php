<?php

namespace App\Src\Users\User\Profile;

use Illuminate\Contracts\Support\Arrayable;

/**
 * Interface ProfileDTO
 * @package App\Src\Users\User\Profile
 */
final class ProfileDTO implements Arrayable
{
    /**
     * @var string
     */
    public string $id;

    /**
     * @var string
     */
    public string $firstName;

    /**
     * @var string
     */
    public string $lastName;

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
        ];
    }
}
