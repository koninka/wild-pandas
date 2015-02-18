<?php

namespace SlashStudio\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class MediaPostRepository extends EntityRepository
{
    public function getMediaQuery()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT m, i, t FROM SlashStudioAppBundle:MediaPost m LEFT JOIN m.image i LEFT JOIN m.translations t ORDER BY m.createdAt DESC');

    }
}
