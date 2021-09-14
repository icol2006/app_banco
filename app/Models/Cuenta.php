<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    use HasFactory;

    protected $table = 'cuentas';
    protected $fillable = [
        'tipo', 'monto','usuarioID'
    ];

    public function Usuario()
    {
        return $this->belongsTo('App\Models\User', 'usuarioID', 'id');
    }

    public function getFullNameUsuario()
    {
        return $this->Usuario == null ? "" : $this->Usuario->name . " " . $this->Usuario->lastname;
    }
    
}
