<?php

namespace SlashStudio\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class CheerleaderTeamRepository extends EntityRepository
{
    public function getShortInfo()
    {
        return $this->getEntityManager()
                    ->createQuery('SELECT cl, t FROM SlashStudioAppBundle:CheerleaderTeam cl LEFT JOIN cl.translations t')
                    ->getOneOrNullResult();
    }

    public function getInfo()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT cl, i, t FROM SlashStudioAppBundle:CheerleaderTeam cl LEFT JOIN cl.image i LEFT JOIN cl.translations t')
            ->getOneOrNullResult();
    }
}
