<?php

namespace SlashStudio\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use SlashStudio\AppBundle\DBAL\PartnershipEnumType;
use Doctrine\ORM\Tools\Pagination\Paginator;

class AdRepository extends EntityRepository
{
    public function getAll()
    {
        $query = $this->getEntityManager()
            ->createQuery("SELECT a FROM SlashStudioAppBundle:Ad a WHERE a.html IS NOT NULL OR a.html != '' ORDER BY a.id ASC");

        return $query->getArrayResult();
    }
}
