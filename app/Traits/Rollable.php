<?php
namespace App\Traits;

use App\Models\Role;

trait Rollable
{
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function assignRole(string $role)
    {
        $role = Role::where('name', $role)->first();

        throw_if($role === null, 'Role non exists');

        $this->role()->associate($role);
    }

    public function hasRole(string $role): bool
    {
        return $this->role()->where('name', $role)->exists();
    }
}