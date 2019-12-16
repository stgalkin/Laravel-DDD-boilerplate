<?php

namespace App\Src\Users\User;

use App\Src\Users\User\Profile\ProfileDTO;
use Illuminate\Contracts\Support\Arrayable;

/**
 * Class UserDTO
 * @package App\Src\Users\User
 */
final class UserDTO implements Arrayable
{
    /**
     * @var string
     */
    public string $id;

    /**
     * @var string
     */
    public string $email;

    /**
     * @var ProfileDTO
     */
    public ProfileDTO $profile;

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'profile' => $this->profile->toArray(),
        ];
    }
}
