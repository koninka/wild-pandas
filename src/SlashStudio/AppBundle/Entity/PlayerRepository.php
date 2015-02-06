<?php

namespace SlashStudio\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class PlayerRepository extends EntityRepository
{
    public function getPlayers()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT p, a FROM SlashStudioAppBundle:Player p JOIN p.position a')
            ->getArrayResult();
    }
}
