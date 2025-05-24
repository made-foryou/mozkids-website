<x-mail::message>
# Bedankt voor je donatie

Jouw donatie aanvraag is met succes naar ons verstuurd. Hieronder vind je een overzicht van jouw
ingevulde gegevens. Mocht je nog vragen en/of opmerkingen hebben dan kun je altijd even mailen
naar <a href="mailto:info@mozkids.nl">info@mozkids.nl</a>.

Voor de verwerking van jouw donatie zullen wij nog contact met je opnemen.

### Jouw opmerkingen:

{{ $data->comments ?? 'Geen opmerkingen ingevuld.' }}

### Jouw gegevens:

<x-mail::table>
| Veld                 | Invulling                                         |
| :------------------- | ------------------------------------------------: |
| Type sponsoring      | {{ $data->type->description() }}                  |
| Bedrag               | € {{ number_format($data->amount, 2, ',', ',') }} |
| Frequentie           | {{ $data->frequency->label() }}                   |
| Voornaam             | {{ $data->firstname }}                            |
| Tussenvoegsel(s)     | {{ $data->infix }}                                |
| Achternaam           | {{ $data->surname }}                              |
| E-mailadres          | {{ $data->email }}                                |
| Telefoonnnummer      | {{ $data->phone }}                                |
| Naam rekeninghouder  | {{ $data->accountHolder }}                        |
| Adres                | {{ $data->address }}                              |
| Postcode             | {{ $data->zipcode }}                              |
| Woonplaats           | {{ $data->city }}                                 |
| IBAN                 | {{ $data->iban }}                                 |
| Incasso machtiging   | {{ $data->authority ? 'Ja' : 'Nee' }}             |
| Nieuwsbrief?         | {{ $data->newsletter ? 'Ja' : 'Nee' }}            |
| Privacyverklaring?   | {{ $data->privacy ? 'Ja' : 'Nee' }}               |
</x-mail::table>

<br /><br />
Een vriendelijke groet,<br>
Het team van {{ config('app.name') }}
</x-mail::message>
