<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Historique extends Model
{
    use HasFactory;

    protected $fillable = [
        'vente_mensuelle',
        'user_id',
        'retraitVente',
        'retraitGain',
    ];

    /**
     * un historique appartient à un utilisateur
     */

     public function user()
     {
        return $this->BelongsTo(User::class);
     }
}
