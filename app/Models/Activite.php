<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activite extends Model
{
    use HasFactory;

    protected $table = 'activites'; // Nom de la table si différent de la convention Laravel

    protected $fillable = [
        'titre',
        'lieu',
        'datedebut',
        'datefin',
        'NombreParticipant',
        'prix',
        'prixParPersonne',
        'description',
        'idPrestataire',
    ];
}
