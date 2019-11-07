<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attestation extends Model
{
    
    public $table = 'attestation';

    public $fillable = [
    	'id',
    	'nom',
    	'prenom',
        'titre',
        'adresse',
        'code_postal',
        'commune',
        'cotisation',
        'mail',
        'statut'
    ];


    public $casts = [
    	'id' => 'integer',
    	'nom' => 'string',
    	'prenom' => 'string',
        'titre' => 'string',
        'adresse' => 'string',
        'code_postal' => 'integer',
        'commune' => 'string',
        'cotisation' => 'integer',
        'mail' => 'string',
        'statut' => 'string',
    ];
}

