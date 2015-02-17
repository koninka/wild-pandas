<?php

namespace SlashStudio\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use Application\Sonata\MediaBundle\Entity\Media;

/**
 * Partnership
 *
 * @ORM\Table(name="partnership")
 * @ORM\Entity(repositoryClass="PartnershipRepository")
 */
class Partnership extends TranslationEntity
{
    use ORMBehaviors\Translatable\Translatable;

    /**
     * @var partnershipEnumType
     *
     * @ORM\Column(name="type", type="partnershipEnumType")
     */
    private $type;

    /**
     * @var Media
     * @ORM\OneToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"}, orphanRemoval=true)
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id", nullable=true)
     */
    private $image;

    /**
     * @return PartnershipEnumType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param PartnershipEnumType $type
     * @return Partnership
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Media
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param Media $image
     * @return Team
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    public function __toString()
    {
        return $this->getName();
    }
}
