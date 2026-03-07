<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'medication_id', 
        'type', 
        'group', 
        'quantity', 
        'ideal_quantity', 
        'minimum_quantity', 
        'expiration_date'
    ];

    public function movimentacoes()
    {
        return $this->hasMany(Movimentacao::class);
    }
}