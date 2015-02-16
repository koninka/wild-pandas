<?php

namespace SlashStudio\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use Application\Sonata\MediaBundle\Entity\Media;

/**
 * Cheerleader
 *
 * @ORM\Table(name="cheerleaders")
 * @ORM\Entity(repositoryClass="SlashStudio\AppBundle\Entity\CheerleaderRepository")
 */
class Cheerleader extends TranslationEntity
{
    use ORMBehaviors\Translatable\Translatable;

    /**
     * @var Media
     * @ORM\OneToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"}, orphanRemoval=true)
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id", nullable=true)
     */
    private $photo;

    /**
     * @return Media
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param Media $photo
     * @return Team
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     *
     * @return string
     */
    public function getFullName()
    {
        return sprintf('%s %s', $this->getName(), $this->getSurname());
    }
}
