<?php

namespace SlashStudio\AppBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use \Doctrine\DBAL\Types\Type;

class SlashStudioAppBundle extends Bundle
{
    public function __construct()
    {
        if (!Type::hasType('structureEnumType')) {
            Type::addType('structureEnumType', 'SlashStudio\AppBundle\DBAL\StructureEnumType');
        }
    }
}
