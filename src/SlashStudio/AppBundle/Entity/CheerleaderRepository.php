<?php

namespace SlashStudio\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class CheerleaderRepository extends EntityRepository
{
    const AMOUNT_ON_MAIN_PAGE = 8;

    public function getAll($isMain = false)
    {
        $qb = $this->getEntityManager()
            ->createQueryBuilder()
            ->select(['cl', 'p', 't'])
            ->from('SlashStudioAppBundle:Cheerleader', 'cl')
            ->leftJoin('cl.photo', 'p')
            ->leftJoin('cl.translations', 't')
            ->orderBy('t.name', 'ASC');

        return $isMain ? new Paginator($qb->setMaxResults(static::AMOUNT_ON_MAIN_PAGE)) : $qb->getQuery()->getResult();
    }
}
