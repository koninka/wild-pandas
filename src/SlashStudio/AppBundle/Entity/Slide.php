<?php

namespace SlashStudio\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Application\Sonata\MediaBundle\Entity\Media;

/**
 * Slide
 *
 * @ORM\Table(name="slides")
 * @ORM\Entity(repositoryClass="SlideRepository")
 */
class Slide
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=100)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="subtitle", type="string", length=100, nullable=true)
     */
    private $subtitle;

    /**
     * @var integer
     *
     * @ORM\Column(name="display_order", type="integer", options={"default" = 0})
     */
    private $position;

    /**
     * @var Media
     * @ORM\OneToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"}, orphanRemoval=true)
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id", nullable=true)
     */
    private $image;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Slide
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set subtitle
     *
     * @param string $subtitle
     * @return Slide
     */
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    /**
     * Get subtitle
     *
     * @return string
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return Slide
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
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
     * @return Slide
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

}
