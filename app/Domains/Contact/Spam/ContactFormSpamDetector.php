<?php

declare(strict_types=1);

namespace App\Domains\Contact\Spam;

use App\Domains\Contact\Data\ContactFormData;

/**
 * Herkent spam die door de honeypot heen komt aan de hand van de inhoud.
 *
 * Spambots vullen de velden vaak met willekeurige tekenreeksen zoals
 * "mfuedqrjzKBYRYGyBtQ" en gebruiken Gmail-adressen vol punten
 * ("a.y.o.s.a.r.o.m.33@gmail.com"), omdat Gmail punten negeert.
 */
class ContactFormSpamDetector
{
    /**
     * Minimale lengte van een losse tekenreeks voordat we deze als
     * willekeurige tekst kunnen beoordelen.
     */
    protected const int GIBBERISH_MIN_LENGTH = 8;

    /**
     * Aantal overgangen van kleine letter naar hoofdletter binnen één woord
     * vanaf waar we spreken van willekeurige tekst. Namen als "McDonald" of
     * "VanDerBerg" blijven hier ruim onder.
     */
    protected const int GIBBERISH_MIN_CASE_SWITCHES = 3;

    /**
     * Aantal punten in het lokale deel van een e-mailadres vanaf waar we
     * het adres als verdacht beschouwen.
     */
    protected const int EMAIL_MAX_DOTS = 4;

    /**
     * Geeft de reden terug waarom het bericht als spam is aangemerkt, of
     * null wanneer het bericht in orde lijkt.
     */
    public function reason(ContactFormData $data): ?string
    {
        foreach (['name', 'subject', 'message'] as $field) {
            if ($this->isGibberish($data->{$field})) {
                return "gibberish:{$field}";
            }
        }

        if ($this->hasSuspiciousEmail($data->email)) {
            return 'email';
        }

        return null;
    }

    public function isGibberish(?string $value): bool
    {
        $value = trim((string) $value);

        if (mb_strlen($value) < self::GIBBERISH_MIN_LENGTH) {
            return false;
        }

        // Alleen één aaneengesloten "woord" van letters, zonder spaties of leestekens.
        if (! preg_match('/^[a-zA-Z]+$/', $value)) {
            return false;
        }

        return preg_match_all('/[a-z][A-Z]/', $value) >= self::GIBBERISH_MIN_CASE_SWITCHES;
    }

    public function hasSuspiciousEmail(string $email): bool
    {
        $localPart = strstr($email, '@', true);

        if ($localPart === false) {
            return false;
        }

        return substr_count($localPart, '.') >= self::EMAIL_MAX_DOTS;
    }
}
