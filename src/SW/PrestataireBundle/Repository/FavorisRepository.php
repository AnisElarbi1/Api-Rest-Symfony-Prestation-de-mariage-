<?php

namespace SW\PrestataireBundle\Repository;
use Doctrine\ORM\QueryBuilder;

/**
 * FavorisRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FavorisRepository extends \Doctrine\ORM\EntityRepository
{
    public function listFavoris_By_Couple($id)
    {
        $qb = $this->createQueryBuilder('f');

        $qb->where('f.couple= :id')
            ->setParameter('id', $id)
            ->select('')
        ;

        return $qb
            ->getQuery()
            ->getResult()
            ;
    }
}
