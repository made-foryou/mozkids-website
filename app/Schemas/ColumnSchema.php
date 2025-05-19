<?php

declare(strict_types=1);

namespace App\Schemas;

use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Made\Cms\Information\Data\Account;
use Made\Cms\Information\Data\Address;
use Made\Cms\Information\Data\Contact;
use Made\Cms\Information\Models\ContactInformationSettings;

class ColumnSchema 
{
    protected static ContactInformationSettings $contactSettings;

    public static function schema(): array
    {
        return [
            Select::make('type')
                ->label("Inhoudstype")
                ->live()
                ->options([
                    'text' => 'Tekst',
                    'image' => 'Afbeelding',
                    // 'movie' => 'Video', @todo
                    'agenda' => 'Activiteiten agenda',
                    'news' => 'Laatste nieuws',
                    'newsletter' => 'Nieuwsbrief',
                    'donation-form' => 'Donatie formulier',
                    'contact' => 'Contactgegevens',
                    'bank' => 'Financiële gegevens'
                ]),

            // text
            ...self::text(),

            // image
            ...self::image(),

            // Contactgegevens
            ...self::contact(),

            // Financiële gegevens
            ...self::bank(),
            
            // All
            Repeater::make('buttons')
                ->schema(ButtonSchema::schema())
                ->addActionLabel('Button toevoegen')
                ->live()
                ->hidden(fn (Get $get): bool => $get('type') === 'donation-form')
                ->defaultItems(0),
        ];
    }

    public static function text(): array
    {
        return [
            TextInput::make('subtitle')
                ->label("Subtitel")
                ->hidden(fn (Get $get): bool => $get('type') !== 'text'),

            RichEditor::make('content')
                ->label('Inhoud')
                ->hidden(fn (Get $get): bool => $get('type') !== 'text'),
        ];
    }

    public static function image(): array
    {
        return [
            FileUpload::make('image')
                ->image()
                ->label('Afbeelding')
                ->imageEditor()
                ->imageEditorAspectRatios([
                    '134:125',
                ])
                ->preserveFilenames()
                ->hidden(fn (Get $get): bool => $get('type') !== 'image'),

            TextInput::make('alt')
                ->label('Afbeelding alt tekst')
                ->hidden(fn (Get $get): bool => $get('type') !== 'image'),
        ];
    }

    public static function contact(): array
    {
        $settings = app()->make(ContactInformationSettings::class);

        $addresses = collect($settings->addresses)->mapWithKeys(
            fn ($value) => [$value['key'] => $value['key']],
        );

        $contacts = collect($settings->contacts)->mapWithKeys(
            fn ($value) => [$value['key'] => $value['key']],
        );

        $socials = collect($settings->accounts)->filter(
            fn ($value) => !empty($value['url']),
        )
            ->mapWithKeys(fn ($value) => [$value['key'] => $value['label']]);

        return [
            Select::make('address')
                ->label('Adresgegevens')
                ->options($addresses->toArray())
                ->hidden(fn (Get $get): bool => $get('type') !== 'contact'),

            Select::make('contact')
                ->label('Contactgegevens')
                ->options($contacts->toArray())
                ->hidden(fn (Get $get): bool => $get('type') !== 'contact'),

            CheckboxList::make('social')
                ->label('Social media accounts')
                ->helperText('Deze accounts worden getoond onder het "Volg ons" gedeelte')
                ->options($socials->toArray())
                ->hidden(fn (Get $get): bool => $get('type') !== 'contact'),
        ];
    }

    public static function bank(): array
    {
        $settings = app()->make(ContactInformationSettings::class);

        $accounts = collect($settings->accounts)->filter(
            fn ($value) => empty($value['url']),
        )
            ->mapWithKeys(fn ($value) => [$value['key'] => $value['label']]);

        return [
            CheckboxList::make('accounts')
                ->label('Bank gegevens')
                ->helperText('Deze accounts worden getoond in het financiële gegevens blok')
                ->options($accounts->toArray())
                ->hidden(fn (Get $get): bool => $get('type') !== 'bank'),
        ];
    }

    public static function resolveViewAttributes(array $attributes): array
    {
        if (isset($attributes['address']) && !empty($attributes['address'])) {
            $attributes['address'] = self::resolveAddress($attributes['address']);
        }

        if (isset($attributes['contact']) && !empty($attributes['contact'])) {
            $attributes['contact'] = self::resolveContact($attributes['contact']);
        }

        if (isset($attributes['social']) && !empty($attributes['social'])) {
            $attributes['social'] = self::resolveAccounts($attributes['social']);
        }

        if (isset($attributes['accounts']) && !empty($attributes['accounts'])) {
            $attributes['accounts'] = self::resolveAccounts($attributes['accounts']);
        }

        return $attributes;
    }

    public static function resolveAddress(string $value): Address
    {
        return self::getContactSettings()->getAddress($value);
    }

    public static function resolveContact(string $value): Contact
    {
        return self::getContactSettings()->getContact($value);
    }

    /**
     * @return array<Account>
     */
    public static function resolveAccounts(array $values): array
    {
        return array_map(
            fn (string $value): Account => self::getContactSettings()->getAccount($value),
            $values,
        );
    }

    protected static function getContactSettings(): ContactInformationSettings
    {
        if (!isset(self::$contactSettings)) {
            self::$contactSettings = app()->make(ContactInformationSettings::class);
        }

        return self::$contactSettings;
    }
}
