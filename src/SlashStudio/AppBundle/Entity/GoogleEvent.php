<?php

namespace SlashStudio\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GoogleEvent
 *
 * @ORM\Table(name="google_events")
 * @ORM\Entity(repositoryClass="SlashStudio\AppBundle\Entity\GoogleEventRepository")
 */
class GoogleEvent
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="exec_date", type="datetime", nullable=false)
     */
    protected $execDate;

    /**
     * @var string
     *
     * @ORM\Column(name="summary", type="string", length=255)
     */
    protected $summary;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function getDay()
    {
        return intval($this->execDate->format('d'));
    }

    public function getMonth()
    {
        return intval($this->execDate->format('m'));
    }

    /**
     * Set execDate
     *
     * @param \DateTime $execDate
     * @return GoogleEvent
     */
    public function setExecDate(\DateTime $execDate)
    {
        $this->execDate = $execDate;

        return $this;
    }

    /**
     * Get execDate
     *
     * @return \Datetime
     */
    public function getExecDate()
    {
        return $this->execDate;
    }

    /**
     * Set summary
     *
     * @param string $summary
     * @return GoogleEvent
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;

        return $this;
    }

    /**
     * Get summarys
     * @return string
     */
    public function getSummary()
    {
        return $this->summary;
    }
}
