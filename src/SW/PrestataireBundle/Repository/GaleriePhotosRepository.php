<?php

namespace SW\PrestataireBundle\Repository;
use Doctrine\ORM\QueryBuilder;
/**
 * GaleriePhotosRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class GaleriePhotosRepository extends \Doctrine\ORM\EntityRepository
{
    public function listGaleriePhoto_By_Prestataire($id)
    {
        $qb = $this->createQueryBuilder('gp');

        $qb->where('gp.prestataire= :id')
            ->setParameter('id', $id)
            ->select('gp.id,gp.titre,gp.logo,gp.photoPrincipale')
        ;

        return $qb
            ->getQuery()
            ->getResult()
            ;
    }
    public function GaleriePhoto_By_Prestataire_Titre($prestataire,$titre)
    {
        $qb = $this->createQueryBuilder('gp');

        $qb->where('gp.prestataire= :id')
            ->setParameter('id', $prestataire)
            ->andWhere('gp.titre= :titre')
            ->setParameter('titre',$titre)
            ->select('gp.id,gp.titre,gp.logo,gp.photoPrincipale')
        ;

        return $qb
            ->getQuery()
            ->getResult()
            ;
    }
    public function listIdGaleriePhoto_By_Prestataire($id)
    {
        $qb = $this->createQueryBuilder('gp');

        $qb->where('gp.prestataire= :id')
            ->setParameter('id', $id)
            ->select('gp.id')
        ;

        return $qb
            ->getQuery()
            ->getResult()
            ;
    }
}
