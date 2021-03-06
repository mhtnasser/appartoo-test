<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Extraterrestre;

/**
 * ExtraterrestreRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ExtraterrestreRepository extends \Doctrine\ORM\EntityRepository
{

    public function allFriends(Extraterrestre $user)
    {
        $qb = $this->createQueryBuilder('Extraterrestre');
        $qb->select('e')
            ->from($this->_entityName,'e')
            ->where('e != :extra')
            ->setParameter('extra', $user);
        return $qb->getQuery()->getResult();
    }
}
