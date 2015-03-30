<?php

namespace SlashStudio\AppBundle\GoogleHelper;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\Translation\TranslatorInterface;

class GoogleHelper extends ContainerAware
{

    protected $translator;

    /**
     * @param TranslatorInterface $translator
     * @param string $email
     * @param string $calendarId
     */
    public function __construct(TranslatorInterface $translator, $email, $calendarId)
    {
        $this->translator = $translator;
        $this->email = $email;
        $this->calendarId = $calendarId;
    }

    static private function date3339($timestamp=0) {

        if (!$timestamp) {
            $timestamp = time();
        }
        $date = date('Y-m-d\TH:i:s', $timestamp);

        $matches = array();
        if (preg_match('/^([\-+])(\d{2})(\d{2})$/', date('O', $timestamp), $matches)) {
            $date .= $matches[1].$matches[2].':'.$matches[3];
        } else {
            $date .= 'Z';
        }
        return $date;
    }

    public function getSoonEvent() {
        $key = file_get_contents(__DIR__ . '/key.p12');
        $scopes = ["https://www.googleapis.com/auth/calendar.readonly"];

        $credentials = new \Google_Auth_AssertionCredentials(
            $this->email,
            $scopes,
            $key
        );

        $client = new \Google_Client();
        $client->setAssertionCredentials($credentials);
        if ($client->getAuth()->isAccessTokenExpired()) {
            $client->getAuth()->refreshTokenWithAssertion();
        }

        $service = new \Google_Service_Calendar($client);
        $calendarList  = $service->events->listEvents(
            $this->calendarId,
            [
                'orderBy' => 'starttime',
                'singleEvents' => 'true',
                'maxResults' => '100',
                'timeMin' => self::date3339((new \DateTime())->getTimestamp())
            ]
        );
        $calendarListEntry = $calendarList->getItems();
        if (!count($calendarListEntry)) {
            return null;
        }
        $calendarItem = $calendarListEntry[0];
        return [
            'start'   => $calendarItem->getStart()->getDateTime(),
            'summary' => $calendarItem->getSummary(),
            'end'     => $calendarItem->getEnd()->getDateTime()
        ];
    }

    public function simplifyEvent($event)
    {
        if ($event === null || $event['date']->getTimestamp() < (new \DateTime)->getTimestamp()) {
            $event = [
                'summary' => $this->translator->trans('months.noevents', [], 'months')
            ];
        } else {
            $event['month'] = $this->translator->trans("months.m$event[month]", [], 'months');
        }
        return $event;
    }
}