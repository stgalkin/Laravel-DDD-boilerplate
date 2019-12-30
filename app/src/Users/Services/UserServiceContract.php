<?php

namespace App\Src\Users\Services;

use App\Src\Users\User\UserDTO;
use App\Src\Users\User\UserReadOnlyContract;

/**
 * Interface UserServiceContract
 * @package App\Src\Users\Services
 */
interface UserServiceContract
{
    /**
     * @param string $id
     * @return UserServiceContract
     * @throws \App\Assembly\Exceptions\NotFoundException
     */
    public function workWith(string $id): UserServiceContract;

    /**
     * @param array $data
     * @return UserServiceContract
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function add(array $data): UserServiceContract;

    /**
     * @param array $data
     * @return UserServiceContract
     */
    public function change(array $data): UserServiceContract;

    /**
     * @param array $data
     * @return UserServiceContract
     * @throws \UnexpectedValueException
     */
    public function changeProfile(array $data): UserServiceContract;

    /**
     * @return UserServiceContract
     */
    public function remove(): UserServiceContract;
    /**
     * @return UserDTO
     */
    public function dto(): UserDTO;

    /**
     * @return UserReadOnlyContract
     */
    public function readOnly(): UserReadOnlyContract;
}
