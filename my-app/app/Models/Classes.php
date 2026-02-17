<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classes extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'classes';

    protected $fillable = [
        'name',
        'description',
        'trainer_id',
        'level',
        'max_members',
        'image',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Relación n:1 - Muchas clases tienen un entrenador
    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }

    // Relación 1:n - Una clase tiene muchos horarios
    public function schedules()
    {
        return $this->hasMany(ClassSchedule::class, 'class_id');
    }

    // Relación n:m - Una clase tiene muchos miembros
    public function members()
    {
        return $this->belongsToMany(Member::class, 'class_member', 'class_id', 'member_id')
                    ->withTimestamps()
                    ->withPivot('enrolled_at', 'completed_at', 'is_active');
    }

    // Relación 1:n - Una clase tiene muchas reseñas
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
