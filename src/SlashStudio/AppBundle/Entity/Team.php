<?php

namespace SlashStudio\AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Team
 *
 * @ORM\Table(name="team")
 * @ORM\Entity(repositoryClass="TeamRepository")
 */
class Team
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
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\OneToMany(targetEntity="Achievement", mappedBy="team")
     */
    private $achievements;


    public function __construct()
    {
        $this->achievements = new ArrayCollection();
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
     * Set description
     *
     * @param string $description
     * @return Team
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
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
        $this->achievements->remove($achievement);

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
}
