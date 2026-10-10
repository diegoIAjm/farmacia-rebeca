<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $table = 'permissions';

    protected $fillable = [
        'nombre',
        'etiqueta',
        'modulo',
        'descripcion',
    ];

    /* ---------- Relaciones ---------- */

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permission')
            ->withTimestamps();
    }

    /* ---------- Scopes ---------- */

    public function scopeModulo($query, string $modulo)
    {
        return $query->where('modulo', $modulo);
    }
}