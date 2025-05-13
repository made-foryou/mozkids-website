<x-mail::message>
# Nieuwe donatie aanvraag

Er is een nieuwe donatie aanvraag ingevuld via de website van Moz Kids. Hieronder vind je de 
gegevens die de aanvrager heeft ingevuld.

## Gegevens

<x-mail::table>
| Veld                 | Invulling                                         |
| -------------------- | ------------------------------------------------: |
| Type sponsoring      | {{ $data->type }}                                 |
| Bedrag               | € {{ number_format($data->amount, 2, '.', ',') }} |
| Voornaam             | {{ $data->firstname }}                            | 
| Tussenvoegsel(s)     | {{ $data->infix }}                                | 
| Achternaam           | {{ $data->surname }}                              |
| E-mailadres          | {{ $data->email }}                                |
| Telefoonnnummer      | {{ $data->phone }}                                |
| Nieuwsbrief?         | {{ $data->newsletter ? 'Ja' : 'Nee' }}            |
| Privacyverklaring?   | {{ $data->privacy ? 'Ja' : 'Nee' }}               |
</x-mail::table>

Een vriendelijke groet,<br>
Het team van {{ config('app.name') }}
</x-mail::message>
