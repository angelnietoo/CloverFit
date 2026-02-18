<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'class_id',
        'rating',
        'comment',
    ];

    protected $casts = [
        'rating' => 'integer',
    ];

    // Relación n:1 - Muchas reseñas pertenecen a un miembro
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    // Relación n:1 - Muchas reseñas pertenecen a una clase
    public function class()
    {
        return $this->belongsTo(Classes::class);
    }
}
