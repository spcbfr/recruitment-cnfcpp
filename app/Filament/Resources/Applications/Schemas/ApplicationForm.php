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
                    ->label('المسابقة')
                    ->relationship('contest', 'name')
                    ->required(),

                TextInput::make('position')
                    ->label('المنصب')
                    ->required(),

                TextInput::make('name')
                    ->label('الاسم الكامل')
                    ->required(),

                TextInput::make('gender')
                    ->label('الجنس')
                    ->required(),

                DatePicker::make('birth_date')
                    ->label('تاريخ الميلاد')
                    ->required(),

                TextInput::make('address')
                    ->label('العنوان')
                    ->required(),

                TextInput::make('governorate')
                    ->label('الولاية')
                    ->required(),

                TextInput::make('postal_code')
                    ->label('الترقيم البريدي')
                    ->required()
                    ->numeric(),

                TextInput::make('cin')
                    ->label('رقم بطاقة التعريف الوطنية')
                    ->required()
                    ->numeric(),

                DatePicker::make('cin_date')
                    ->label('تاريخ إصدار بطاقة التعريف')
                    ->required(),

                TextInput::make('tel')
                    ->label('رقم الهاتف')
                    ->tel()
                    ->required(),

                TextInput::make('status')
                    ->label('الحالة'),

                TextInput::make('email')
                    ->label('البريد الإلكتروني')
                    ->email()
                    ->required(),

                TextInput::make('degree')
                    ->label('الشهادة'),

                TextInput::make('specialty')
                    ->label('الاختصاص')
                    ->required(),

                TextInput::make('graduation_year')
                    ->label('سنة التخرج')
                    ->required()
                    ->numeric(),

                TextInput::make('equivalence_decision')
                    ->label('قرار المعادلة')
                    ->required(),

                DatePicker::make('equivalence_date')
                    ->label('تاريخ المعادلة')
                    ->required(),

                TextInput::make('bac_average')
                    ->label('معدل البكالوريا')
                    ->required()
                    ->numeric(),

                TextInput::make('grad_average')
                    ->label('معدل التخرج')
                    ->required()
                    ->numeric(),
            ]);
    }
}
