<?php

namespace SlashStudio\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use SlashStudio\AppBundle\Entity\InstagramPhoto;

/**
 * InstagramPost
 *
 * @ORM\Table(name="instagram_posts")
 * @ORM\Entity(repositoryClass="SlashStudio\AppBundle\Entity\InstagramPostRepository")
 */
class InstagramPost
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var Meta
     *
     * @ORM\OneToOne(targetEntity="Meta", cascade={"persist"}, orphanRemoval=true)
     * @ORM\JoinColumn(name="meta_id", referencedColumnName="id", nullable=true)
     */
    private $meta;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=150)
     */
    private $link;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="post_time", type="datetime")
     */
    private $postTime;

    /**
     * @var InstagramPhoto
     *
     * @ORM\OneToOne(targetEntity="InstagramPhoto",cascade={"persist"}, orphanRemoval=true)
     * @ORM\JoinColumn(name="low_resolution_id", referencedColumnName="id", nullable=true)
     */
    private $lowResolution;

    /**
     * @var InstagramPhoto
     *
     * @ORM\OneToOne(targetEntity="InstagramPhoto", cascade={"persist"}, orphanRemoval=true)
     * @ORM\JoinColumn(name="thumbnail_id", referencedColumnName="id", nullable=true)
     */
    private $thumbnail;

    /**
     * @var InstagramPhoto
     *
     * @ORM\OneToOne(targetEntity="InstagramPhoto", cascade={"persist"}, orphanRemoval=true)
     * @ORM\JoinColumn(name="standard_resolution_id", referencedColumnName="id", nullable=true)
     */
    private $standardResolution;

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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return InstagramPost
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set link
     *
     * @param string $link
     * @return InstagramPost
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string 
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set postTime
     *
     * @param \DateTime $postTime
     * @return InstagramPost
     */
    public function setPostTime($postTime)
    {
        $this->postTime = $postTime;

        return $this;
    }

    /**
     * Get postTime
     *
     * @return \DateTime 
     */
    public function getPostTime()
    {
        return $this->postTime;
    }

    /**
     * Set meta
     *
     * @param \SlashStudio\AppBundle\Entity\Meta $meta
     * @return InstagramPost
     */
    public function setMeta(\SlashStudio\AppBundle\Entity\Meta $meta = null)
    {
        $this->meta = $meta;

        return $this;
    }

    /**
     * Get meta
     *
     * @return \SlashStudio\AppBundle\Entity\Meta 
     */
    public function getMeta()
    {
        return $this->meta;
    }

    /**
     * Set lowResolution
     *
     * @param \SlashStudio\AppBundle\Entity\InstagramPhoto $lowResolution
     * @return InstagramPost
     */
    public function setLowResolution(\SlashStudio\AppBundle\Entity\InstagramPhoto $lowResolution = null)
    {
        $this->lowResolution = $lowResolution;

        return $this;
    }

    /**
     * Get lowResolution
     *
     * @return \SlashStudio\AppBundle\Entity\InstagramPhoto 
     */
    public function getLowResolution()
    {
        return $this->lowResolution;
    }

    /**
     * Set thumbnail
     *
     * @param \SlashStudio\AppBundle\Entity\InstagramPhoto $thumbnail
     * @return InstagramPost
     */
    public function setThumbnail(\SlashStudio\AppBundle\Entity\InstagramPhoto $thumbnail = null)
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    /**
     * Get thumbnail
     *
     * @return \SlashStudio\AppBundle\Entity\InstagramPhoto 
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    /**
     * Set standardResolution
     *
     * @param \SlashStudio\AppBundle\Entity\InstagramPhoto $standardResolution
     * @return InstagramPost
     */
    public function setstandardResolution(\SlashStudio\AppBundle\Entity\InstagramPhoto $standardResolution = null)
    {
        $this->standardResolution = $standardResolution;

        return $this;
    }

    /**
     * Get standardResolution
     *
     * @return \SlashStudio\AppBundle\Entity\InstagramPhoto 
     */
    public function getstandardResolution()
    {
        return $this->standardResolution;
    }
}
