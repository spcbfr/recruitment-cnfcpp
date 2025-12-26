<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contest extends Model
{
    protected $guarded = [
    ];

    protected function casts(): array
    {
        return [
            'ends_at' => 'datetime',
            'degrees' => 'array',
        ];
    }

    protected function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }
}
