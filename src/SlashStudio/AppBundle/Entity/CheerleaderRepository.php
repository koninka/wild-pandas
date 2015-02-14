<?php

namespace SlashStudio\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class CheerleaderRepository extends EntityRepository
{
    const AMOUNT_ON_MAIN_PAGE = 8;

    public function getAll($isMain = false)
    {
        $qb = $this->getEntityManager()
            ->createQueryBuilder()
            ->select(['cl', 'p'])
            ->from('SlashStudioAppBundle:Cheerleader', 'cl')
            ->leftJoin('cl.photo', 'p')
            ->orderBy('cl.name', 'ASC');
        if ($isMain) {
            $qb->setMaxResults(static::AMOUNT_ON_MAIN_PAGE);
        }
        $r = $qb->getQuery()->getResult();

        return $r;
    }
}
