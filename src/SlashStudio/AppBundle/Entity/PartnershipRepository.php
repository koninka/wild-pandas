<?php

namespace SlashStudio\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use SlashStudio\AppBundle\DBAL\PartnershipEnumType;

class PartnershipRepository extends EntityRepository
{
    public function getAll()
    {
        $partnerships = $this->getEntityManager()
            ->createQuery('SELECT p FROM SlashStudioAppBundle:Partnership p ORDER BY p.name ASC')
            ->getResult();

        $result = ['sponsors' => [], 'partners' => []];
        foreach ($partnerships as &$p) {
            $result[$p->getType() == PartnershipEnumType::ST_PARTNER ? 'partners' : 'sponsors'][] = $p;
        }

        return $result;
    }
}
