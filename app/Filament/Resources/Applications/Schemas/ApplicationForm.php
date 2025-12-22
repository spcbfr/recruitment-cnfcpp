<?php

namespace App\Filament\Resources\Applications\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ApplicationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('contest_id')
                    ->relationship('contest', 'name')
                    ->required(),
                TextInput::make('position')
                    ->required(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('gender')
                    ->required(),
                DatePicker::make('birth_date')
                    ->required(),
                TextInput::make('address')
                    ->required(),
                TextInput::make('governorate')
                    ->required(),
                TextInput::make('postal_code')
                    ->required()
                    ->numeric(),
                TextInput::make('cin')
                    ->required()
                    ->numeric(),
                DatePicker::make('cin_date')
                    ->required(),
                TextInput::make('tel')
                    ->tel()
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('degree'),
                TextInput::make('specialty')
                    ->required(),
                TextInput::make('graduation_year')
                    ->required()
                    ->numeric(),
                TextInput::make('equivalence_decision')
                    ->required(),
                DatePicker::make('equivalence_date')
                    ->required(),
                TextInput::make('bac_average')
                    ->required()
                    ->numeric(),
                TextInput::make('bac_specialty')
                    ->required(),
                TextInput::make('bac_year')
                    ->required()
                    ->numeric(),
                TextInput::make('grad_average')
                    ->required()
                    ->numeric(),
            ]);
    }
}
