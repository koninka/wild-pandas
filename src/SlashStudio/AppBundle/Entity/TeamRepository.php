<?php

namespace SlashStudio\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class TeamRepository extends EntityRepository
{

   public function getShortInfo()
   {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT t, tr FROM SlashStudioAppBundle:Team t
                    LEFT JOIN t.translations tr'
            )
            ->getOneOrNullResult();
   }

    public function getInfo()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT t, a, p, i, ai, tr, a_tr FROM SlashStudioAppBundle:Team t
                    JOIN t.achievements a
                    LEFT JOIN a.translations a_tr
                    LEFT JOIN a.image ai
                    LEFT JOIN t.captain p
                    LEFT JOIN t.image i
                    LEFT JOIN t.translations tr'
            )
            ->getOneOrNullResult();
    }
}
