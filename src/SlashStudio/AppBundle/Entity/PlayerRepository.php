<?php

namespace SlashStudio\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class PlayerRepository extends EntityRepository
{
    public function getPlayers($structure)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p, a, ph FROM SlashStudioAppBundle:Player p
                  JOIN p.position a LEFT JOIN p.photo ph
                  WHERE p.structure = :structure
                  ORDER BY p.name ASC'
            )
            ->setParameter('structure', $structure)
            ->getResult();
    }
}
