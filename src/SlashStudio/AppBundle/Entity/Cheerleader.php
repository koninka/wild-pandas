<?php

namespace SlashStudio\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Application\Sonata\MediaBundle\Entity\Media;

/**
 * Cheerleader
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SlashStudio\AppBundle\Entity\CheerleaderRepository")
 */
class Cheerleader
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
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=100)
     */
    private $surname;

    /**
     * @var string
     *
     * @ORM\Column(name="about", type="text")
     */
    private $about;

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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Cheerleader
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
     * Set surname
     *
     * @param string $surname
     * @return Cheerleader
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string 
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set about
     *
     * @param string $about
     * @return Cheerleader
     */
    public function setAbout($about)
    {
        $this->about = $about;

        return $this;
    }

    /**
     * Get about
     *
     * @return string 
     */
    public function getAbout()
    {
        return $this->about;
    }

    /**
     *
     * @return string
     */
    public function getFullName()
    {
        return sprintf('%s %s', $this->name, $this->surname);
    }
}
