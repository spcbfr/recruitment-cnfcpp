<?php

namespace App\Filament\Exports;

use App\Models\Application;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class ApplicationExporter extends Exporter
{
    protected static ?string $model = Application::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('المعرف'),

            ExportColumn::make('contest.name')
                ->label('المسابقة'),

            ExportColumn::make('position')
                ->label('المنصب'),

            ExportColumn::make('name')
                ->label('الاسم الكامل'),

            ExportColumn::make('gender')
                ->label('الجنس'),

            ExportColumn::make('birth_date')
                ->label('تاريخ الميلاد'),

            ExportColumn::make('address')
                ->label('العنوان'),

            ExportColumn::make('governorate')
                ->label('الولاية'),

            ExportColumn::make('city')
                ->label('المعتمدية'),

            ExportColumn::make('postal_code')
                ->label('الترقيم البريدي'),

            ExportColumn::make('score')
                ->label('النتيجة'),

            ExportColumn::make('cin')
                ->label('رقم بطاقة التعريف'),

            ExportColumn::make('cin_date')
                ->label('تاريخ الإصدار'),

            ExportColumn::make('tel')
                ->label('رقم الهاتف'),

            ExportColumn::make('test_grade')
                ->label('اختبار الكفاءة'),

            ExportColumn::make('email')
                ->label('البريد الإلكتروني'),

            ExportColumn::make('status')
                ->label('الحالة'),

            ExportColumn::make('degree')
                ->label('الشهادة'),

            ExportColumn::make('specialty')
                ->label('الاختصاص'),

            ExportColumn::make('graduation_year')
                ->label('سنة التخرج'),

            ExportColumn::make('equivalence_decision')
                ->label('قرار المعادلة'),

            ExportColumn::make('equivalence_date')
                ->label('تاريخ المعادلة'),

            ExportColumn::make('bac_average')
                ->label('معدل البكالوريا'),

            ExportColumn::make('grad_average')
                ->label('معدل التخرج'),

            ExportColumn::make('created_at')
                ->label('تاريخ الإنشاء'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your application export has completed and '.Number::format($export->successful_rows).' '.str('row')->plural($export->successful_rows).' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' '.Number::format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to export.';
        }

        return $body;
    }
}
