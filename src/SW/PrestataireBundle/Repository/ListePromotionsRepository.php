<?php

namespace SW\PrestataireBundle\Repository;
use Doctrine\ORM\QueryBuilder;
/**
 * ListePromotionsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ListePromotionsRepository extends \Doctrine\ORM\EntityRepository
{
    public function listePromotions_By_Prestataire($prestataire)
    {
        $qb = $this->createQueryBuilder('lp');

        $qb->where('lp.prestataire= :id')
            ->setParameter('id', $prestataire)
            ->select('lp.valeur,lp.dateDebut,lp.dateFin,lp.description')
        ;

        return $qb
            ->getQuery()
            ->getResult()
            ;
    }
    public function deletePromotions_By_Prestataire($prestataire)
    {
        $qb = $this->createQueryBuilder('lp');

        $qb->where('lp.prestataire= :id')
            ->setParameter('id', $prestataire)
            ->delete('')
        ;

        return $qb
            ->getQuery()
            ->getResult()
            ;
    }
}
