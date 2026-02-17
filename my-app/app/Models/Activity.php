<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'activities';

    protected $fillable = [
        'member_id',
        'type',
        'description',
        'activity_date',
        'status',
        'duration_minutes',
    ];

    protected $casts = [
        'activity_date' => 'datetime',
    ];

    // Relación n:1 - Muchas actividades pertenecen a un miembro
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
