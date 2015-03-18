<?php

namespace SlashStudio\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * @ORM\Table(name="team_translation")
 * @ORM\Entity
 */
class TeamTranslation
{
    use ORMBehaviors\Translatable\Translation;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=120)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="raw_description", type="text")
     */
    private $rawDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="description_formatter", type="string", length=40)
     */
    private $descriptionFormatter;


    /**
     * @var string
     *
     * @ORM\Column(name="manager_name", type="string", length=150, nullable=true)
     */
    private $managerName;

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
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
     * @return string
     */
    public function getDescriptionFormatter()
    {
        return $this->descriptionFormatter;
    }

    /**
     * @param string $descriptionFormatter
     * @return TeamTranslation
     */
    public function setDescriptionFormatter($descriptionFormatter)
    {
        $this->descriptionFormatter = $descriptionFormatter;

        return $this;
    }

    /**
     * @return string
     */
    public function getRawDescription()
    {
        return $this->rawDescription;
    }

    /**
     * @param string $rawDescription
     * @return TeamTranslationTranslation
     */
    public function setRawDescription($rawDescription)
    {
        $this->rawDescription = $rawDescription;

        return $this;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return TeamTranslation
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
     * @return string
     */
    public function getManagerName()
    {
        return $this->managerName;
    }

    /**
     * @param string $managerName
     * @return Team
     */
    public function setManagerName($managerName)
    {
        $this->managerName = $managerName;

        return $this;
    }
}
