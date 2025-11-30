<?php

namespace App\Filament\Resources\Contests\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ContestForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('bac_factor')
                    ->maxValue(100)
                    ->minValue(0)
                    ->required(),
                TextInput::make('grad_factor')
                    ->maxValue(100)
                    ->minValue(0)
                    ->required(),
                DateTimePicker::make('ends_at')
                    ->required(),
            ]);
    }
}
