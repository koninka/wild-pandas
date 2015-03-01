<?php

namespace SlashStudio\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class PostRepository extends EntityRepository
{
    const POSTS_ON_MAIN_PAGE = 3;

    public function getPostInfo($id)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p, m, i, t FROM SlashStudioAppBundle:Post p LEFT JOIN p.meta m LEFT JOIN p.image i LEFT JOIN p.translations t WHERE p.id = :id '
            )
            ->setParameter('id', $id)
            ->getOneOrNullResult();
    }

    public function getPostsQB()
    {
        return $this->getEntityManager()
                   ->createQueryBuilder()
                   ->select(['p', 'i', 't'])
                   ->from('SlashStudioAppBundle:Post', 'p')
                   ->leftJoin('p.image', 'i')
                   ->leftJoin('p.translations', 't')
                   ->orderBy('p.createdAt', 'DESC');
    }

    protected function getLimitedPostsQB($amount)
    {
        return $this->getPostsQB()->setMaxResults($amount);
    }

    public function getLimitedPosts($amount)
    {
        return new Paginator($this->getLimitedPostsQB($amount));
    }

    public function getOtherPosts(Post $post, $amount)
    {
        return new Paginator(
            $this->getLimitedPostsQB($amount)->andWhere('p.id NOT IN (:id)')->setParameter('id', $post->getId())
        );
    }

    public function getPostsForMainPage()
    {
        return new Paginator($this->getPostsQB()->where('p.showOnTheMain = true')->setMaxResults(static::POSTS_ON_MAIN_PAGE));
    }
}
