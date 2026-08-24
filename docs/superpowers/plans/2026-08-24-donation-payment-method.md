# Betaalwijze-vraag donatieformulier — Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Het donatieformulier krijgt onder "Frequentie" een verplichte vraag "Betaalwijze" (automatische incasso of zelf overmaken), en het gekozen antwoord verschijnt in beide donatiemails.

**Architecture:** De keuze reist als request-veld `payment-method` door de bestaande keten: `DonationFormRequest` valideert, `DonationData` vertaalt de sleutel naar een Nederlands label, en beide Blade-mailtemplates tonen dat label in de gegevenstabel. De controller en de frontend-JavaScript blijven ongewijzigd — de controller geeft de DTO al integraal door aan beide mailables. De wisselende toelichting onder de pills is pure CSS (Tailwind `group-has-*`), dus er komt geen JavaScript bij.

**Tech Stack:** Laravel 11, PHP 8.4, PHPUnit 11 (in-memory SQLite via `phpunit.xml`), Blade, Tailwind CSS 4, Laravel Pint.

## Global Constraints

- Spec: `docs/superpowers/specs/2026-08-24-donation-payment-method-design.md`.
- Werk op de huidige branch `feature/add-field`. Niet pushen, geen PR openen.
- Alle zichtbare teksten en admin-labels zijn Nederlands.
- Bestanden met `declare(strict_types=1)` behouden die regel.
- Request-veldnaam is exact `payment-method` (met streepje, zoals `account-holder` en `other-amount`).
- Toegestane waarden zijn exact `direct-debit` en `transfer`. Andere waarden bestaan niet.
- Mail-labels zijn exact `Automatische incasso` en `Zelf overmaken`.
- Radio-id's zijn exact `payment-direct-debit` en `payment-transfer`; de Tailwind-varianten verwijzen ernaar.
- `direct-debit` is de voorgeselecteerde optie.
- Draai `vendor/bin/pint` voor elke commit die PHP-bestanden raakt.
- Voer tests uit met `php artisan test`.

---

## Bestandsoverzicht

| Bestand | Verantwoordelijkheid | Actie |
| :--- | :--- | :--- |
| `app/Http/Requests/Api/DonationFormRequest.php` | Validatie van het nieuwe veld | Wijzigen |
| `app/Domains/Donation/Data/DonationData.php` | Vertaling sleutel → Nederlands label | Wijzigen |
| `resources/views/mail/donation-request-mail.blade.php` | Notificatiemail naar Moz Kids | Wijzigen |
| `resources/views/mail/donation-request-confirmation.blade.php` | Bevestigingsmail naar donateur | Wijzigen |
| `resources/views/components/columns/donation-form.blade.php` | Het formulierveld zelf | Wijzigen |
| `tests/Unit/Domains/Donation/DonationDataTest.php` | Unittest op de labelvertaling | Aanmaken |
| `tests/Feature/DonationFormTest.php` | Feature-tests op validatie, mails en formulier | Aanmaken |

De taken staan in afhankelijkheidsvolgorde: validatie → DTO → mails → formulier. Elke taak eindigt groen en is los reviewbaar.

---

### Task 1: Validatieregel voor `payment-method`

**Files:**
- Create: `tests/Feature/DonationFormTest.php`
- Modify: `app/Http/Requests/Api/DonationFormRequest.php:20-35` (de `rules()`-array)

**Interfaces:**
- Consumes: bestaande route `api.donate` (`POST /api/donate`, zie `routes/api.php`).
- Produces: `DonationFormTest::validPayload(array $overrides = []): array` — helper die latere taken hergebruiken voor een geldige inzending. De payload bevat de sleutel `payment-method`.

> **Achtergrond voor de uitvoerder:** de controller krijgt `App\Models\WebsiteSetting` via constructor-injectie. Die settings komen uit de database (Spatie settings), dus de test heeft `RefreshDatabase` nodig — ook voor tests die alleen validatiefouten controleren. `Mail::fake()` voorkomt dat er echt gemaild wordt.

