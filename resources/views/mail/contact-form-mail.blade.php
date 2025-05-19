<x-mail::message>
# Contactformulier

Het contactformulier is ingevuld en verzonden van de Moz Kids website. 

## Bericht:

{{ $data->message }}

## Ingevuld door:

<x-mail::table>
| Veld                 | Invulling                                         |
| :------------------- | ------------------------------------------------: |
| Naam                 | {{ $data->name }}                                 |
| E-mailadres          | {{ $data->email }}                                |
| Telefoonnummer       | {{ $data->phone }}                                |
| Onderwerp            | {{ $data->subject }}                              | 
| Privacyverklaring?   | {{ $data->privacy ? 'Ja' : 'Nee' }}               |
</x-mail::table>

<br /><br />
Een vriendelijke groet,<br>
Het team van {{ config('app.name') }}
</x-mail::message>
