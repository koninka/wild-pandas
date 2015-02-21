<?php

namespace SlashStudio\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use Application\Sonata\MediaBundle\Entity\Media;

/**
 * MediaPost
 *
 * @ORM\Table(name="media_posts")
 * @ORM\Entity(repositoryClass="SlashStudio\AppBundle\Entity\MediaPostRepository")
 */
class MediaPost extends TranslationEntity
{
    use ORMBehaviors\Translatable\Translatable;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var Meta
     *
     * @ORM\OneToOne(targetEntity="Meta", cascade={"persist"}, orphanRemoval=true)
     * @ORM\JoinColumn(name="meta_id", referencedColumnName="id", nullable=true)
     */
    private $meta;

    /**
     * @var Media
     * @ORM\OneToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"}, orphanRemoval=true)
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id", nullable=true)
     */
    private $image;

    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
    }

    public function getTextFormatter()
    {
        return $this->proxyCurrentLocaleTranslation('getTextFormatter');
    }

    /**
     * @return string
     */
    public function getRawText()
    {
        return $this->proxyCurrentLocaleTranslation('getRawText');
    }

    /**
     * @return string
     */
    public function setText($text)
    {
        return $this->proxyCurrentLocaleTranslation('setText', [$text]);
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     * @return Post
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Set meta
     *
     * @param Meta $meta
     * @return MediaPost
     */
    public function setMeta(Meta $meta = null)
    {
        $this->meta = $meta;

        return $this;
    }

    /**
     * Get meta
     *
     * @return Meta
     */
    public function getMeta()
    {
        return $this->meta;
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
        return $this->getTitle();
    }
}
