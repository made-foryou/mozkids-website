<?php

declare(strict_types=1);

namespace Tests\Unit\Domains\Contact;

use App\Domains\Contact\Spam\ContactFormSpamDetector;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class ContactFormSpamDetectorTest extends TestCase
{
    #[Test]
    #[DataProvider('gibberish')]
    public function it_recognises_random_strings_as_gibberish(string $value): void
    {
        self::assertTrue((new ContactFormSpamDetector)->isGibberish($value));
    }

    #[Test]
    #[DataProvider('normalText')]
    public function it_does_not_flag_normal_text_as_gibberish(?string $value): void
    {
        self::assertFalse((new ContactFormSpamDetector)->isGibberish($value));
    }

    #[Test]
    public function it_flags_email_addresses_full_of_dots(): void
    {
        $detector = new ContactFormSpamDetector;

        self::assertTrue($detector->hasSuspiciousEmail('a.y.o.s.a.r.o.m.33@gmail.com'));
        self::assertTrue($detector->hasSuspiciousEmail('r.ok.ohi.x.i80@gmail.com'));
        self::assertTrue($detector->hasSuspiciousEmail('vo.yoj.a.y.ak.e555@gmail.com'));

        self::assertFalse($detector->hasSuspiciousEmail('sanne@example.com'));
        self::assertFalse($detector->hasSuspiciousEmail('sanne.de.vries@example.com'));
        self::assertFalse($detector->hasSuspiciousEmail('j.p.de.vries@example.com'));
    }

    public static function gibberish(): array
    {
        return [
            ['mfuedqrjzKBYRYGyBtQ'],
            ['PPKTOlBtWWAZoZjpYz'],
            ['tjLzlUxBVIDSMIwuUNsjdI'],
            ['iLaYaXgOFFefmOqbIsMiG'],
            ['ypBmpttdIGzZzBtuOul'],
            ['ujBceuwDgIbknNoSZAAk'],
            ['ibATvGcHWgpqrMqPOn'],
            ['ocBHmDfmmBrBdDvFmEHF'],
            ['ZhfisBfMTuEvsxXMOJ'],
        ];
    }

    public static function normalText(): array
    {
        return [
            [null],
            [''],
            ['Sanne de Vries'],
            ['McDonald'],
            ['VanDerBerg'],
            ['Vraag'],
            ['Sponsoring'],
            ['Hallo, ik wil graag meer informatie over de Polderrun.'],
        ];
    }
}
