<?php

namespace SlashStudio\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Meta
 *
 * @ORM\Table(name="meta")
 * @ORM\Entity
 */
class Meta extends TranslationEntity
{
    use ORMBehaviors\Translatable\Translatable;
}
