<?php

namespace SlashStudio\AppBundle\Entity;

// use Doctrine\ORM\Query;
use Doctrine\ORM\EntityRepository;

class SimplePageRepository extends EntityRepository
{
    private $actions = ['training' => 1, 'history' => 2, 'women_team' => 3];

    public function getAll()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT p, t FROM SlashStudioAppBundle:SimplePage p LEFT JOIN p.translations t')
            ->getResult();
    }

    public function getPage($action)
    {
        if (empty($this->actions[$action])) return null;

        return $this->getEntityManager()
            ->createQuery('SELECT p, m, t FROM SlashStudioAppBundle:SimplePage p LEFT JOIN p.meta m LEFT JOIN p.translations t WHERE p.id = :id')
            ->setParameter('id', $this->actions[$action])
            ->getOneOrNullResult(/*Query::HYDRATE_ARRAY*/);
    }
}
