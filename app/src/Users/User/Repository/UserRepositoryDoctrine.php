<?php

namespace App\Src\Users\User\Repositories;

use App\Assembly\Exceptions\NotFoundException;
use App\Assembly\Generators\ValueObjets\UUID\UUID;
use App\Src\Users\User\UserContract;
use App\Src\Users\User\UserEntity;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Illuminate\Support\Collection;

/**
 * Interface UserRepositoryContract
 * @package App\Src\Users\User
 */
class UserRepositoryDoctrine implements UserRepositoryContract
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $manager;

    /**
     * @var EntityRepository
     */
    private EntityRepository $entityRepository;

    /**
     * @var QueryBuilder
     */
    private QueryBuilder $builder;

    /**
     * UserRepositoryDoctrine constructor.
     * @param EntityManagerInterface $manager
     */
    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @inheritDoc
     */
    public function byId(UUID $id): UserContract
    {
        $entity = $this->_entityRepository()->find($id);

        if (!$entity instanceof UserContract) {
            throw new NotFoundException("User with id: {$id->toString()} not found");
        }

        return $entity;
    }

    /**
     * @inheritDoc
     */
    public function one(): ?UserContract
    {
        $result = $this->_queryBuilder()->getQuery()->getOneOrNullResult();

        $this->refreshQueryBuilder();

        return $result;
    }

    /**
     * @inheritDoc
     */
    public function persist(UserContract $user): UserContract
    {
        $this->_manager()->persist($user);

        return $user;
    }

    /**
     * @inheritDoc
     */
    public function flush(): UserRepositoryContract
    {
        $this->_manager()->flush();

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function destroy(UserContract $user): UserRepositoryContract
    {
        $this->manager->remove($user);
        $this->manager->flush();

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function all(?callable $callback = null): Collection
    {
        $results = collect($this
            ->_queryBuilder()
            ->getQuery()
            ->getResult());

        $this->refreshQueryBuilder();

        return is_callable($callback) ? $callback($results) : $results;
    }

    /**
     * @return QueryBuilder
     */
    private function _queryBuilder(): QueryBuilder
    {
        if (!$this->builder instanceof QueryBuilder) {
            $this->createQueryBuilder();
        }

        return $this->builder;
    }

    /**
     * @return QueryBuilder
     */
    private function createQueryBuilder(): QueryBuilder
    {
        $this->builder = $this->_entityRepository()->createQueryBuilder(UserEntity::class);

        return $this->builder;
    }

    /**
     * @return QueryBuilder
     */
    private function refreshQueryBuilder(): QueryBuilder
    {
        return $this->createQueryBuilder();
    }

    /**
     * @return UserRepositoryDoctrine
     */
    private function setEntityRepository(): UserRepositoryDoctrine
    {
        /** @var EntityRepository $entityRepository */
        $entityRepository = $this->_manager()->getRepository(UserEntity::class);

        $this->entityRepository = $entityRepository;

        return $this;
    }

    /**
     * @return EntityManagerInterface
     */
    private function _manager(): EntityManagerInterface
    {
        if (!$this->manager instanceof EntityManagerInterface) {
            throw new \UnexpectedValueException('Entity manager is not set');
        }

        return $this->manager;
    }

    /**
     * @return EntityRepository
     */
    private function _entityRepository(): EntityRepository
    {
        if (!$this->entityRepository instanceof EntityRepository) {
            $this->setEntityRepository();
        }

        return $this->entityRepository;
    }
}
