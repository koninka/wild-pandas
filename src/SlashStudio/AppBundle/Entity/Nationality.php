<?php

namespace SlashStudio\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * Nationality
 *
 * @ORM\Table(name="nationalities")
 * @ORM\Entity
 */
class Nationality extends TranslationEntity
{
    use ORMBehaviors\Translatable\Translatable;
}