- [ ] **Step 1: Schrijf de falende test**

Maak `tests/Feature/DonationFormTest.php` aan met exact deze inhoud:

```php
<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class DonationFormTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_requires_a_payment_method(): void
    {
        Mail::fake();

        $response = $this->postJson(
            route('api.donate'),
            $this->validPayload(['payment-method' => null]),
        );

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('payment-method');
    }

    #[Test]
    public function it_rejects_an_unknown_payment_method(): void
    {
        Mail::fake();

        $response = $this->postJson(
            route('api.donate'),
            $this->validPayload(['payment-method' => 'cash']),
        );

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('payment-method');
    }

    #[Test]
    public function it_accepts_both_known_payment_methods(): void
    {
        Mail::fake();

        foreach (['direct-debit', 'transfer'] as $method) {
            $response = $this->postJson(
                route('api.donate'),
                $this->validPayload(['payment-method' => $method]),
            );

            $response->assertStatus(200);
        }
    }

    /**
     * @param  array<string, mixed>  $overrides
     * @return array<string, mixed>
     */
    protected function validPayload(array $overrides = []): array
    {
        return array_merge([
            'type' => 'child',
            'amount' => '20',
            'frequency' => 'monthly',
            'payment-method' => 'direct-debit',
            'firstname' => 'Sanne',
            'surname' => 'de Vries',
            'email' => 'sanne@example.com',
            'phone' => '0612345678',
            'account-holder' => 'S. de Vries',
            'iban' => 'NL91ABNA0417164300',
            'privacy' => '1',
        ], $overrides);
    }
}
```

- [ ] **Step 2: Draai de test en controleer dat hij faalt**

Run: `php artisan test --filter=DonationFormTest`

Expected: `it_requires_a_payment_method` en `it_rejects_an_unknown_payment_method` FALEN met status 200 in plaats van 422 (het veld wordt nog niet gevalideerd). `it_accepts_both_known_payment_methods` slaagt al.

- [ ] **Step 3: Voeg de validatieregel toe**

In `app/Http/Requests/Api/DonationFormRequest.php`, voeg in `rules()` één regel toe direct ná de `frequency`-regel:

```php
            'frequency' => ['required', 'string', 'in:monthly,yearly,single'],
            'payment-method' => ['required', 'string', 'in:direct-debit,transfer'],
```

- [ ] **Step 4: Draai de test en controleer dat hij slaagt**

Run: `php artisan test --filter=DonationFormTest`

Expected: 3 tests PASS.

- [ ] **Step 5: Codestijl en commit**

```bash
vendor/bin/pint app/Http/Requests/Api/DonationFormRequest.php tests/Feature/DonationFormTest.php
git add app/Http/Requests/Api/DonationFormRequest.php tests/Feature/DonationFormTest.php
git commit -m ":sparkles: Validate payment method on the donation form"
```

---

### Task 2: `paymentMethod` op de DonationData DTO

**Files:**
- Create: `tests/Unit/Domains/Donation/DonationDataTest.php`
- Modify: `app/Domains/Donation/Data/DonationData.php:10-71`

**Interfaces:**
- Consumes: het gevalideerde veld `payment-method` uit Task 1.
- Produces: `DonationData::$paymentMethod` (`public string`, readonly via de `readonly class`), met waarde `'Automatische incasso'` of `'Zelf overmaken'`. Task 3 leest deze property in de mailtemplates.
- Nieuwe constructorparameter: `string $paymentMethod`, gepositioneerd direct ná `$frequency`. `fromRequest()` vult hem met de benoemde parameter `paymentMethod:`.

> **Achtergrond voor de uitvoerder:** `DonationData` is een `readonly class`. `type` en `frequency` zijn géén promoted properties: ze worden apart gedeclareerd en in de constructor via een `match` naar een Nederlands label omgezet. `paymentMethod` volgt exact datzelfde patroon. Alle aanroepen gebruiken benoemde argumenten, dus de positie van de parameter breekt niets.

