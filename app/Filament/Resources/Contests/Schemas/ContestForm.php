<?php

namespace App\Filament\Resources\Contests\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ContestForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('الاسم')
                    ->required(),

                TextInput::make('bac_factor')
                    ->label('ضارب البكالوريا')
                    ->maxValue(100)
                    ->minValue(0)
                    ->required(),

                TextInput::make('grad_factor')
                    ->label('ضارب التخرج')
                    ->maxValue(100)
                    ->minValue(0)
                    ->required(),
                TagsInput::make('degrees')->label('الشهادات العلمية'),

                DateTimePicker::make('ends_at')
                    ->label('تاريخ ووقت غلق المسابقة')
                    ->required(),
            ]);
    }
}
