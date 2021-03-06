<?php

namespace Yoda\EventBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * EventRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EventRepository extends EntityRepository
{
    /*
     * @param $username
     * @return User|null
     */
    public function findOneByName($name) {
        return $this->createQueryBuilder('e')
                ->andWhere('e.name = :name')
                ->setParameter('name', $name)
                ->getQuery()
                ->getOneOrNullResult();
                
    }
}
