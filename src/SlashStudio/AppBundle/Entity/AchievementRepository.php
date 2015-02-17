<?php

namespace SlashStudio\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use SlashStudio\AppBundle\DBAL\PartnershipEnumType;
use Doctrine\ORM\Tools\Pagination\Paginator;

class AchievementRepository extends EntityRepository
{
    public function getAll($amount)
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT p, t FROM SlashStudioAppBundle:Achievement p LEFT JOIN p.translations t ORDER BY t.name ASC');

        return $amount ? new Paginator($query->setMaxResults($amount)) : $query->getResult();
    }
}
