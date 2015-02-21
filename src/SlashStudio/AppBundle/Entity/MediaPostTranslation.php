<?php

namespace SlashStudio\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * MediaPost
 *
 * @ORM\Table(name="media_posts_translation")
 * @ORM\Entity
 */
class MediaPostTranslation
{
    use ORMBehaviors\Translatable\Translation;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=60)
     * @Assert\NotBlank()
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="subtitle", type="string", length=100)
     * @Assert\NotBlank()
     * @Assert\Length(max=100)
     */
    private $subtitle;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="text")
     */
    private $text;

    /**
     * @var string
     *
     * @ORM\Column(name="raw_text", type="text")
     */
    private $rawText;

    /**
     * @var string
     *
     * @ORM\Column(name="text_formatter", type="string", length=40)
     */
    private $textFormatter;

    /**
     * @return string
     */
    public function getTextFormatter()
    {
        return $this->textFormatter;
    }

    /**
     * @param string $textFormatter
     * @return MediaPostTranslation
     */
    public function setTextFormatter($textFormatter)
    {
        $this->textFormatter = $textFormatter;

        return $this;
    }

    /**
     * @return string
     */
    public function getRawText()
    {
        return $this->rawText;
    }

    /**
     * @param string $rawText
     * @return MediaPostTranslation
     */
    public function setRawText($rawText)
    {
        $this->rawText = $rawText;

        return $this;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return MediaPost
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
     * @return MediaPost
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
     * Set text
     *
     * @param string $text
     * @return Post
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }
}