- [ ] **Step 1: Schrijf de falende test**

Maak `tests/Unit/Domains/Donation/DonationDataTest.php` aan:

```php
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
```

- [ ] **Step 2: Draai de test en controleer dat hij faalt**

Run: `php artisan test --filter=DonationDataTest`

Expected: FAIL met `Unknown named parameter $paymentMethod`.

- [ ] **Step 3: Voeg de property toe**

In `app/Domains/Donation/Data/DonationData.php`:

Declareer de property onder `public string $frequency;`:

```php
    public string $frequency;

    public string $paymentMethod;
```

Voeg de constructorparameter toe direct ná `string $frequency,`:

```php
        string $frequency,
        string $paymentMethod,
```

Voeg de `match` toe direct ná de bestaande `$this->frequency = match (...)`-blok, binnen de constructor:

```php
        $this->paymentMethod = match ($paymentMethod) {
            'direct-debit' => 'Automatische incasso',
            'transfer' => 'Zelf overmaken',
        };
```

Vul in `fromRequest()` de nieuwe parameter, direct ná de `frequency:`-regel:

```php
            frequency: $request->validated('frequency'),
            paymentMethod: $request->validated('payment-method'),
```

- [ ] **Step 4: Draai de tests en controleer dat ze slagen**

Run: `php artisan test --filter="DonationDataTest|DonationFormTest"`

Expected: 5 tests PASS. (De feature-tests uit Task 1 blijven groen: `fromRequest()` krijgt nu een gevalideerde waarde mee.)

- [ ] **Step 5: Codestijl en commit**

```bash
vendor/bin/pint app/Domains/Donation/Data/DonationData.php tests/Unit/Domains/Donation/DonationDataTest.php
git add app/Domains/Donation/Data/DonationData.php tests/Unit/Domains/Donation/DonationDataTest.php
git commit -m ":sparkles: Add payment method to the donation data object"
```

---

### Task 3: Betaalwijze in beide mailtemplates

**Files:**
- Modify: `resources/views/mail/donation-request-mail.blade.php:13-28` (de tabel)
- Modify: `resources/views/mail/donation-request-confirmation.blade.php:16-31` (de tabel)
- Modify: `tests/Feature/DonationFormTest.php` (test toevoegen)

**Interfaces:**
- Consumes: `DonationData::$paymentMethod` uit Task 2 en `validPayload()` uit Task 1.
- Produces: niets voor latere taken.

> **Achtergrond voor de uitvoerder:** beide mailables (`DonationRequestMail`, `DonationRequestConfirmationMail`) geven de DTO door als `$data` aan een markdown-template. `Mailable::assertSeeInHtml()` rendert de mail en controleert de inhoud; roep het aan binnen de closure van `Mail::assertSent()` en geef daarna `true` terug, anders telt de assertie niet als match.

- [ ] **Step 1: Schrijf de falende test**

Voeg in `tests/Feature/DonationFormTest.php` deze imports toe bij de bestaande `use`-regels:

```php
use App\Domains\Donation\Mail\DonationRequestConfirmationMail;
use App\Domains\Donation\Mail\DonationRequestMail;
```

Voeg deze test toe ná `it_accepts_both_known_payment_methods()`:

```php
    #[Test]
    public function it_mentions_the_payment_method_in_both_mails(): void
    {
        Mail::fake();

        $response = $this->postJson(
            route('api.donate'),
            $this->validPayload(['payment-method' => 'transfer']),
        );

        $response->assertStatus(200);

        Mail::assertSent(DonationRequestMail::class, function (DonationRequestMail $mail): bool {
            $mail->assertSeeInHtml('Betaalwijze');
            $mail->assertSeeInHtml('Zelf overmaken');

            return true;
        });

        Mail::assertSent(DonationRequestConfirmationMail::class, function (DonationRequestConfirmationMail $mail): bool {
            $mail->assertSeeInHtml('Betaalwijze');
            $mail->assertSeeInHtml('Zelf overmaken');

            return true;
        });
    }
```

