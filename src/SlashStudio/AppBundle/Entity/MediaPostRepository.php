<?php

namespace SlashStudio\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class MediaPostRepository extends EntityRepository
{
    public function getPostInfo($id)
    {
        return $this->getEntityManager()
                    ->createQuery('SELECT p, m, i FROM SlashStudioAppBundle:MediaPost p LEFT JOIN p.meta m LEFT JOIN p.image i WHERE p.id = :id ')
                    ->setParameter('id', $id)
                    ->getOneOrNullResult();
    }

    public function getMediaQuery()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT m, i, t FROM SlashStudioAppBundle:MediaPost m LEFT JOIN m.image i LEFT JOIN m.translations t ORDER BY m.createdAt DESC');

    }
}
