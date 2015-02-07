<?php

namespace SlashStudio\AppBundle\Entity;

use Doctrine\ORM\Query;
use Doctrine\ORM\EntityRepository;

class TeamRepository extends EntityRepository
{
    public function getInfo()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT t, a, p FROM SlashStudioAppBundle:Team t JOIN t.achievements a LEFT JOIN t.captain p'
            )
            ->getOneOrNullResult(Query::HYDRATE_ARRAY);
    }
}
