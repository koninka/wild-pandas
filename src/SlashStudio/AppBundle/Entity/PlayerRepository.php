<?php

namespace SlashStudio\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class PlayerRepository extends EntityRepository
{
    public function getPlayers($structure)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p, a, ph, pt, n, nt FROM SlashStudioAppBundle:Player p
                  JOIN p.position a LEFT JOIN p.photo ph
                  LEFT JOIN a.translations pt
                  LEFT JOIN p.nationality n
                  LEFT JOIN n.translations nt
                  WHERE p.structure = :structure
                  ORDER BY p.name ASC'
            )
            ->setParameter('structure', $structure)
            ->getResult();
    }
}
