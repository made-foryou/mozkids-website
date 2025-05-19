<?php

declare(strict_types=1);

namespace App\Domains\Agenda\Filament\Resources\Pages;

use App\Domains\Agenda\Filament\Resources\AgendaItemResource;
use App\Domains\Agenda\Models\AgendaItem;
use Filament\Actions\CreateAction;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Made\Cms\Shared\Enums\PublishingStatus;

class ListAgendaItems extends ListRecords
{
    protected static string $resource = AgendaItemResource::class;

    public static ?string $title = 'Overzicht';

    public static ?string $breadcrumb = 'Overzicht';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        $tabs = [
            null => Tab::make(__('made-cms::common.all'))
                ->badge(AgendaItem::query()->count()),
        ];

        collect(PublishingStatus::cases())->each(function (PublishingStatus $status) use (&$tabs) {
            $tabs[$status->value] = Tab::make($status->label())
                ->modifyQueryUsing(fn ($query) => $query->where('status', $status->value))
                ->badge(
                    AgendaItem::query()
                        ->where('status', $status->value)
                        ->count()
                );
        });

        if (count($tabs) <= 1) {
            return [];
        }

        return $tabs;
    }
}
