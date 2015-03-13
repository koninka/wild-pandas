<?php

namespace SlashStudio\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * SimplePage
 *
 * @ORM\Table(name="simple_pages")
 * @ORM\Entity(repositoryClass="SimplePageRepository")
 */
class SimplePage extends TranslationEntity
{
    use ORMBehaviors\Translatable\Translatable;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=150)
     */
    private $name;

    /**
     * @var Meta
     *
     * @ORM\OneToOne(targetEntity="Meta", cascade={"persist"}, orphanRemoval=true)
     * @ORM\JoinColumn(name="meta_id", referencedColumnName="id", nullable=true)
     */
    private $meta;


    /**
     * @return string
     */
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
     * Set name
     *
     * @param string $name
     * @return SimplePage
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set meta
     *
     * @param Meta $meta
     * @return SimplePage
     */
    public function setMeta($meta)
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

    public function __toString()
    {
        return $this->getName();
    }
}