- [ ] **Step 2: Draai de test en controleer dat hij faalt**

Run: `php artisan test --filter=it_mentions_the_payment_method_in_both_mails`

Expected: FAIL — de gerenderde mail bevat "Betaalwijze" niet.

- [ ] **Step 3: Voeg de tabelrij toe aan beide templates**

In `resources/views/mail/donation-request-mail.blade.php`, voeg één rij toe direct ná de `Frequentie`-rij:

```
| Frequentie           | {{ $data->frequency }}                            |
| Betaalwijze          | {{ $data->paymentMethod }}                        |
```

Doe exact hetzelfde in `resources/views/mail/donation-request-confirmation.blade.php`, ook direct ná de `Frequentie`-rij:

```
| Frequentie           | {{ $data->frequency }}                            |
| Betaalwijze          | {{ $data->paymentMethod }}                        |
```

- [ ] **Step 4: Draai de tests en controleer dat ze slagen**

Run: `php artisan test --filter="DonationDataTest|DonationFormTest"`

Expected: 6 tests PASS.

- [ ] **Step 5: Commit**

```bash
git add resources/views/mail/donation-request-mail.blade.php resources/views/mail/donation-request-confirmation.blade.php tests/Feature/DonationFormTest.php
git commit -m ":sparkles: Show the payment method in the donation mails"
```

---

### Task 4: Betaalwijze-veld in het formulier

**Files:**
- Modify: `resources/views/components/columns/donation-form.blade.php:258-295` (direct ná het "Frequentie"-fieldset, binnen sectie 01)
- Modify: `tests/Feature/DonationFormTest.php` (test toevoegen)

**Interfaces:**
- Consumes: de validatieregel uit Task 1 (veldnaam en toegestane waarden).
- Produces: niets voor latere taken.

> **Achtergrond voor de uitvoerder:** het formulier is één groot Blade-component, aangeroepen als `<x-columns.donation-form />`. Er is een view composer op `components.columns.donation-form` die `$bankLink` injecteert en daarvoor de database raakt — de render-test heeft dus `RefreshDatabase` nodig (dat staat al op de testklasse).
>
> De wisselende toelichting werkt zonder JavaScript: het fieldset krijgt de class `group`, beide toelichtingen staan standaard op `hidden` en worden zichtbaar via `group-has-[#payment-direct-debit:checked]:block` respectievelijk `group-has-[#payment-transfer:checked]:block`. Tailwind 4 genereert deze varianten zolang de class letterlijk in het Blade-bestand staat — schrijf ze dus niet dynamisch op.

- [ ] **Step 1: Schrijf de falende test**

Voeg in `tests/Feature/DonationFormTest.php` deze test toe ná `it_mentions_the_payment_method_in_both_mails()`:

```php
    #[Test]
    public function it_renders_the_payment_method_question_with_direct_debit_preselected(): void
    {
        $html = (string) $this->blade('<x-columns.donation-form />');

        self::assertStringContainsString('Betaalwijze', $html);
        self::assertStringContainsString('Hoe wil je de betaling regelen?', $html);
        self::assertStringContainsString('name="payment-method"', $html);
        self::assertStringContainsString('Automatische incasso', $html);
        self::assertStringContainsString('Zelf overmaken', $html);

        self::assertMatchesRegularExpression(
            '/id="payment-direct-debit"[^>]*checked/',
            $html,
            'De automatische incasso hoort voorgeselecteerd te zijn.',
        );

        self::assertDoesNotMatchRegularExpression(
            '/id="payment-transfer"[^>]*checked/',
            $html,
            'Zelf overmaken hoort niet voorgeselecteerd te zijn.',
        );
    }
```

- [ ] **Step 2: Draai de test en controleer dat hij faalt**

Run: `php artisan test --filter=it_renders_the_payment_method_question_with_direct_debit_preselected`

Expected: FAIL op `assertStringContainsString('Betaalwijze', $html)` — het veld bestaat nog niet.

- [ ] **Step 3: Voeg het fieldset toe**

