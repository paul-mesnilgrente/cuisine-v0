<?php

namespace AppBundle\Repository;

/**
 * RecetteRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class RecetteRepository extends \Doctrine\ORM\EntityRepository
{
    public function getPubliques() {
        return $this->_em->createQuery('
            SELECT r
            FROM AppBundle:Recette r
            WHERE r.publique = true
            ORDER BY r.date DESC')
            ->getResult();
    }

    public function search($caracteres) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('r')
          ->from('AppBundle:Recette', 'r')
          ->where("r.nom LIKE :mot")
          ->orderBy('r.nom', 'ASC')
          ->setParameter('mot', '%'.$caracteres.'%');

       $query = $qb->getQuery();
       return $query->getResult();
    }
}
