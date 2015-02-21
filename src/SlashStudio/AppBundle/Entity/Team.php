<?php

namespace SlashStudio\AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use Symfony\Component\Validator\Constraints as Assert;
use Application\Sonata\MediaBundle\Entity\Media;
use Application\Sonata\MediaBundle\Entity\Gallery;

/**
 * Team
 *
 * @ORM\Table(name="team")
 * @ORM\Entity(repositoryClass="TeamRepository")
 */
class Team extends TranslationEntity
{
    use ORMBehaviors\Translatable\Translatable;

    /**
     * @var integer
     *
     * @ORM\OneToMany(targetEntity="Achievement", mappedBy="team", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $achievements;

    /**
     * @var Player
     *
     * @ORM\OneToOne(targetEntity="Player")
     * @ORM\JoinColumn(name="captain_id", referencedColumnName="id", nullable=true),
     */
    private $captain;

    /**
     * @var string
     *
     * @ORM\Column(name="manager_phone", type="string", length=30, nullable=true)
     */
    private $managerPhone;

    /**
     * @var string
     *
     * @ORM\Column(name="manager_email", type="string", length=30, nullable=true)
     * @Assert\Email()
     */
    private $managerEmail;

    /**
     * @var Media
     * @ORM\OneToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"}, orphanRemoval=true)
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id", nullable=true)
     */
    private $image;


    public function __construct()
    {
        $this->achievements = new ArrayCollection();
    }

    /**
     * Add achievement
     *
     * @param Achievement $achievement
     * @return Team
     */
    public function addAchievement(Achievement $achievement)
    {
        $achievement->setTeam($this);
        $this->achievements[] = $achievement;

        return $this;
    }

    /**
     * Remove achievement
     *
     * @param Achievement $achievement
     * @return Team
     */
    public function removeAchievement(Achievement $achievement)
    {
        $achievement->setTeam(null);
        $this->achievements->removeElement($achievement);

        return $this;
    }

    /**
     * Get achievements
     *
     * @return integer
     */
    public function getAchievements()
    {
        return $this->achievements;
    }

    /**
     * @return Player
     */
    public function getCaptain()
    {
        return $this->captain;
    }

    /**
     * @param Player $captain
     * @return Team
     */
    public function setCaptain(Player $captain = null)
    {
        $this->captain = $captain;

        return $this;
    }

    /**
     * @return string
     */
    public function getManagerPhone()
    {
        return $this->managerPhone;
    }

    /**
     * @param string $managerPhone
     * @return Team
     */
    public function setManagerPhone($managerPhone)
    {
        $this->managerPhone = $managerPhone;

        return $this;
    }

    /**
     * @return string
     */
    public function getManagerEmail()
    {
        return $this->managerEmail;
    }

    /**
     * @param string $managerEmail
     * @return Team
     */
    public function setManagerEmail($managerEmail)
    {
        $this->managerEmail = $managerEmail;

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
