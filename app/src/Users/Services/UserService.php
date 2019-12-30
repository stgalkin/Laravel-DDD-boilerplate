<?php

namespace App\Src\Users\Services;

use App\Assembly\Generators\UUIdv4\UUIDNext;
use App\Assembly\Generators\ValueObjets\UUID\UUID;
use App\Src\Users\User\Mutators\DTO\Mutator;
use App\Src\Users\User\Profile\ProfileContract;
use App\Src\Users\User\Repositories\UserRepositoryContract;
use App\Src\Users\User\UserContract;
use App\Src\Users\User\UserDTO;
use App\Src\Users\User\UserReadOnlyContract;
use App\Src\Users\ValueObjects\Credentials;
use App\Src\Users\ValueObjects\Email;
use App\Src\Users\ValueObjects\HashedPassword;
use Illuminate\Support\Arr;

/**
 * Class UserService
 * @package App\Src\Users\Services
 */
class UserService implements UserServiceContract
{
    /**
     * @var UserContract
     */
    private UserContract $entity;

    /**
     * @var Mutator
     */
    private Mutator $mutator;

    /**
     * @var UserRepositoryContract
     */
    private UserRepositoryContract $repository;

    /**
     * UserService constructor.
     * @param UserRepositoryContract $repository
     * @param Mutator $mutator
     */
    public function __construct(UserRepositoryContract $repository, Mutator $mutator)
    {
        $this->mutator = $mutator;
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function workWith(string $id): UserServiceContract
    {
        return $this->setEntity($this->_repository()->byId(new UUID($id)));
    }

    /**
     * @inheritDoc
     */
    public function add(array $data):UserServiceContract
    {
        $entity = $this->create($data);
        $profile = $this->createProfile(Arr::get($data, 'profile'), $entity);
        $entity->assignProfile($profile);

        return $this->setEntity($entity);
    }

    /**
     * @param array $data
     * @return UserContract
     * @throws \Illuminate\Contracts\Container\BindingResolutionException|\Exception
     */
    private function create(array $data): UserContract
    {
        return app()->make(UserContract::class, [
            'id' => UUIDNext::next(),
            'credentials' => new Credentials(new Email(Arr::get($data, 'email')), new HashedPassword(Arr::get($data, 'password')))
        ]);
    }

    /**
     * @param array $data
     * @param UserContract $user
     * @return ProfileContract
     * @throws \Illuminate\Contracts\Container\BindingResolutionException|\Exception
     */
    private function createProfile(array $data, UserContract $user): ProfileContract
    {
        return app()->make(ProfileContract::class, [
            'id' => UUIDNext::next(),
            'firstName' => Arr::get($data, 'first_name'),
            'lastName' => Arr::get($data, 'last_name'),
            'user' => $user,
        ]);
    }

    /**
     * @inheritDoc
     */
    public function change(array $data): UserServiceContract
    {
        if (Arr::has($data, 'email')) {
            $this->_entity()->changeEmail(new Email(Arr::get($data, 'email')));
        }

        if (Arr::has($data, 'password')) {
            $this->_entity()->changePassword(new HashedPassword(Arr::get($data, 'password')));
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function changeProfile(array $data): UserServiceContract
    {
        if (Arr::has($data, 'first_name')) {
            $this->_entity()->profile()->changeFirstName(Arr::get($data, 'first_name'));
        }

        if (Arr::has($data, 'last_name')) {
            $this->_entity()->profile()->changeLastName(Arr::get($data, 'last_name'));
        }

        return $this;
    }
    /**
     * @inheritDoc
     */
    public function remove(): UserServiceContract
    {
        $this->_repository()->destroy($this->_entity());

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function dto(): UserDTO
    {
        return $this->mutate($this->_entity());
    }

    /**
     * @inheritDoc
     */
    public function readOnly(): UserReadOnlyContract
    {
        return $this->_entity();
    }

    /**
     * @param UserContract $user
     * @return UserService
     */
    private function setEntity(UserContract $user): UserService
    {
        $this->entity = $user;

        return $this;
    }
    /**
     * @return UserContract
     */
    private function _entity(): UserContract
    {
        if (!$this->entity instanceof UserContract) {
            throw new \UnexpectedValueException('Entity not set.');
        }

        return $this->entity;
    }
    /**
     * @param UserContract $user
     * @return UserDTO
     */
    private function mutate(UserContract $user): UserDTO
    {
        return $this->_mutator()->toDTO($user);
    }
    /**
     * @return Mutator
     */
    private function _mutator(): Mutator
    {
        if (!$this->mutator instanceof Mutator) {
            throw new \UnexpectedValueException('Mutator not set.');
        }

        return $this->mutator;
    }

    /**
     * @return UserRepositoryContract
     */
    private function _repository(): UserRepositoryContract
    {
        if (!$this->repository instanceof UserRepositoryContract) {
            throw new \UnexpectedValueException('Repository not set.');
        }

        return $this->repository;
    }
}
