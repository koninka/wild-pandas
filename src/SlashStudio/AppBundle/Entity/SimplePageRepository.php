<?php

namespace SlashStudio\AppBundle\Entity;

use Doctrine\ORM\Query;
use Doctrine\ORM\EntityRepository;

class SimplePageRepository extends EntityRepository
{
    private $actions = ['training' => 1, 'history' => 2, 'baby_team' => 3];

    public function getPage($action)
    {
        if (empty($this->actions[$action])) return null;

        return $this->getEntityManager()
            ->createQuery('SELECT p, m FROM SlashStudioAppBundle:SimplePage p LEFT JOIN p.meta m WHERE p.id = :id')
            ->setParameter('id', $this->actions[$action])
            ->getOneOrNullResult(Query::HYDRATE_ARRAY);
    }
}
