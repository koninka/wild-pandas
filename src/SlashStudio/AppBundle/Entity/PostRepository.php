<?php

namespace SlashStudio\AppBundle\Entity;

use Doctrine\ORM\Query;
use Doctrine\ORM\EntityRepository;

class PostRepository extends EntityRepository
{
    const POSTS_ON_MAIN_PAGE = 3;

    public function getPostInfo($id)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT p, m FROM SlashStudioAppBundle:Post p LEFT JOIN p.meta m WHERE p.id = :id ')
            ->setParameter('id', $id)
            ->getOneOrNullResult(Query::HYDRATE_ARRAY);
    }

    public function getPostsForMainPage()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT p FROM SlashStudioAppBundle:Post p WHERE p.isShowOnMain = true ORDER BY p.createdAt DESC')
            ->setMaxResults(static::POSTS_ON_MAIN_PAGE)
            ->getArrayResult();
    }
}
