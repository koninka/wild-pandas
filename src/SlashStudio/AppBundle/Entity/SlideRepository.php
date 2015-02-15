<?php

namespace SlashStudio\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;


class SlideRepository extends EntityRepository
{
    public function getSlides()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT s, i, t FROM SlashStudioAppBundle:Slide s LEFT JOIN s.image i LEFT JOIN s.translations t')
            ->getResult();
    }
}
