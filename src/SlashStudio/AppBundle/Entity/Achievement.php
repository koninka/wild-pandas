<?php

namespace SlashStudio\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use Application\Sonata\MediaBundle\Entity\Media;

/**
 * Achievement
 *
 * @ORM\Table(name="achievements")
 * @ORM\Entity
 */
class Achievement extends TranslationEntity
{
    use ORMBehaviors\Translatable\Translatable;

    /**
     * @var Team
     *
     * @ORM\ManyToOne(targetEntity="Team", inversedBy="achievements")
     * @ORM\JoinColumn(name="team_id", referencedColumnName="id")
     * @Assert\NotBlank()
     */
    private $team;

    /**
     * @var Media
     * @ORM\OneToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"}, orphanRemoval=true)
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id", nullable=true)
     */
    private $image;

    /**
     * @return Team
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * @param Team $team
     * @return Achievement
     */
    public function setTeam($team)
    {
        $this->team = $team;

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
}
