<?php

namespace SW\PrestataireBundle\Repository;
use Doctrine\ORM\QueryBuilder;
/**
 * VideoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class VideoRepository extends \Doctrine\ORM\EntityRepository
{
    public function showVideo_By_IdVideo($id)
    {
        $qb = $this->createQueryBuilder('v');

        $qb->where('v.id= :id')
            ->setParameter('id', $id)
            ->select('v.id,v.url,v.description')
        ;

        return $qb
            ->getQuery()
            ->getResult()
            ;
    }
    public function listVideos_By_GalerieVideo($id)
    {
        $qb = $this->createQueryBuilder('v');

        $qb->where('v.galerieVideo= :id')
            ->setParameter('id', $id)
            ->select('v.id,v.url,v.description')
        ;

        return $qb
            ->getQuery()
            ->getResult()
            ;
    }
    public function nombreVideo($id)
    {
        $qb = $this->createQueryBuilder('v');

        $qb->innerJoin('v.galerieVideo','gv')
            ->addSelect('gv')
         ;

        $qb->where('gv.prestataire= :id')
            ->setParameter('id', $id)
            ->select('count(gv)')
        ;

        return $qb
            ->getQuery()
            ->getSingleScalarResult()
            ;
    }
    public function nombreVideo_By_GalerieVideo($id)
    {
        $qb = $this->createQueryBuilder('v');

        $qb->where('v.galerieVideo= :id')
            ->setParameter('id', $id)
            ->select('count(v)')
        ;

        return $qb
            ->getQuery()
            ->getSingleScalarResult()
            ;
    }
}
