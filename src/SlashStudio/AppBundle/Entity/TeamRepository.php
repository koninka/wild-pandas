<?php

namespace SlashStudio\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class TeamRepository extends EntityRepository
{
//    public function getShortInfo()
//    {
//        return $this->getEntityManager()
//            ->createQuery(
//                'SELECT t, a FROM SlashStudioAppBundle:Team t JOIN t.achievements a'
//            )
//            ->getOneOrNullResult(QUERY::HYDRATE_ARRAY);
//    }

    public function getInfo()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT t, a, p, i, ai FROM SlashStudioAppBundle:Team t JOIN t.achievements a LEFT JOIN a.image ai LEFT JOIN t.captain p LEFT JOIN t.image i'
            )
            ->getOneOrNullResult();
    }
}
