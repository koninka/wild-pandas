<?php

namespace SlashStudio\AppBundle\DBAL;

class StructureEnumType extends EnumType
{
    const ST_BASIC = 'basic';
    const ST_ADDITIONAL = 'additional';

    protected $name = 'structureEnumType';
    protected $values = [
        self::ST_BASIC,
        self::ST_ADDITIONAL,
    ];

    public function getChoices()
    {
        return [
            self::ST_BASIC => 'label.structure.basic',
            self::ST_ADDITIONAL => 'label.structure.additional',
        ];
    }
}
