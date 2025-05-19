<?php

declare(strict_types=1);

namespace App\Domains\Agenda\Filament\Resources\Pages;

use App\Domains\Agenda\Filament\Resources\AgendaItemResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAgendaItem extends CreateRecord
{
    protected static string $resource = AgendaItemResource::class;
}
