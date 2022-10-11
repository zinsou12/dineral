<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filleul extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'niveau_id',

    ];

    /**
     * un filleul à un seul parrain
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * un filleul n'a qu'un seul niveau
     */

     public function niveau()
     {
        return $this->belongsTo(Niveau::class);
     }
}
