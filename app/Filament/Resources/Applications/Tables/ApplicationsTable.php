<?php

namespace App\Filament\Resources\Applications\Tables;

use App\Filament\Exports\ApplicationExporter;
use Filament\Actions\Action;
use Filament\Actions\ExportAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;

class ApplicationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->headerActions([
                ExportAction::make()
                    ->exporter(ApplicationExporter::class),
            ])
            ->columns([
                TextColumn::make('name')
                    ->label('الاسم')
                    ->searchable(
                        query: fn ($query, string $search): \Illuminate\Database\Eloquent\Builder =>
                        $query->where('applications.name', 'like', "%{$search}%")
                    ),

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
                    ->label('الوظيفة')
                    ->searchable(),

                TextColumn::make('score')
                    ->label('النتيجة')
                    ->sortable(query: function ($query, string $direction) {
                        return $query->orderByRaw(
                            '(applications.bac_average * contests.bac_factor
                + applications.grad_average * contests.grad_factor) '.$direction
                        );
                    })
                    ->numeric(locale: 'en_US'),
                TextColumn::make('test_grade')
                    ->placeholder('لم يجتز الاختبار')
                    ->label('نتيجة الاختبار')
                    ->sortable(),
                TextColumn::make('final')
                    ->state(fn ($record) => $record->test_grade ? ($record->score + $record->test_grade) / 2 : null)
                    ->placeholder('لم يجتز الاختبار')
                    ->label('النتيجة النهائية')
                    ->sortable(),

            ])
            ->filters([
                //
            ])
            ->groups([
                Group::make('position')->label('الوظيفة'),
            ])
            ->recordActions([
                Action::make('passer')
                    ->label('قبول اولي')
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        $record->status = 'مقبول';

                        $record->save();
                    })
                    ->visible(fn ($record) => $record->status === 'جديد'),
                Action::make('revert')
                    ->label('إلغاء القبول')
                    ->color('danger')
                    ->icon('heroicon-o-arrow-uturn-left')
                    ->action(function ($record) {
                        $record->test_grade = null;
                        $record->status = 'جديد';
                        $record->save();
                    })
                    ->visible(fn ($record) => $record->status === 'مقبول'),

                Action::make('note_test')
                    ->label('تقييم الاختبار')
                    ->schema([
                        TextInput::make('test_grade')
                            ->label('درجة الاختبار')
                            ->numeric()
                            ->maxValue(20)
                            ->minValue(0)
                            ->required(),
                    ])
                    ->action(function ($record, $data) {
                        $record->test_grade = $data['test_grade'];
                        $record->save();
                    })
                    ->visible(fn ($record) => $record->status === 'مقبول'),

                ViewAction::make()
                    ->label('عرض'),
            ])
            ->toolbarActions([
            ]);
    }
}
