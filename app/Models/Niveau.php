<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Niveau extends Model
{
    use HasFactory;

   /**
    * un niveau comporte plusieur utilisateur(filleuls)
    */

    public function filleuls()
    {
        return $this->hasMany(Filleul::class);
    }
}
