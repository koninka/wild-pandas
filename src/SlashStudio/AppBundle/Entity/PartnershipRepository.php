<?php

namespace SlashStudio\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use SlashStudio\AppBundle\DBAL\PartnershipEnumType;

class PartnershipRepository extends EntityRepository
{
    public function getAll()
    {
        $partnerships = $this->getEntityManager()
            ->createQuery('SELECT p, t FROM SlashStudioAppBundle:Partnership p LEFT JOIN p.translations t ORDER BY t.name ASC')
            ->getResult();

        $result = ['sponsors' => [], 'partners' => []];
        foreach ($partnerships as &$p) {
            $result[$p->getType() == PartnershipEnumType::ST_PARTNER ? 'partners' : 'sponsors'][] = $p;
        }

        return $result;
    }
}
