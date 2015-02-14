<?php

namespace SlashStudio\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class TeamRepository extends EntityRepository
{
    public function getInfo()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT t, a, p, i FROM SlashStudioAppBundle:Team t JOIN t.achievements a LEFT JOIN t.captain p LEFT JOIN t.image i'
            )
            ->getOneOrNullResult();
    }
}
