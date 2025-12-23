<?php

namespace App\Filament\Resources\Applications\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
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
                TextColumn::make('email')
                    ->searchable(),
                TextColumn::make('tel')
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->searchable(),
                TextColumn::make('position')
                    ->searchable(),
                TextColumn::make("score")->sortable(),
                TextColumn::make("test_grade")->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                Action::make("Passer")->action(function ($record) {
                    $record->status = "passe";
                    $record->save();
                })->visible(fn ($record) => $record->status== "nouveau"),
                Action::make("Noté Test")
                    ->schema([
                        TextInput::make("test_grade")->required()
                    ])
                    ->action(function ($record, $data) {
                        $record->test_grade = $data['test_grade'];
                        $record->save();
                })->visible(fn ($record) => $record->status== "passe"),
                ViewAction::make()
            ])
            ->toolbarActions([
            ]);
    }
}
