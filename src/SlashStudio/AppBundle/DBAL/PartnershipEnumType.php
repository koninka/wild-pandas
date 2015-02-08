<?php

namespace SlashStudio\AppBundle\DBAL;

class PartnershipEnumType extends EnumType
{
    const ST_PARTNER = 'partner';
    const ST_SPONSOR = 'sponsor';

    protected $name = 'partnershipEnumType';

    protected $values = [
        self::ST_PARTNER,
        self::ST_SPONSOR,
    ];
}