In `resources/views/components/columns/donation-form.blade.php`, direct ná het afsluitende `</fieldset>` van het "Frequentie"-blok en vóór het afsluitende `</section>` van sectie 01, voeg toe:

```blade
            {{-- Betaalwijze --}}
            <fieldset class="donation-field group">
                <legend class="contact-form__label
                               block mb-1
                               text-[12px] md:text-[13px] font-medium
                               text-secondary-900">
                    Betaalwijze
                    <span class="text-primary-500" aria-hidden="true">*</span>
                    <span class="sr-only">(verplicht)</span>
                </legend>
                <p class="text-[12px] text-secondary-900/60 mb-3">
                    Hoe wil je de betaling regelen?
                </p>

                <div class="donation-pills flex flex-wrap gap-2">
                    @foreach (['direct-debit' => 'Automatische incasso', 'transfer' => 'Zelf overmaken'] as $value => $label)
                        <label class="donation-pill cursor-pointer">
                            <input type="radio" name="payment-method" id="payment-{{ $value }}" value="{{ $value }}" required
                                   @if ($value === 'direct-debit') checked @endif
                                   class="peer sr-only" />
                            <span class="donation-pill__face
                                         inline-flex items-center justify-center
                                         px-5 py-2.5 rounded-full
                                         text-[13px] font-semibold tracking-[0.02em]
                                         bg-white text-secondary-900
                                         ring-1 ring-secondary-900/12
                                         transition-[background-color,color,box-shadow,ring-color,transform] duration-300 ease-out
                                         hover:ring-secondary-900/25
                                         peer-checked:bg-primary-500 peer-checked:text-white peer-checked:ring-primary-500
                                         peer-checked:shadow-[0_10px_22px_-10px_rgba(228,35,19,0.55)]
                                         peer-focus-visible:ring-2 peer-focus-visible:ring-primary-500/50">
                                {{ $label }}
                            </span>
                        </label>
                    @endforeach
                </div>

                <p class="hidden group-has-[#payment-direct-debit:checked]:block
                          mt-2.5 text-[11px] text-secondary-900/55">
                    Ik zou graag gebruik willen maken van een automatische incasso.
                </p>

                <p class="hidden group-has-[#payment-transfer:checked]:block
                          mt-2.5 text-[11px] text-secondary-900/55">
                    Ik wil het bedrag graag zelf overmaken.
                </p>
            </fieldset>
```

- [ ] **Step 4: Draai de volledige suite en controleer dat alles slaagt**

Run: `php artisan test`

Expected: alle tests PASS (7 nieuwe tests plus de bestaande `LandingPageTest`).

- [ ] **Step 5: Bouw de assets en controleer de CSS-varianten**

Run: `npm run build`

Expected: build slaagt. Controleer daarna dat Tailwind de nieuwe varianten heeft gegenereerd:

Run: `grep -c "payment-direct-debit" public/build/assets/*.css`

Expected: minimaal 1 treffer. Nul treffers betekent dat Tailwind de class niet heeft opgepikt — controleer dan of de class letterlijk (niet dynamisch samengesteld) in het Blade-bestand staat.

- [ ] **Step 6: Commit**

```bash
git add resources/views/components/columns/donation-form.blade.php tests/Feature/DonationFormTest.php
git commit -m ":sparkles: Add payment method question to the donation form"
```

---

## Handmatige controle na afloop

De geautomatiseerde tests dekken validatie, de labelvertaling, de mailinhoud en de gerenderde HTML. Twee dingen zijn alleen visueel te beoordelen:

1. Open de donatiepagina via Laravel Herd (`https://mozkids-website.test`, of de host die Herd voor dit project toont) en controleer dat de pills in dezelfde stijl staan als "Frequentie" en dat de toelichting meewisselt bij het klikken.
2. Verstuur een testdonatie op een lokale omgeving met `MAIL_MAILER=log` en controleer in `storage/logs/laravel.log` dat de rij "Betaalwijze" in beide mails staat.
