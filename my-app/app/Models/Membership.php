<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'duration_months',
        'class_limit',
        'includes_trainer',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'includes_trainer' => 'boolean',
        'is_active' => 'boolean',
    ];

    // Relación 1:n - Una membresía tiene muchos miembros
    public function members()
    {
        return $this->hasMany(Member::class);
    }
}
