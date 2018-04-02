<?php
/**
 * Created by PhpStorm.
 * User: Kais
 * Date: 12/03/2018
 * Time: 09:36
 */

namespace EspritClubsBundle\Entity;


use Doctrine\ORM\EntityRepository;

class EvenementRepository extends EntityRepository
{
    public function Recherche($rech)
    {
        $query = $this->getEntityManager()
            ->createQuery("SELECT e FROM EspritClubsBundle:Evenement e  WHERE e.date =:critere ")
            ->setParameter('critere', '%'.$rech.'%');

        return $result = $query->getResult();
    }
}