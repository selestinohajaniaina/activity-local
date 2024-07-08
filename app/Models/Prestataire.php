<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestataire extends Model
{
    use HasFactory;

    protected $table = 'prestataires'; // Nom de la table si différent de la convention Laravel

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'password',
        'pdp',
    ];

}
