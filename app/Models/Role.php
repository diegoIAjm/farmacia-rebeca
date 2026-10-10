<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $fillable = [
        'nombre',
        'etiqueta',
        'descripcion',
        'activo',
    ];

    protected function casts(): array
    {
        return [
            'activo' => 'boolean',
        ];
    }

    /* ---------- Relaciones ---------- */

    /**
     * Permisos asignados a este rol (N:M).
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permission')
            ->withTimestamps();
    }

    /**
     * Usuarios que tienen este rol.
     */
    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }

    /* ---------- Scopes ---------- */

    public function scopeActivos($query)
    {
        return $query->where('activo', true);
    }

    /* ---------- Helpers ---------- */

    public function esSuperadmin(): bool
    {
        return $this->nombre === 'superadmin';
    }

    /**
     * Nombres de permisos del rol (array de strings).
     */
    public function permisos(): array
    {
        return $this->permissions->pluck('nombre')->all();
    }

    public function tienePermiso(string $permiso): bool
    {
        return $this->permissions->contains('nombre', $permiso);
    }

    /* ---------- Accessors ---------- */

    /**
     * Etiqueta amigable. Si no hay etiqueta, capitaliza el nombre.
     */
    public function getEtiquetaAttribute($value): string
    {
        return $value ?: ucfirst(str_replace('_', ' ', $this->nombre));
    }
}