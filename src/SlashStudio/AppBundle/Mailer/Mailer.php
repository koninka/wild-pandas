<?php

namespace SlashStudio\AppBundle\Mailer;

use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberUtil;
use SlashStudio\AppBundle\Entity\TeamProposalMembership;
use Symfony\Component\Translation\LoggingTranslator;

class Mailer
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var LoggingTranslator
     */
    private $translator;

    /**
     * @var string
     */
    private $fromEmail;

    /**
     * @var PhoneNumberUtil
     */
    private $phoneNumberUtil;

    /**
     * @param \Swift_Mailer $mailer
     * @param PhoneNumberUtil $phoneNumberUtil
     * @param LoggingTranslator $translator
     * @param string $fromEmail
     */
    public function __construct(\Swift_Mailer $mailer, PhoneNumberUtil $phoneNumberUtil, LoggingTranslator $translator, $fromEmail)
    {
        $this->mailer = $mailer;
        $this->translator = $translator;
        $this->fromEmail = $fromEmail;
        $this->phoneNumberUtil = $phoneNumberUtil;
    }

    public function sendJoinEmails(TeamProposalMembership $proposalMembership, $managerEmail)
    {
        $message = $this->mailer->createMessage()
                          ->setSubject($this->translator->trans('email.team.join.subject', [], 'emails'))
                          ->setTo($proposalMembership->getEmail())
                          ->setFrom($this->fromEmail)
                          ->setBody($this->translator->trans('email.team.join.user.body', [], 'emails'));
        $this->mailer->send($message);

        $message = $this->mailer->createMessage()
                          ->setSubject($this->translator->trans('email.team.join.subject', [], 'emails', 'ru'))
                          ->setTo($managerEmail)
                          ->setFrom($this->fromEmail)
                          ->setBody(
                              $this->translator->trans(
                                  'email.team.join.manager.body',
                                  [
                                      '%name%' => $proposalMembership->getName(),
                                      '%surname%' => $proposalMembership->getSurname(),
                                      '%phone%' => $this->phoneNumberUtil->format($proposalMembership->getPhone(), PhoneNumberFormat::NATIONAL),
                                      '%email%' => $proposalMembership->getEmail(),
                                  ],
                                  'emails',
                                  'ru'
                              )
                          );
        $this->mailer->send($message);
    }
}