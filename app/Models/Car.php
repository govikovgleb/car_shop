<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;


class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand',
        'model',
        'engine_type',
        'drive'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function scopeFilter(Builder $query, array $filters): Builder
    {
        foreach ($filters as $field=>$value) {
            $query->where($field, $value);
        }
        return $query;
    }
}
