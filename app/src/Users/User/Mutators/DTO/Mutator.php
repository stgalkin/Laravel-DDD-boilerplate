<?php

namespace App\Src\Users\User\Mutators\DTO;

use App\Assembly\Exceptions\NotFoundException;
use App\Assembly\Generators\ValueObjets\UUID\UUID;
use App\Src\Users\User\Repositories\UserRepositoryContract;
use App\Src\Users\User\UserContract;
use App\Src\Users\User\UserDTO;
use \App\Src\Users\User\Profile\Mutators\DTO\Mutator as ProfileMuttor;

/**
 * Class Mutator
 * @package App\Src\Users\User\Mutators\DTO
 */
final class Mutator
{
    /**
     * @var UserRepositoryContract
     */
    private UserRepositoryContract $repository;

    /**
     * @var ProfileMuttor
     */
    private ProfileMuttor $profileMutator;

    /**
     * Mutator constructor.
     * @param UserRepositoryContract $repository
     * @param ProfileMuttor $profileMutator
     */
    public function __construct(UserRepositoryContract $repository, ProfileMuttor $profileMutator)
    {

        $this->repository = $repository;
        $this->profileMutator = $profileMutator;
    }

    /**
     * @param UserDTO $userDTO
     * @return UserContract
     * @throws NotFoundException
     */
    public function fromDTO(UserDTO $userDTO): UserContract
    {
        return $this->_repository()->byId(new UUID($userDTO->id));
    }

    /**
     * @param UserContract $user
     * @return UserDTO
     */
    public function toDTO(UserContract $user): UserDTO
    {
        $userDTO = new UserDTO();
        $userDTO->id = $user->id()->toString();
        $userDTO->email = $user->email();
        $userDTO->profile = $this->_profileMutator()->toDTO($user->profile());

        return $userDTO;
    }

    /**
     * @return ProfileMuttor
     */
    private function _profileMutator(): ProfileMuttor
    {
        return $this->profileMutator;
    }

    /**
     * @return UserRepositoryContract
     */
    private function _repository(): UserRepositoryContract
    {
        return $this->repository;
    }
}
