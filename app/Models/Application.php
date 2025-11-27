<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
            'cin_date' => 'date',
            'graduation_year' => 'integer',
            'equivalence_date' => 'date',
            'bac_year' => 'integer',
        ];
    }
}
