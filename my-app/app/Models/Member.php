<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'membership_id',
        'phone',
        'notes',
        'membership_start_date',
        'membership_end_date',
        'is_active',
        'name',
        'email',
    ];

    protected $casts = [
        'membership_start_date' => 'date',
        'membership_end_date' => 'date',
        'is_active' => 'boolean',
    ];

    // Relación n:1 - Muchos miembros pertenecen a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación n:1 - Muchos miembros tienen una membresía
    public function membership()
    {
        return $this->belongsTo(Membership::class);
    }

    // Relación n:m - Un miembro asiste a muchas clases
    public function classes()
    {
        return $this->belongsToMany(Classes::class, 'class_member', 'member_id', 'class_id')
                    ->withTimestamps()
                    ->withPivot('enrolled_at', 'completed_at', 'is_active');
    }

    // Relación 1:n - Un miembro realiza muchas actividades
    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    // Relación 1:n - Un miembro realiza muchos pagos
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    // Relación 1:n - Un miembro puede dejar reseñas
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
