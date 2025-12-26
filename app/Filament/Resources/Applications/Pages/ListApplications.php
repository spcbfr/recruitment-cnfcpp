<?php

namespace App\Filament\Resources\Applications\Pages;

use App\Filament\Resources\Applications\ApplicationResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListApplications extends ListRecords
{
    protected static string $resource = ApplicationResource::class;

    public function getTabs(): array
    {
        return [
            'الكل' => Tab::make(),
            'المقبولين' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'مقبول')),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
        ];
    }
}
