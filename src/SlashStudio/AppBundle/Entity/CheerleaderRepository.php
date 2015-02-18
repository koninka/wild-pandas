<?php

namespace SlashStudio\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class CheerleaderRepository extends EntityRepository
{
    public function getAllQB()
    {
        return $this->getEntityManager()
                    ->createQueryBuilder()
                    ->select(['cl', 'p', 't'])
                    ->from('SlashStudioAppBundle:Cheerleader', 'cl')
                    ->leftJoin('cl.photo', 'p')
                    ->leftJoin('cl.translations', 't')
                    ->orderBy('t.name', 'ASC');
    }
    public function getAll($maxResult = null)
    {
        $qb = $this->getAllQB();

        return !empty($maxResult) ? new Paginator($qb->setMaxResults($maxResult)) : $qb->getQuery()->getResult();
    }
}
