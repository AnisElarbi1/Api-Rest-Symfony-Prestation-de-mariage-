<?php

namespace SW\PrestataireBundle\Repository;
use Doctrine\ORM\QueryBuilder;
/**
 * LigneInformationRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class LigneInformationRepository extends \Doctrine\ORM\EntityRepository
{
    public function listLigneInformation_By_Prestataire($id)
    {
        $qb = $this->createQueryBuilder('li');

        $qb->where('li.prestataire= :id')
            ->setParameter('id', $id)
            ->select('li.id,li.nom,li.icone,li.contenu')
        ;

        return $qb
            ->getQuery()
            ->getResult()
            ;
    }
    public function deleteLignesInformation_By_Prestataire($id)
    {
        $qb = $this->createQueryBuilder('li');

        $qb->where('li.prestataire= :id')
            ->setParameter('id', $id)
            ->delete('')
        ;

        return $qb
            ->getQuery()
            ->getResult()
            ;
    }
}
