<?php

namespace SlashStudio\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class TeamRepository extends EntityRepository
{

    public function getPhotoQuery()
    {
        $manager = $this->getEntityManager();
        $team = $manager->createQuery(
            'SELECT PARTIAL t.{id}, g FROM SlashStudioAppBundle:Team t LEFT JOIN t.gallery g'
        )
        ->getSingleResult();

        return $manager->createQuery(
            'SELECT m FROM ApplicationSonataMediaBundle:Media m
                JOIN m.galleryHasMedias ghs
                JOIN ghs.gallery g WHERE g = :gallery'
        )->setParameter('gallery', $team->getPhotoGallery());
    }

    public function getManagerEmail()
    {
        return $this->getEntityManager()
                    ->createQuery(
                        'SELECT PARTIAL t.{id, managerEmail} FROM SlashStudioAppBundle:Team t'
                    )
                    ->getSingleResult()
                    ->getManagerEmail();
    }

    public function getShortInfo()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT t, tr FROM SlashStudioAppBundle:Team t
                    LEFT JOIN t.translations tr'
            )
            ->getOneOrNullResult();
    }

   public function getVideoQuery()
   {
        $manager = $this->getEntityManager();
        $team = $manager->createQuery(
            'SELECT PARTIAL t.{id}, g FROM SlashStudioAppBundle:Team t LEFT JOIN t.gallery g'
        )
        ->getSingleResult();

        return $manager->createQuery(
            'SELECT m FROM ApplicationSonataMediaBundle:Media m
                JOIN m.galleryHasMedias ghs
                JOIN ghs.gallery g WHERE g = :gallery
                ORDER BY m.createdAt DESC'
        )
        ->setParameter('gallery', $team->getGallery());
   }

    public function getVideoForTeam($amount = 2)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT m FROM ApplicationSonataMediaBundle:Media m
                  JOIN m.galleryHasMedias ghs
                  JOIN ghs.gallery g JOIN SlashStudioAppBundle:Team t WHERE t.gallery = g
                  ORDER BY m.createdAt DESC'
            )
            ->setMaxResults($amount)
            ->getResult();
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
            ->getSingleResult();
    }
}
