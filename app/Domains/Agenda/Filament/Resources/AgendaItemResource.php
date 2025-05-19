<?php

declare(strict_types=1);

namespace App\Domains\Agenda\Filament\Resources;

use App\Domains\Agenda\Models\AgendaItem;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ForceDeleteBulkAction;
use Filament\Tables\Actions\RestoreBulkAction;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Made\Cms\Language\Models\Language;
use Made\Cms\Shared\Enums\PublishingStatus;
use Made\Cms\Shared\Filament\Actions\TranslateAction;

class AgendaItemResource extends Resource
{
    protected static ?string $model = AgendaItem::class;

    protected static ?string $slug = 'agenda-item';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                    ->schema([

                        Section::make()
                            ->schema([
                                TextInput::make('name')
                                    ->label('Naam')
                                    ->required(),

                                DatePicker::make('start_date')
                                    ->label('Startdatum')
                                    ->helperText('De datum waarop het evenment / het agendapunt plaats vind en/of start.')
                                    ->required()
                                    ->default(now()),

                                DatePicker::make('end_date')
                                    ->label('Einddatum')
                                    ->helperText('Tot wanneer het agendapunt loopt.')
                                    ->default(now()),

                                RichEditor::make('description')
                                    ->label('Inhoud'),

                                SpatieMediaLibraryFileUpload::make('image')
                                    ->collection('image')
                                    ->image()
                                    ->imageEditor(),
                            ]),

                        ])
                        ->columnSpan(['lg' => 2]),

                Group::make()
                    ->schema([

                        Section::make()
                            ->schema([

                                Select::make('status')
                                    ->label('Status')
                                    ->helperText(
                                        'Deze status van het agendapunt geeft aan waarvoor het 
                                        agendapunt gebruikt kan worden. Zodra de status is 
                                        ingesteld op gepubliceerd, kan elke bezoeker het 
                                        agendapunt bekijken.'
                                    )
                                    ->options(PublishingStatus::options())
                                    ->default(array_key_first(PublishingStatus::options())),

                                Select::make('language')
                                    ->relationship('language', 'name')
                                    ->preload()
                                    ->default(
                                        Language::query()
                                            ->default()
                                            ->first()
                                            ->id
                                    )
                                    ->label('Taal')
                                    ->helperText('De taal van de inhoud van het agendapunt.'),

                                Select::make('translated_from_id')
                                    ->label('Vertaling van')
                                    ->disabled()
                                    ->relationship('translatedFrom', 'name')
                                    ->helperText('Dit agendapunt is een vertaling van het hierboven geselecteerde agendapunt. Dit is niet te wijzigen.')
                                    ->visible(fn (Get $get) => $get('translated_from_id') !== null),

                            ]),

                    ]),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('image')
                    ->label('Afbeelding')
                    ->collection('image')
                    ->conversion('preview')
                    ->circular(),
                    
                TextColumn::make('start_date')
                    ->label('Start datum')
                    ->sortable()
                    ->date(),

                TextColumn::make('end_date')
                    ->label('Eind datum')
                    ->sortable()
                    ->date(),

                TextColumn::make('name')
                    ->label('Naam')
                    ->weight(FontWeight::Bold)
                    ->searchable()
                    ->sortable(),

                SpatieMediaLibraryImageColumn::make('language.flag')
                    ->collection('flag')
                    ->label('Taal')
                    ->size(20)
                    ->circular(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (PublishingStatus $state) => $state->color())
                    ->formatStateUsing(fn (PublishingStatus $state) => $state->label()),

                TextColumn::make('translatedFrom.name')
                    ->label('Vertaling van')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('createdBy.name')
                    ->label('Aangemaakt door'),

                TextColumn::make('updated_at')
                    ->label('Gewijzigd op')
                    ->since(),                
            ])
            ->heading('Agendapunten')
            ->filters([
                SelectFilter::make('language_id')
                    ->relationship('language', 'name')
                    ->label('Taal'),

                SelectFilter::make('translated_from_id')
                    ->options(AgendaItem::query()->get()->mapWithKeys(fn ($item) => [$item->id => $item->name]))
                    ->label('Vertaling van'),

                TrashedFilter::make(),
            ])
            ->actions([
                ActionGroup::make([
                    ActionGroup::make([
                        TranslateAction::make(),
                        EditAction::make(),
                    ])
                        ->dropdown(false),

                    DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                ]),
            ])
            ->defaultPaginationPageOption(50)
            ->defaultSort('start_date', 'desc');
    }

    /**
     * Returns an array of page routes for the resource.
     *
     * @return array An associative array where keys represent page types (e.g., 'index', 'create', 'edit')
     */
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAgendaItems::route('/'),
            'create' => Pages\CreateAgendaItem::route('/create'),
            'edit' => Pages\EditAgendaItem::route('/{record}/edit'),
        ];
    }

    /**
     * Retrieves the Eloquent query builder instance for the resource with specific global scopes removed.
     *
     * @return Builder The Eloquent query builder instance with modified scope behavior.
     */
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }/**
     * Retrieves the navigation label for the resource.
     *
     * @return string The navigation label.
     */
    public static function getNavigationLabel(): string
    {
        return 'Agenda punten';
    }

    /**
     * Retrieves the plural label for the resource.
     *
     * @return string|null The plural label if defined, or null otherwise.
     */
    public static function getPluralLabel(): ?string
    {
        return 'Agenda punten';
    }

    /**
     * Retrieves the model label for the resource.
     *
     * @return string The model label.
     */
    public static function getModelLabel(): string
    {
        return 'Agenda punt';
    }

    /**
     * Retrieves the navigation group for the resource.
     *
     * @return string|null The navigation group if defined, or null otherwise.
     */
    public static function getNavigationGroup(): ?string
    {
        return 'Agenda';
    }

    /**
     * Retrieves the navigation badge count for published posts.
     *
     * @return string|null The count of published posts as a string, or null if unavailable.
     */
    public static function getNavigationBadge(): ?string
    {
        return (string) AgendaItem::query()->published()->count();
    }
}
