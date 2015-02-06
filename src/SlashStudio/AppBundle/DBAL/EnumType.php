<?php
namespace SlashStudio\AppBundle\DBAL;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;

abstract class EnumType extends Type
{
    protected $name;
    protected $values = [];

    public function getSqlDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        $values = array_map(function($val) { return "'$val'"; }, $this->values);

        return sprintf("ENUM(%s) COMMENT '(DC2Type: %s )'", implode(', ', $values), $this->name);
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return $value;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (!in_array($value, $this->values)) {
            throw new \InvalidArgumentException(sprintf("Invalid '%s' value.", $this->name));
        }

        return $value;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getChoices()
    {
        $choices = [];
        foreach ($this->values as $value) {
            $choices[$value] = ucfirst($value);
        }

        return $choices;
    }

    public function getFormType()
    {
        return 'choice';
    }

    public function getFormOptions()
    {
        return [
            'empty_value' => false,
            'choices' => $this->getChoices(),
        ];
    }
}
