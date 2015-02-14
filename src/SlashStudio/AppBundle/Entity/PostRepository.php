<?php

namespace SlashStudio\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class PostRepository extends EntityRepository
{
    const POSTS_ON_MAIN_PAGE = 3;

    public function getPostInfo($id)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT p, m, i FROM SlashStudioAppBundle:Post p LEFT JOIN p.meta m LEFT JOIN p.image i WHERE p.id = :id ')
            ->setParameter('id', $id)
            ->getOneOrNullResult();
    }

    public function getPosts($isMainPage = false)
    {
        $qb = $this->getEntityManager()
            ->createQueryBuilder()
            ->select(['p', 'i'])
            ->from('SlashStudioAppBundle:Post', 'p')
            ->leftJoin('p.image', 'i');
        if ($isMainPage) {
            $qb->where('p.showOnTheMain = true')->setMaxResults(static::POSTS_ON_MAIN_PAGE);
        }
        
        return $qb->getQuery()->getResult();
    }
}
