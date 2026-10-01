<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionProcess extends Model
{
    use HasFactory;

    protected $fillable = [
        'step_number',
        'title',
        'description',
        'icon',
        'image',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'step_number' => 'integer',
            'status' => 'boolean',
        ];
    }
}
