<?php
/**
 * Created by PhpStorm.
 * User: EL Arbi Anis
 * Date: 21/05/2018
 * Time: 12:05
 */

namespace AppBundle\Repository;
use Doctrine\ORM\QueryBuilder;

class UserRepository extends \Doctrine\ORM\EntityRepository
{
    public function get_user($id)
    {
        $qb = $this->createQueryBuilder('u');

        $qb->where('u.id= :id')
            ->setParameter('id', $id)
            ->select('u.id,u.username,u.email')
        ;

        return $qb
            ->getQuery()
            ->getResult()
            ;
    }
}