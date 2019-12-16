<?php

namespace App\Src\Users\User\Repositories;

use App\Assembly\Exceptions\NotFoundException;
use App\Assembly\Generators\ValueObjets\UUID\UUID;
use App\Src\Users\User\UserContract;
use Illuminate\Support\Collection;

/**
 * Interface UserRepositoryContract
 * @package App\Src\Users\User
 */
interface UserRepositoryContract
{
    /**
     * @param UUID $id
     * @return UserContract
     * @throws NotFoundException
     */
    public function byId(UUID $id): UserContract;

    /**
     * @return UserContract|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function one(): ?UserContract;

    /**
     * @param UserContract $user
     * @return UserContract
     */
    public function persist(UserContract $user): UserContract;

    /**
     * @return UserRepositoryContract
     */
    public function flush(): UserRepositoryContract;

    /**
     * @param UserContract $user
     * @return UserRepositoryContract
     */
    public function destroy(UserContract $user): UserRepositoryContract;

    /**
     * @param callable|null $callback
     * @return Collection
     */
    public function all(?callable $callback = null): Collection;
}
