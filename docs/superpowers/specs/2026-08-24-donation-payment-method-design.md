# Ontwerp: betaalwijze-vraag in het donatieformulier

**Datum:** 2026-08-24
**Branch:** `feature/add-field`

## Doel

Het donatieformulier krijgt onder de vraag "Frequentie" een extra verplichte vraag waarmee de
donateur kiest hoe de betaling geregeld wordt: zelf overmaken of automatische incasso. Het
antwoord komt terecht in beide mails die na het insturen worden verstuurd (de notificatie naar
Moz Kids en de bevestiging naar de donateur).

## Besluiten (afgestemd met Menno)

- De bestaande hulptekst "Hoe zou je willen sponsoren?" bij de vraag *Sponsoren* blijft
  ongewijzigd. De nieuwe vraag krijgt een eigen formulering: legend **"Betaalwijze"** met
  hulptekst **"Hoe wil je de betaling regelen?"**.
- **Automatische incasso is voorgeselecteerd**, consistent met de andere radiovragen in het
  formulier.
- Weergave als **korte pills** ("Automatische incasso" / "Zelf overmaken") in de bestaande
  pill-stijl, met daaronder een toelichting die meewisselt met de gekozen optie en de volledige
  zin toont.

## Wijzigingen per bestand

### 1. Formulier — `resources/views/components/columns/donation-form.blade.php`

Nieuw fieldset direct onder het "Frequentie"-fieldset, binnen sectie 01:

- Veldnaam `payment-method`, radio-opties:
  - `direct-debit` → pill "Automatische incasso" (checked)
  - `transfer` → pill "Zelf overmaken"
- Markup en classes identiek aan het bestaande pill-patroon (zie het Frequentie-fieldset).
- Onder de pills twee toelichtingsregels waarvan er precies één zichtbaar is, gestuurd door de
  gekozen optie. Beide regels staan standaard op `hidden` en worden getoond met Tailwind 4's
  `has-*`-variant op de omhullende container, gekoppeld aan het id van de bijbehorende radio:
  `has-[#payment-direct-debit:checked]:block` respectievelijk
  `has-[#payment-transfer:checked]:block`. Geen JavaScript nodig.
  - `direct-debit` (id `payment-direct-debit`): "Ik zou graag gebruik willen maken van een
    automatische incasso."
  - `transfer` (id `payment-transfer`): "Ik wil het bedrag graag zelf overmaken."

### 2. Validatie — `app/Http/Requests/Api/DonationFormRequest.php`

Nieuwe regel, gepositioneerd na `frequency`:

```php
'payment-method' => ['required', 'string', 'in:direct-debit,transfer'],
```

### 3. DTO — `app/Domains/Donation/Data/DonationData.php`

- Nieuwe public property `paymentMethod`, gevuld in de constructor via dezelfde `match`-stijl
  als `type` en `frequency`:
  - `'direct-debit'` → `'Automatische incasso'`
  - `'transfer'` → `'Zelf overmaken'`
- `fromRequest()` geeft `$request->validated('payment-method')` door.

De korte labels (niet de volledige zinnen) zijn de mailweergave; ze passen in de tabel en de
betekenis is gelijk.

### 4. Mails — beide templates

`resources/views/mail/donation-request-mail.blade.php` en
`resources/views/mail/donation-request-confirmation.blade.php` krijgen in de gegevens­tabel een
nieuwe rij direct onder "Frequentie":

```
| Betaalwijze          | {{ $data->paymentMethod }}                        |
```

### 5. Tests — `tests/Feature/DonationFormTest.php` (nieuw)

Er bestaat nog geen test voor `POST /api/donate`. Nieuwe feature-test die dekt:

- Een volledig geldige inzending slaagt en verstuurt beide mails (`Mail::fake()`).
- `payment-method` ontbreekt → 422 met validatiefout op dat veld.
- `payment-method` met een waarde buiten `direct-debit`/`transfer` → 422.
- De gekozen betaalwijze (het Nederlandse label) staat in de gerenderde inhoud van beide mails.

## Wat niet verandert

- Foutafhandeling: ontbrekende/ongeldige waarde geeft dezelfde 422-validatierespons als de
  overige velden; de bestaande frontend-afhandeling in `resources/js/modules/form.js` en
  `donation-form.js` hoeft niet aangepast te worden.
- De controller (`DonationFormHandleController`) verandert niet: die geeft de DTO al integraal
  door aan beide mailables.
- Geen database- of settingswijzigingen.
