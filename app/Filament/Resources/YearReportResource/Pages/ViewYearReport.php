<?php

namespace App\Filament\Resources\YearReportResource\Pages;

use App\Filament\Resources\YearReportResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewYearReport extends ViewRecord
{
    protected static string $resource = YearReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
