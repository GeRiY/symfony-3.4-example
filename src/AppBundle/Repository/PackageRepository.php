<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Address;
use AppBundle\Entity\Position;
use Doctrine\ORM\EntityRepository;

class PackageRepository extends EntityRepository
{

    public function getPackageByPosition($position, $courrier)
    {
        $em = $this->getEntityManager();

        $query = $em->createQuery("SELECT p FROM AppBundle\Entity\Package p WHERE (p.currentPosition = :position and  p.currentPosition IS NOT NULL) OR p.courier = :courrier")
        ->setParameter("position", $position)
        ->setParameter("courrier", $courrier);

        return $query->getResult();

    }

}