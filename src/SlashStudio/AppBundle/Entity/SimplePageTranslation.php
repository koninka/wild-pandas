<?php

namespace SlashStudio\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * SimplePage
 *
 * @ORM\Table(name="simple_pages_translation")
 * @ORM\Entity
 */
class SimplePageTranslation
{
    use ORMBehaviors\Translatable\Translation;

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
     * @return SimplePageTranslation
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
     * @return SimplePageTranslation
     */
    public function setRawText($rawText)
    {
        $this->rawText = $rawText;

        return $this;
    }

    /**
     * Set text
     *
     * @param string $text
     * @return SimplePageTranslation
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
