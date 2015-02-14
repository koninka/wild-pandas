<?php

namespace SlashStudio\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class CheerleaderTeamRepository extends EntityRepository
{

    public function getInfo()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT cl, i FROM SlashStudioAppBundle:CheerleaderTeam cl LEFT JOIN cl.image i')
            ->setMaxResults(1)
            ->getOneOrNullResult();
    }
}
