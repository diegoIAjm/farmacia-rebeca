<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nombre',
        'username',
        'email',
        'password',
        'role_id',
        'sucursal_id',
        'activo',
        'ultimo_acceso',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'activo'            => 'boolean',
            'ultimo_acceso'     => 'datetime',
        ];
    }

    /* ---------- Relaciones ---------- */

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class, 'sucursal_id');
    }

    /* ---------- Helpers de permisos ---------- */

    /**
     * Lista de nombres de permisos del rol del usuario.
     */
    public function permisos(): array
    {
        if (! $this->relationLoaded('role')) {
            $this->load('role.permissions');
        }

        if (! $this->role) {
            return [];
        }

        return $this->role->permissions->pluck('nombre')->all();
    }

    public function tienePermiso(string $permiso): bool
    {
        if (! $this->activo) {
            return false;
        }

        if ($this->esSuperadmin()) {
            return true;
        }

        return in_array($permiso, $this->permisos(), true);
    }

    public function esSuperadmin(): bool
    {
        return $this->role?->nombre === 'superadmin';
    }
}