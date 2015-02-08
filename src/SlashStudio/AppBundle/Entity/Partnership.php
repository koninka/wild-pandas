<?php

namespace SlashStudio\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Logo
 *
 * @ORM\Table(name="partnership")
 * @ORM\Entity(repositoryClass="PartnershipRepository")
 */
class Partnership
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
     * @ORM\Column(name="name", type="string", length=150)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var partnershipEnumType
     *
     * @ORM\Column(name="type", type="partnershipEnumType")
     */
    private $type;

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
     * @return Partnership
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


}
