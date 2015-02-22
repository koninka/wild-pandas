<?php

namespace SlashStudio\AppBundle\Validator\Constraints;

use libphonenumber\PhoneNumberFormat;
use Misd\PhoneNumberBundle\Validator\Constraints\PhoneNumber as BasePhoneNumber;

/**
 * Phone number constraint.
 *
 * @Annotation
 */
class PhoneNumber extends BasePhoneNumber
{
    public $format = PhoneNumberFormat::NATIONAL;
}
