<?php

namespace SlashStudio\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;


class SlideRepository extends EntityRepository
{
    public function getSlides()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT s, i FROM SlashStudioAppBundle:Slide s LEFT JOIN s.image i')
            ->getResult();
    }
}
