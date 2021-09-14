<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialCuenta extends Model
{
    use HasFactory;

    protected $table = 'historial_cuentas';
    protected $fillable = [
        'cuentaID', 'monto','fecha'
    ];

    public function Cuenta()
    {
        return $this->belongsTo('App\Models\Cuenta', 'cuentaID', 'id');
    }
}
