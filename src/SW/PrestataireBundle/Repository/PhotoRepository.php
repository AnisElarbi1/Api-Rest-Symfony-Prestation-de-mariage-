<?php

namespace SW\PrestataireBundle\Repository;
use Doctrine\ORM\QueryBuilder;
/**
 * PhotoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PhotoRepository extends \Doctrine\ORM\EntityRepository
{
    public function showPhoto_By_IdPhoto($id)
    {
        $qb = $this->createQueryBuilder('ph');

        $qb->where('ph.id= :id')
            ->setParameter('id', $id)
            ->select('ph.id,ph.url,ph.description')
        ;

        return $qb
            ->getQuery()
            ->getResult()
            ;
    }
    public function listPhotos_By_GaleriePhoto($id)
    {
        $qb = $this->createQueryBuilder('ph');

        $qb->where('ph.galeriePhoto= :id')
            ->setParameter('id', $id)
            ->select('ph.id,ph.url,ph.description')
        ;

        return $qb
            ->getQuery()
            ->getResult()
            ;
    }
    public function nombrePhoto_By_GaleriePhoto($id)
    {
        $qb = $this->createQueryBuilder('ph');

        $qb->where('ph.galeriePhoto= :id')
            ->setParameter('id', $id)
            ->select('count(ph)')
        ;

        return $qb
            ->getQuery()
            ->getSingleScalarResult()
            ;
    }

}
