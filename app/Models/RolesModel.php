<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RolesModel extends Model
{
    use HasFactory, HasRoles;

    protected $table = 'roles';

    protected $fillable = [
        'nombre',
        'activo',
    ];
}
