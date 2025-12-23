<?php

namespace App\Filament\Resources\Applications\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Table;

class ApplicationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('الاسم')
                    ->searchable(),

                TextColumn::make('email')
                    ->label('البريد الإلكتروني')
                    ->searchable(),

                TextColumn::make('tel')
                    ->label('رقم الهاتف')
                    ->searchable(),

                TextColumn::make('status')
                    ->label('الحالة')
                    ->badge()
                    ->searchable(),

                TextColumn::make('position')
                    ->label('المنصب')
                    ->searchable(),

                TextColumn::make('score')
                    ->label('النتيجة')
                    ->sortable(),

                TextInputColumn::make('test_grade')
                    ->label('درجة الاختبار')
                    ->placeholder("لا يمكن تعديل إلا إذا تم اختيار للاختبار.")
                    ->rules(['max'])
                    ->disabled(fn ($record) => $record->status == "nouveau")
                    ->suffix("/20")
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                Action::make('passer')
                    ->label('اجتاز')
                    ->action(function ($record) {
                        $record->status = 'passe';
                        $record->save();
                    })
                    ->visible(fn ($record) => $record->status === 'nouveau'),

                Action::make('note_test')
                    ->label('تقييم الاختبار')
                    ->schema([
                        TextInput::make('test_grade')
                            ->label('درجة الاختبار')
                            ->required(),
                    ])
                    ->action(function ($record, $data) {
                        $record->test_grade = $data['test_grade'];
                        $record->save();
                    })
                    ->visible(fn ($record) => $record->status === 'passe'),

                ViewAction::make()
                    ->label('عرض'),
            ])
            ->toolbarActions([
            ]);
    }
}
