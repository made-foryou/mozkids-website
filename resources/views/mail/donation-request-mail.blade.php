<x-mail::message>
# Nieuwe donatie aanvraag

Er is een nieuwe donatie aanvraag ingevuld via de website van Moz Kids. Hieronder vind je de
gegevens die de aanvrager heeft ingevuld.

### Opmerking(en)

{{ $data->comments ?? 'Geen opmerkingen ingevuld.' }}

### Gegevens

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
