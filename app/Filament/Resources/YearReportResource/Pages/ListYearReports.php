<?php

namespace App\Filament\Resources\YearReportResource\Pages;

use App\Filament\Resources\YearReportResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListYearReports extends ListRecords
{
    protected static string $resource = YearReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
