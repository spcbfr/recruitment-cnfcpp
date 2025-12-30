<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Application extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function contest(): BelongsTo
    {
        return $this->belongsTo(Contest::class);
    }

    protected function score(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => round(
                $attributes['bac_average'] * $this->contest->bac_factor
                + $attributes['grad_average'] * $this->contest->grad_factor,
                2
            )
        );
    }

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
