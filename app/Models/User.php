<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'noms',
        'sexe',
        'tel',
        'pays',
        'gains',
        'login',
        'password',
        'email',
        'vente_mensuelle',
        'gains_vente',
        'niveau_actuel',
        'investissement',
        'type',

    ];

    protected $attributes = [
        'type'=>'register',
    ];
    

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * un utilisateur à plusieur filleuls.
     */

    public function filleuls()
    {
        return $this->hasMany(Filleul::class);
    }    

    /**
     * un user à plusieurs historique
     */

     public function historiques()
     {
        return $this->hasMany(historique::class);
     }
}
