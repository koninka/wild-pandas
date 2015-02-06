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
}
