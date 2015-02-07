<?php

namespace SlashStudio\AppBundle\Entity;

use Doctrine\ORM\Query;
use Doctrine\ORM\EntityRepository;

class TeamRepository extends EntityRepository
{
    public function getInfo()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT t, a FROM SlashStudioAppBundle:Team t JOIN t.achievements a')
            ->getOneOrNullResult(Query::HYDRATE_ARRAY);
    }
}
