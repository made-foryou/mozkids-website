<?php

namespace App\Filament\Resources\YearReportResource\Pages;

use App\Filament\Resources\YearReportResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditYearReport extends EditRecord
{
    protected static string $resource = YearReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
