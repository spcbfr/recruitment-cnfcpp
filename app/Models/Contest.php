<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    protected function casts(): array
    {
        return [
            'ends_at' => 'datetime',
        ];
    }
}
