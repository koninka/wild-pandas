<?php

namespace SlashStudio\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * Position
 *
 * @ORM\Table(name="positions")
 * @ORM\Entity
 */
class Position extends TranslationEntity
{
    use ORMBehaviors\Translatable\Translatable;
}
