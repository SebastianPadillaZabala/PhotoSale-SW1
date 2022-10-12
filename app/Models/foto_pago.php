<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class foto_pago extends Model
{
    use HasFactory;
    protected $table = 'foto_pagos';
    protected $fillable = [
        'monto', 'owner', 'card_number', 'expiration_month', 'expiration_year', 'security_code'
    ];
    protected $primaryKey = 'id_foto_pago';
}
