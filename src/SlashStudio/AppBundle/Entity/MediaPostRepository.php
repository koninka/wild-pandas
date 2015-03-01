<?php

namespace SlashStudio\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class MediaPostRepository extends EntityRepository
{
    public function getPostInfo($id)
    {
        return $this->getEntityManager()
                    ->createQuery('SELECT p, m, i FROM SlashStudioAppBundle:MediaPost p LEFT JOIN p.meta m LEFT JOIN p.image i WHERE p.id = :id ')
                    ->setParameter('id', $id)
                    ->getOneOrNullResult();
    }

    public function getOtherPosts($post, $amount)
    {
        return new Paginator(
            $this->getMediaPostQB()->andWhere('m.id NOT IN (:id)')->setParameter('id', $post->getId())->setMaxResults($amount)
        );
    }

    public function getMediaPostQB()
    {
        return $this->getEntityManager()
            ->createQueryBuilder()
            ->select(['m', 'i', 't'])
            ->from('SlashStudioAppBundle:MediaPost', 'm')
            ->leftJoin('m.image', 'i')
            ->leftJoin('m.translations', 't')
            ->orderBy('m.createdAt', 'DESC');
    }
}
