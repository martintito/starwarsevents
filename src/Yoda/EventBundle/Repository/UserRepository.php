<?php

namespace Yoda\EventBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends EntityRepository
{
    /*
     * @param $username
     * @return User|null
     */
    public function findOneByUsernameOrEmail($username) {
        return $this->createQueryBuilder('u')
                ->andWhere('u.username = :username')
                ->setParameter('username', $username)
                ->getQuery()
                ->getOneOrNullResult();                
    }
}
