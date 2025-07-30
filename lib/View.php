<?php

namespace FriendsOfRedaxo\ServiceBw;

use rex_fragment;

class View
{
    public static function getLebenslagen(): string
    {
        $lebenslageID = rex_request('lebenslage', 'int', '0');
        if ($lebenslageID > 0) {
            $response = API::requestLebenslageById($lebenslageID);
            if (null === $response || empty($response)) {
                return '';
            }

            $fragment = new rex_fragment();
            $fragment->setVar('item', $response, false);
            return $fragment->parse('lebenslage.php');
        }

        $response = API::requestLebenslagen();

        if (null === $response || empty($response)) {
            return '';
        }
        $fragment = new rex_fragment();
        $fragment->setVar('items', $response['items'], false);
        return $fragment->parse('lebenslagen.php');
    }

    public static function getDienstleistungen(): string
    {
        $dienstleistungID = rex_request('dienstleistung', 'int', '0');
        if ($dienstleistungID > 0) {
            $response = API::requestDienstleistungById($dienstleistungID);
            if (null === $response || empty($response)) {
                return '';
            }

            $fragment = new rex_fragment();
            $fragment->setVar('item', $response, false);
            return $fragment->parse('dienstleistung.php');
        }

        $response = API::requestDienstleistungen();

        if (null === $response || empty($response)) {
            return '';
        }
        $fragment = new rex_fragment();
        $fragment->setVar('items', $response['items'], false);
        return $fragment->parse('dienstleistungen.php');
    }

}
