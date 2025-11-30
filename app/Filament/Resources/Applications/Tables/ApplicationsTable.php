<?php

namespace App\Filament\Resources\Applications\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ApplicationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('contest.name')
                    ->searchable(),
                TextColumn::make('position')
                    ->searchable(),
                TextColumn::make("score")->sortable(),
                TextColumn::make('gender')
                    ->searchable(),
                TextColumn::make('birth_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('birth_place')
                    ->searchable(),
                TextColumn::make('address')
                    ->searchable(),
                TextColumn::make('governorate')
                    ->searchable(),
                TextColumn::make('postal_code')
                    ->sortable(),
                TextColumn::make('cin')
                    ->sortable(),
                TextColumn::make('cin_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('social_security_type')
                    ->searchable(),
                TextColumn::make('cnss_number')
                    ->sortable(),
                TextColumn::make('tel')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('marital_status')
                    ->searchable(),
                TextColumn::make('military_status')
                    ->searchable(),
                TextColumn::make('spouse_name')
                    ->searchable(),
                TextColumn::make('spouse_profession')
                    ->searchable(),
                TextColumn::make('spouse_workplace')
                    ->searchable(),
                TextColumn::make('children_count')
                    ->sortable(),
                TextColumn::make('degree')
                    ->searchable(),
                TextColumn::make('specialty')
                    ->searchable(),
                TextColumn::make('graduation_year')
                    ->sortable(),
                TextColumn::make('equivalence_decision')
                    ->searchable(),
                TextColumn::make('equivalence_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('bac_average')
                    ->sortable(),
                TextColumn::make('bac_specialty')
                    ->searchable(),
                TextColumn::make('bac_year')
                    ->sortable(),
                TextColumn::make('grad_average')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make()
            ])
            ->toolbarActions([
            ]);
    }
}
