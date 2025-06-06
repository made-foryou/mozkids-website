<?php

namespace App\Filament\Resources;

use App\Filament\Resources\YearReportResource\Pages;
use App\Filament\Resources\YearReportResource\RelationManagers;
use App\Models\YearReport;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class YearReportResource extends Resource
{
    protected static ?string $model = YearReport::class;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Group::make()->schema([
                Forms\Components\Section::make()->schema([
                    Forms\Components\DatePicker::make("year")
                        ->format("Y")
                        ->native(false)
                        ->displayFormat("Y")
                        ->required(),

                    Forms\Components\TextInput::make("title")
                        ->required()
                        ->maxLength(255),

                    Forms\Components\Textarea::make(
                        "description"
                    )->columnSpanFull(),

                    Forms\Components\FileUpload::make("file")
                        ->label("Bestand")
                        ->required(),
                ]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make("year"),
                Tables\Columns\TextColumn::make("title")->searchable(),
                Tables\Columns\TextColumn::make("file")->searchable(),
                Tables\Columns\TextColumn::make("created_at")
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make("updated_at")
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make("deleted_at")
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([Tables\Filters\TrashedFilter::make()])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
                //
            ];
    }

    public static function getPages(): array
    {
        return [
            "index" => Pages\ListYearReports::route("/"),
            "create" => Pages\CreateYearReport::route("/create"),
            "view" => Pages\ViewYearReport::route("/{record}"),
            "edit" => Pages\EditYearReport::route("/{record}/edit"),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->withoutGlobalScopes([
            SoftDeletingScope::class,
        ]);
    }

    /**
     * Retrieves the navigation label for the resource.
     *
     * @return string The navigation label.
     */
    public static function getNavigationLabel(): string
    {
        return "Jaarverslagen";
    }

    /**
     * Retrieves the plural label for the resource.
     *
     * @return string|null The plural label if defined, or null otherwise.
     */
    public static function getPluralLabel(): ?string
    {
        return "Jaarverslagen";
    }

    /**
     * Retrieves the model label for the resource.
     *
     * @return string The model label.
     */
    public static function getModelLabel(): string
    {
        return "Jaarverslag";
    }

    /**
     * Retrieves the navigation group for the resource.
     *
     * @return string|null The navigation group if defined, or null otherwise.
     */
    public static function getNavigationGroup(): ?string
    {
        return "Organisatie";
    }

    /**
     * Retrieves the navigation badge count for published posts.
     *
     * @return string|null The count of published posts as a string, or null if unavailable.
     */
    public static function getNavigationBadge(): ?string
    {
        return (string) YearReport::query()->count();
    }
}
