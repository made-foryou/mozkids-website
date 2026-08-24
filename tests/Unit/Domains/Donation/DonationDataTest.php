<?php

declare(strict_types=1);

namespace Tests\Unit\Domains\Donation;

use App\Domains\Donation\Data\DonationData;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class DonationDataTest extends TestCase
{
    #[Test]
    public function it_translates_direct_debit_to_a_dutch_label(): void
    {
        self::assertSame(
            'Automatische incasso',
            $this->makeData('direct-debit')->paymentMethod,
        );
    }

    #[Test]
    public function it_translates_transfer_to_a_dutch_label(): void
    {
        self::assertSame(
            'Zelf overmaken',
            $this->makeData('transfer')->paymentMethod,
        );
    }

    protected function makeData(string $paymentMethod): DonationData
    {
        return new DonationData(
            type: 'child',
            amount: 20.0,
            frequency: 'monthly',
            paymentMethod: $paymentMethod,
            firstname: 'Sanne',
            infix: null,
            surname: 'de Vries',
            email: 'sanne@example.com',
            phone: '0612345678',
            comments: null,
            accountHolder: 'S. de Vries',
            iban: 'NL91ABNA0417164300',
            newsletter: false,
            privacy: true,
        );
    }
}
