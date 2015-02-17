<?php

namespace SlashStudio\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

class TranslationEntity
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function __call($method, $arguments)
    {
        $method = ('get' === substr($method, 0, 3)) ? $method : 'get'. ucfirst($method);

        return method_exists($this, $method) ? $this->$method() : $this->proxyCurrentLocaleTranslation($method, $arguments);
    }
}
