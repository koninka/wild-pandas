<?php

namespace SlashStudio\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;

class InstagramPostRepository extends EntityRepository
{
    private function getLastQB()
    {
        return $this->getEntityManager()
                    ->createQueryBuilder()
                    ->select(
                        "posts.id as id, posts.link as link, posts.postTime as postTime,
                        lr.url as lr_url, lr.width as lr_width, lr.height as lr_height,
                        sr.url as sr_url, sr.width as sr_width, sr.height as sr_height
                    ")
                    ->from('SlashStudioAppBundle:InstagramPost', 'posts')
                    ->leftJoin('SlashStudioAppBundle:InstagramPhoto', 'lr', 'WITH', 'posts.lowResolution = lr.id')
                    ->leftJoin('SlashStudioAppBundle:InstagramPhoto', 'sr', 'WITH', 'posts.standardResolution = sr.id')
                    ->leftJoin('SlashStudioAppBundle:InstagramPhoto', 'thumbnail', 'WITH', 'posts.thumbnail = sr.id')
                    ->orderBy('posts.postTime', 'DESC');
    }

    public function getLast($cnt = 1)
    {
        return $this->getLastQB()
                    ->setMaxResults($cnt)
                    ->getQuery()
                    ->getArrayResult();
    }

    public function synchronize($posts)
    {
        if (count($posts) == 0) {
            return;
        }
        try {
            $last = $this->getLastQB()
                         ->setMaxResults(1)
                         ->getQuery()
                         ->getSingleResult();
            $lastTime = $last['postTime']->getTimestamp();
        } catch(\Doctrine\ORM\NoResultException $e) {
            $lastTime = 0;
            echo "IN ERROR\n";
        }
        foreach($posts as $time => $post) {
            echo "post_time = $time ||| last_time = $lastTime\n";
            if ($time <= $lastTime) {
                continue;
            }
            $this->_em->persist($post);
        }
        $this->_em->flush();
    }
}
