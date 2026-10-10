<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    use HasFactory;

    protected $table = 'sucursales';

    protected $fillable = [
        'nombre',
        'direccion',
        'telefono',
        'activa',
    ];

    protected function casts(): array
    {
        return [
            'activa' => 'boolean',
        ];
    }

    /* ---------- Relaciones ---------- */

    public function users()
    {
        return $this->hasMany(User::class, 'sucursal_id');
    }

    public function lotesStock()
    {
        return $this->hasMany(LoteStock::class, 'sucursal_id');
    }

    public function ventas()
    {
        return $this->hasMany(Venta::class, 'sucursal_id');
    }

    public function cortesCaja()
    {
        return $this->hasMany(CorteCaja::class, 'sucursal_id');
    }

    /* ---------- Scopes ---------- */

    public function scopeActivas($query)
    {
        return $query->where('activa', true);
    }
}