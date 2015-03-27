<?php

namespace SlashStudio\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
// use Doctrine\ORM\Query\Expr\Join;

class GoogleEventRepository extends EntityRepository
{
    public function getEvent()
    {
        $items = $this->findAll();
        if (!count($items)) {
            return null;
        }
        return [
            "summary" => $items[0]->getSummary(),
            "day" => $items[0]->getDay(),
            "month" => $items[0]->getMonth()
        ];
    }

}
