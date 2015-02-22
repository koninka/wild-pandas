<?php

namespace SlashStudio\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * CheerleaderTeamProposalMembership
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class CheerleaderTeamProposalMembership
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
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=100)
     * @Assert\NotBlank()
     */
    private $surname;

    /**
     * @var string
     *
     * @ORM\Column(name="patronymic", type="string", length=150, nullable=true)
     */
    private $patronymic;

    /**
     * @var integer
     *
     * @ORM\Column(name="age", type="integer")
     * @Assert\NotBlank()
     * @Assert\Type(type="integer")
     * @Assert\GreaterThan(value=0)
     */
    private $age;

    /**
     * @var string
     *
     * @ORM\Column(name="education", type="string", length=200, nullable=true)
     */
    private $education;

    /**
     * @var phone_number
     *
     * @ORM\Column(name="phone", type="phone_number")
     * @Assert\NotBlank()
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="choreographic_education", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $choreographicEducation;

    /**
     * @var string
     *
     * @ORM\Column(name="choreographic_style", type="string", length=150)
     * @Assert\NotBlank()
     */
    private $choreographicStyle;

    /**
     * @var integer
     *
     * @ORM\Column(name="choreographic_experience", type="integer")
     * @Assert\NotBlank()
     * @Assert\Type(type="integer")
     * @Assert\GreaterThanOrEqual(value=0)
     */
    private $choreographicExperience;

    /**
     * @var string
     *
     * @ORM\Column(name="choreographic_experience_playing", type="text")
     * @Assert\NotBlank()
     */
    private $choreographicExperiencePlaying;

    /**
     * @var string
     *
     * @ORM\Column(name="acrobatic_education", type="string", length=200)
     * @Assert\NotBlank()
     */
    private $acrobaticEducation;

    /**
     * @var integer
     *
     * @ORM\Column(name="acrobatic_experience", type="integer")
     * @Assert\NotBlank()
     * @Assert\Type(type="integer")
     * @Assert\GreaterThanOrEqual(value=0)
     */
    private $acrobaticExperience;

    /**
     * @var string
     *
     * @ORM\Column(name="acrobatic_elements", type="text")
     * @Assert\NotBlank()
     */
    private $acrobaticElements;

    /**
     * @var string
     *
     * @ORM\Column(name="hobby", type="text", nullable=true)
     */
    private $hobby;

    /**
     * @var string
     *
     * @ORM\Column(name="about", type="text", nullable=true)
     */
    private $about;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     * @Assert\NotBlank()
     */
    private $createdAt;

    /**
     * Conctructor
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
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
     * @return CheerleaderTeamProposalMembership
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
     * @return CheerleaderTeamProposalMembership
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
     * Set patronymic
     *
     * @param string $patronymic
     * @return CheerleaderTeamProposalMembership
     */
    public function setPatronymic($patronymic)
    {
        $this->patronymic = $patronymic;

        return $this;
    }

    /**
     * Get patronymic
     *
     * @return string
     */
    public function getPatronymic()
    {
        return $this->patronymic;
    }

    /**
     * Set age
     *
     * @param integer $age
     * @return CheerleaderTeamProposalMembership
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return integer
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set education
     *
     * @param string $education
     * @return CheerleaderTeamProposalMembership
     */
    public function setEducation($education)
    {
        $this->education = $education;

        return $this;
    }

    /**
     * Get education
     *
     * @return string
     */
    public function getEducation()
    {
        return $this->education;
    }

    /**
     * Set phone
     *
     * @param phone_number $phone
     * @return CheerleaderTeamProposalMembership
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return phone_number
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set choreographicEducation
     *
     * @param string $choreographicEducation
     * @return CheerleaderTeamProposalMembership
     */
    public function setChoreographicEducation($choreographicEducation)
    {
        $this->choreographicEducation = $choreographicEducation;

        return $this;
    }

    /**
     * Get choreographicEducation
     *
     * @return string
     */
    public function getChoreographicEducation()
    {
        return $this->choreographicEducation;
    }

    /**
     * Set choreographicStyle
     *
     * @param string $choreographicStyle
     * @return CheerleaderTeamProposalMembership
     */
    public function setChoreographicStyle($choreographicStyle)
    {
        $this->choreographicStyle = $choreographicStyle;

        return $this;
    }

    /**
     * Get choreographicStyle
     *
     * @return string
     */
    public function getChoreographicStyle()
    {
        return $this->choreographicStyle;
    }

    /**
     * Set choreographicExperience
     *
     * @param integer $choreographicExperience
     * @return CheerleaderTeamProposalMembership
     */
    public function setChoreographicExperience($choreographicExperience)
    {
        $this->choreographicExperience = $choreographicExperience;

        return $this;
    }

    /**
     * Get choreographicExperience
     *
     * @return integer
     */
    public function getChoreographicExperience()
    {
        return $this->choreographicExperience;
    }

    /**
     * Set choreographicExperiencePlaying
     *
     * @param string $choreographicExperiencePlaying
     * @return CheerleaderTeamProposalMembership
     */
    public function setChoreographicExperiencePlaying($choreographicExperiencePlaying)
    {
        $this->choreographicExperiencePlaying = $choreographicExperiencePlaying;

        return $this;
    }

    /**
     * Get choreographicExperiencePlaying
     *
     * @return string
     */
    public function getChoreographicExperiencePlaying()
    {
        return $this->choreographicExperiencePlaying;
    }

    /**
     * Set acrobaticEducation
     *
     * @param string $acrobaticEducation
     * @return CheerleaderTeamProposalMembership
     */
    public function setAcrobaticEducation($acrobaticEducation)
    {
        $this->acrobaticEducation = $acrobaticEducation;

        return $this;
    }

    /**
     * Get acrobaticEducation
     *
     * @return string
     */
    public function getAcrobaticEducation()
    {
        return $this->acrobaticEducation;
    }

    /**
     * Set acrobaticExperience
     *
     * @param integer $acrobaticExperience
     * @return CheerleaderTeamProposalMembership
     */
    public function setAcrobaticExperience($acrobaticExperience)
    {
        $this->acrobaticExperience = $acrobaticExperience;

        return $this;
    }

    /**
     * Get acrobaticExperience
     *
     * @return integer
     */
    public function getAcrobaticExperience()
    {
        return $this->acrobaticExperience;
    }

    /**
     * Set acrobaticElements
     *
     * @param string $acrobaticElements
     * @return CheerleaderTeamProposalMembership
     */
    public function setAcrobaticElements($acrobaticElements)
    {
        $this->acrobaticElements = $acrobaticElements;

        return $this;
    }

    /**
     * Get acrobaticElements
     *
     * @return string
     */
    public function getAcrobaticElements()
    {
        return $this->acrobaticElements;
    }

    /**
     * Set hobby
     *
     * @param string $hobby
     * @return CheerleaderTeamProposalMembership
     */
    public function setHobby($hobby)
    {
        $this->hobby = $hobby;

        return $this;
    }

    /**
     * Get hobby
     *
     * @return string
     */
    public function getHobby()
    {
        return $this->hobby;
    }

    /**
     * Set about
     *
     * @param string $about
     * @return CheerleaderTeamProposalMembership
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
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     * @return CheerleaderTeamProposalMembership
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get fullname
     * @return string
     */
    public function getFullname()
    {
        return sprintf('%s %s %s', $this->getName(), $this->getSurname(), $this->getPatronymic());
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getFullname();
    }
}
