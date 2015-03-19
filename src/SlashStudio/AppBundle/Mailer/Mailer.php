<?php

namespace SlashStudio\AppBundle\Mailer;

use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberUtil;

use SlashStudio\AppBundle\Entity\CheerleaderTeamProposalMembership;
use SlashStudio\AppBundle\Entity\Product;
use SlashStudio\AppBundle\Entity\ProposalPurchaseProduct;
use SlashStudio\AppBundle\Entity\TeamProposalMembership;

use Symfony\Component\Translation\TranslatorInterface;

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
     * @param TranslatorInterface $translator
     * @param string $fromEmail
     */
    public function __construct(\Swift_Mailer $mailer, PhoneNumberUtil $phoneNumberUtil, TranslatorInterface $translator, $fromEmail)
    {
        $this->mailer = $mailer;
        $this->translator = $translator;
        $this->fromEmail = $fromEmail;
        $this->phoneNumberUtil = $phoneNumberUtil;
    }

    private function send($subject, $to, $body)
    {
        $message = $this->mailer->createMessage()
                                ->setSubject($subject)
                                ->setTo($to)
                                ->setFrom($this->fromEmail)
                                ->setBody($body);
        $this->mailer->send($message);
    }

    public function sendOrderEmails(ProposalPurchaseProduct $purchaseProduct, Product $product, $managerEmail)
    {
        $this->send(
            $this->translator->trans('email.product.purchase.subject', [], 'emails'),
            $purchaseProduct->getEmail(),
            $this->translator->trans(
                'email.product.purchase.user.body',
                [
                    '%product%' => $purchaseProduct->getProduct()->getName(),
                ],
                'emails'
            )
        );

        $this->send(
            $this->translator->trans('email.product.purchase.subject', [], 'emails', 'ru'),
            $managerEmail,
            $this->translator->trans(
                'email.product.purchase.manager.body',
                [
                    '%name%' => $purchaseProduct->getName(),
                    '%surname%' => $purchaseProduct->getSurname(),
                    '%phone%' => $this->phoneNumberUtil->format($purchaseProduct->getPhone(), PhoneNumberFormat::NATIONAL),
                    '%email%' => $purchaseProduct->getEmail(),
                    '%product%' => $purchaseProduct->getProduct()->getName(),
                ],
                'emails',
                'ru'
            )
        );
    }

    public function sendCheerleaderTeamJoinEmails(CheerleaderTeamProposalMembership $proposalMembership, $managerEmail)
    {
        $this->send(
            $this->translator->trans('email.cheerleader_team.join.subject', [], 'emails'),
            $proposalMembership->getEmail(),
            $this->translator->trans('email.cheerleader_team.join.user.body', [], 'emails')
        );

        $this->send(
            $this->translator->trans('email.cheerleader_team.join.subject', [], 'emails', 'ru'),
            $managerEmail,
            $this->translator->trans(
                'email.cheerleader_team.join.manager.body',
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
    }

    public function sendTeamJoinEmails(TeamProposalMembership $proposalMembership, $managerEmail)
    {
        $this->send(
            $this->translator->trans('email.team.join.subject', [], 'emails'),
            $proposalMembership->getEmail(),
            $this->translator->trans('email.team.join.user.body', [], 'emails')
        );

        $this->send(
            $this->translator->trans('email.team.join.subject', [], 'emails', 'ru'),
            $managerEmail,
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
    }
}