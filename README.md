# Después de Clonar el repo

Instalar las dependencias de composer

```bash
composer install
```

Copiar el entorno

```bash
cp .env.example .env
```

Generar la llave

```bash
php artisan key:generate
```

Reemplazar la URL del entorno por la que nos entrega Firebase

https://9000-firebase-dwi-25-2-clases-1752585818839.cluster-qhrn7lb3szcfcud6uanedbkjnm.cloudworkstations.dev

Migrar la base de datos

```bash
php artisan migrate
```
Preguntará si queremos crear la base de datos sqlite, respondemos YES

# Documentacion EV3 (Roles y Permisos) y Examen (JWT y manejo de datos en perfil de Usuario)

Estudiantes: Hector Gonzalez y Ethan Mayorines.

Profesor: Sebastian Cabezas.
## Pasos a seguir.

### 1) Instalar el paquete "Laravel Permission".

'https://spatie.be/docs/laravel-permission/v6/introduction'

- Dentro de la pagina vamos a "Installation in Laravel" y hacemos click en el.

- En la pagina de "Installation in Laravel" nos aparecera el siguiente comando de composer: 
~~~
composer require spatie/laravel-permission 
~~~

- En nuestro proyecto debemos abrir una nueva terminal y pegar el comando copiado anteriormente.

### 2) Publicar la migracion del paquete.

- Despues debemos copiar y pegar el comando a continuacion en la terminal.
~~~
 php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
~~~


- En la carpeta "migrations" se nos tuvo que haber creado la siguiente tabla "2025_09_02_132903_create_permission_tables". De esta manera nos asehuramos que el comando anterior se ejecuto correctamente.

### 3) Borrar la cache de nuestro proyecto.

- Debemos copiar y pegar en la terminal el siguente comando:
~~~
php artisan optimize:clear
~~~
### 4) Borrar la tabla roles.

- Si se tiene una tabla con el nombre "2025_08_05_160528_create_table_roles" esta se debe eliminar para no chocar con la tabla que laravel permissions creara.

### 5) Modificar los seeders (Si es que se tienen).

- Eliminar los seeders llamados "DB::table('roles')" y "DB::table('users')".

- Importar lo siguiente:
 ~~~
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
 ~~~

- A continuacion al final del archivo pegamos el siguiente codigo:

~~~
$rolAdmin = Role::firstOrCreate(['name' => 'admin']);
        $rolJugador = Role::firstOrCreate(['name' => 'jugador']);
        $rolEntrenador = Role::firstOrCreate(['name' => 'entrenador']);

        $adminPermissions = [
            'user-list', 'user-create', 'user-edit', 'user-delete', 'user-activate', 'user-view',
            
            'rol-list', 'rol-create', 'rol-edit', 'rol-delete', 'rol-activate', 'rol-view',
            
            'cargos-list', 'cargos-create', 'cargos-edit', 'cargos-delete', 'cargos-activate', 'cargos-view',
            
            'comunas-list', 'comunas-create', 'comunas-edit', 'comunas-delete', 'comunas-activate', 'comunas-view',
            
            'generos-list', 'generos-create', 'generos-edit', 'generos-delete', 'generos-activate', 'generos-view',
            
            'oficios-list', 'oficios-create', 'oficios-edit', 'oficios-delete', 'oficios-activate', 'oficios-view',
            
            'posiciones-list', 'posiciones-create', 'posiciones-edit', 'posiciones-delete', 'posiciones-activate', 'posiciones-view',
            
            'premios-list', 'premios-create', 'premios-edit', 'premios-delete', 'premios-activate', 'premios-view',
            
            'categorias-list', 'categorias-create', 'categorias-edit', 'categorias-delete', 'categorias-activate', 'categorias-view',
            
            'mediospagos-list', 'mediospagos-create', 'mediospagos-edit', 'mediospagos-delete', 'mediospagos-activate', 'mediospagos-view',
            
            'recintos-list', 'recintos-create', 'recintos-edit', 'recintos-delete', 'recintos-activate', 'recintos-view',
            
            'camisetas-list', 'camisetas-create', 'camisetas-edit', 'camisetas-delete', 'camisetas-activate', 'camisetas-view',
            
            'campeonato-list', 'campeonato-create', 'campeonato-edit', 'campeonato-delete', 'campeonato-activate', 'campeonato-view',
            
            'diassemana-list', 'diassemana-create', 'diassemana-edit', 'diassemana-delete', 'diassemana-activate', 'diassemana-view',
            
            'piernadominante-list', 'piernadominante-create', 'piernadominante-edit', 'piernadominante-delete', 'piernadominante-activate', 'piernadominante-view',
            
            'horaInicio-list', 'horaInicio-create', 'horaInicio-edit', 'horaInicio-delete', 'horaInicio-activate', 'horaInicio-view',
            
            'horaFin-list', 'horaFin-create', 'horaFin-edit', 'horaFin-delete', 'horaFin-activate', 'horaFin-view',
            
            'mediocontacto-list', 'mediocontacto-create', 'mediocontacto-edit', 'mediocontacto-delete', 'mediocontacto-activate', 'mediocontacto-view',
            
            'nacionalidad-list', 'nacionalidad-create', 'nacionalidad-edit', 'nacionalidad-delete', 'nacionalidad-activate', 'nacionalidad-view',
            
            'perfil-list', 'perfil-create', 'perfil-edit', 'perfil-delete', 'perfil-activate', 'perfil-view',
            
            'categoria-list', 'categoria-create', 'categoria-edit', 'categoria-delete', 'categoria-activate', 'categoria-view',
            
            'jugadores-list', 'jugadores-create', 'jugadores-edit', 'jugadores-delete', 'jugadores-activate', 'jugadores-view',
            
            'entrenamiento-list', 'entrenamiento-create', 'entrenamiento-edit', 'entrenamiento-delete', 'entrenamiento-activate', 'entrenamiento-view',
        ];


        $jugadorPermissions = [
            'perfil-view',
            'campeonato-list',
            'premios-list',
            'posiciones-list',
            'categoria-list',
            'recintos-list',
            'diassemana-list',
            'mediocontacto-list',
            'piernadominante-list',
            'camisetas-list',
            'pedido-view',
            'pedido-cancel'
        ];


        $entrenadorPermissions = [
            'perfil-view',
            'jugadores-list',
            'jugadores-edit',
            'categoria-list',
            'campeonato-list',
            'premios-list',
            'posiciones-list',
            'recintos-list',
            'diassemana-list',
            'mediocontacto-list',
            'piernadominante-list',
            'entrenamiento-create',
            'entrenamiento-edit',
            'entrenamiento-list'
        ];

        // Asignar esos permisos a los roles especificos
        foreach ($adminPermissions as $permiso) {
            $permission = Permission::firstOrCreate(['name' => $permiso]); // se crean los permisos
            $rolAdmin->givePermissionTo($permission); // se asignan los permisos al rol admin
        }

        foreach ($jugadorPermissions as $permiso) {
            $permission = Permission::firstOrCreate(['name' => $permiso]); // se crean los permisos
            $rolJugador->givePermissionTo($permission); // se asignan los permisos al rol jugador
        }

        foreach ($entrenadorPermissions as $permiso) {
            $permission = Permission::firstOrCreate(['name' => $permiso]); // se crean los permisos
            $rolEntrenador->givePermissionTo($permission); // se asignan los permisos al rol entrenador
        }

        // Crear usuarios de prueba
        $adminUser = User::firstOrCreate(
            ['rut' => '12345678-9'],
            [
                'name' => 'Sebastián',
                'lastname' => 'Cabezas',
                'password' => Hash::make('holaMundo'),
                'fechaNacimiento' => '1987-06-08',
                'generoId' => 2,
                'cargoId' => 1,
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]
        );

        $jugadorUser = User::firstOrCreate(
            ['rut' => '21176572-0'],
            [
                'name' => 'Ethan',
                'lastname' => 'Mayorines',
                'password' => Hash::make('holaMundo'),
                'fechaNacimiento' => '1987-06-08',
                'generoId' => 2,
                'cargoId' => 1,
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]
        );

        $entrenadorUser = User::firstOrCreate(
            ['rut' => '20954121-1'],
            [
                'name' => 'Martina',
                'lastname' => 'Antilef',
                'password' => Hash::make('holaMundo'),
                'fechaNacimiento' => '1987-06-08',
                'generoId' => 2,
                'cargoId' => 1,
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]
        );

        $adminUser->assignRole($rolAdmin); // Asignar el rol admin al usuario admin
        $jugadorUser->assignRole($rolJugador); // Asignar el rol cliente al usuario cliente
        $entrenadorUser->assignRole($rolEntrenador); // Asignar el rol entrenador al usuario entrenador
~~~

### 6) Agregar el trait HasRoles en los Modelos de Roles y Users

- Importar: 
~~~
use Spatie\Permission\Traits\HasRoles;
~~~

- Agregar el trait de HasRoles luego del HasFactory:
~~~
use HasFactory, HasRoles;
~~~

- Y en RolesModel agregar el siguiente método:

Primero importar lo siguiente:
~~~
use Spatie\Permission\Models\Permission;
~~~

~~~
public function permissions()
{
    return $this->belongsToMany(Permission::class, 'role_has_permissions', 'role_id', 'permission_id');
}
~~~

### 7) Realizar migraciones.
- Primero por seguridad realizar:
~~~
php artisan migrate:fresh
~~~

- Si usted *TIENE* seeders en su proyecto debe usar el comando:
~~~
 php artisan migrate:fresh --seed
 ~~~

### 8) Modificar la tabla roles creada por laravel permissions.

- Buscar la tabla roles dentro del archivo y agregar lo siguiente despues del campo "guard_name":
~~~
$table->boolean('activo')->default(true);
~~~

- Despues de esto se debe realizar nuevamente el paso 8.

- ### 9) Agregar al inicio del archivo de Rutas los siguientes middlewares propios de Permission

Se importa lo siguiente:
~~~
use Spatie\Permission\Middleware\RoleMiddleware;
use Spatie\Permission\Middleware\PermissionMiddleware;
~~~

Y se agrega al principio de las rutas; 
~~~
Route::aliasMiddleware('role', RoleMiddleware::class);
Route::aliasMiddleware('permission', PermissionMiddleware::class);
 ~~~

- ### 10) Crearemos una Vista para la tabla de roles y pegamos el siguiente codigo 
~~~
php artisan make:view backoffice/_partials/table_roles
~~~

~~~
<table class="datatables-users table border-top">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Estado</th>
            <th>Permisos</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @if (count($lista) == 0)
            <tr>
                <td colspan="5" class="text-center">Sin Registros</td>
            </tr>
        @else
            @foreach ($lista as $item)
                @php
                    // Agrupar todos los permisos por categoría (antes del primer guion '-')
                    $todosLosPermisosAgrupados = [];
                    foreach ($permisos as $permiso) {
                        $categoria = explode('-', $permiso->name)[0];
                        if (!isset($todosLosPermisosAgrupados[$categoria])) {
                            $todosLosPermisosAgrupados[$categoria] = [];
                        }
                        $todosLosPermisosAgrupados[$categoria][] = $permiso;
                    }
                    
                    // Permisos activos del rol actual
                    $permisosActivos = $item->permissions->pluck('name')->toArray();
                @endphp
                <tr>
                    <td class="text-center">{{ $item->id }}</td>
                    <td class="text-center">{{ $item->name }}</td>
                    <td class="text-center">
                        @if ($item->activo == 1)
                            <span class="text-success">Activo</span>
                        @else
                            <span class="text-danger">Desactivado</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalPermisos{{ $item->id }}">
                            Permisos
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="modalPermisos{{ $item->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $item->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <!-- Header -->
                                    <div class="modal-header text-center">
                                        <h5 class="modal-title w-100" id="modalLabel{{ $item->id }}">
                                            <strong>Gestión de Permisos - {{ $item->name }}</strong>
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    
                                    <!-- Body -->
                                    <div class="modal-body">
                                        <form action="{{ route($datos['mantenedor']['routes']['permissions'], $item->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="modo" value="editar">
                                            
                                            <div class="text-center mb-4">
                                                <h6 class="text-body-secondary">Configura los permisos del rol</h6>
                                            </div>

                                            <!-- CSS para la nueva tabla de permisos -->
                                            <style>
                                                .permissions-table-container {
                                                    max-height: 500px;
                                                    overflow: auto;
                                                    border: 1px solid #dee2e6;
                                                    border-radius: 6px;
                                                }
                                                
                                                .permissions-table {
                                                    width: 100%;
                                                    border-collapse: collapse;
                                                    background: white;
                                                }
                                                
                                                .permissions-table th,
                                                .permissions-table td {
                                                    border: 1px solid #dee2e6;
                                                    padding: 8px 12px;
                                                    text-align: center;
                                                    white-space: nowrap;
                                                }
                                                
                                                .permissions-table thead th {
                                                    background-color: #f8f9fa;
                                                    font-weight: 600;
                                                    position: sticky;
                                                    top: 0;
                                                    z-index: 10;
                                                }
                                                
                                                .permissions-table tbody th {
                                                    background-color: #f8f9fa;
                                                    font-weight: 600;
                                                    position: sticky;
                                                    left: 0;
                                                    z-index: 5;
                                                }
                                                
                                                .permissions-table thead th:first-child {
                                                    position: sticky;
                                                    left: 0;
                                                    z-index: 15;
                                                }
                                                
                                                .select-all-buttons {
                                                    margin-bottom: 15px;
                                                    padding: 10px;
                                                    background-color: #f8f9fa;
                                                    border-radius: 6px;
                                                }
                                                
                                                .column-select-btn,
                                                .row-select-btn {
                                                    font-size: 0.75rem;
                                                    padding: 2px 6px;
                                                    margin: 2px;
                                                }
                                                
                                                .permission-checkbox {
                                                    transform: scale(1.2);
                                                }
                                                
                                                .category-header {
                                                    background-color: #e9ecef !important;
                                                    font-weight: bold;
                                                }
                                            </style>

                                            <!-- Botones de selección global -->
                                            <div class="select-all-buttons">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <button type="button" class="btn btn-outline-success btn-sm" onclick="selectAllPermissions({{ $item->id }})">
                                                            <i class="ti ti-check-all"></i> Seleccionar Todo
                                                        </button>
                                                        <button type="button" class="btn btn-outline-danger btn-sm" onclick="deselectAllPermissions({{ $item->id }})">
                                                            <i class="ti ti-square"></i> Deseleccionar Todo
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Tabla de permisos -->
                                            <div class="permissions-table-container">
                                                @php
                                                    // Obtener todos los permisos únicos por categoría
                                                    $categorias = array_keys($todosLosPermisosAgrupados);
                                                    
                                                    // Crear matriz de permisos por categoría y acción
                                                    $matrizPermisos = [];
                                                    foreach ($todosLosPermisosAgrupados as $categoria => $permisosPorCategoria) {
                                                        foreach ($permisosPorCategoria as $permiso) {
                                                            $accion = explode('-', $permiso->name, 2)[1] ?? $permiso->name;
                                                            $matrizPermisos[$categoria][$accion] = $permiso;
                                                        }
                                                    }
                                                    
                                                    // Obtener todas las acciones únicas
                                                    $acciones = [];
                                                    foreach ($matrizPermisos as $permisosPorCategoria) {
                                                        $acciones = array_merge($acciones, array_keys($permisosPorCategoria));
                                                    }
                                                    $acciones = array_unique($acciones);
                                                    sort($acciones);
                                                @endphp
                                                
                                                <table class="permissions-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Categoría / Acción</th>
                                                            @foreach ($acciones as $accion)
                                                                <th>
                                                                    <div>{{ ucfirst(str_replace('-', ' ', $accion)) }}</div>
                                                                    <button type="button" class="btn btn-outline-primary column-select-btn" 
                                                                            onclick="toggleColumnPermissions('{{ $accion }}', {{ $item->id }})">
                                                                        <i class="ti ti-check"></i>
                                                                    </button>
                                                                </th>
                                                            @endforeach
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($categorias as $categoria)
                                                            <tr>
                                                                <th class="text-start">
                                                                    <div class="d-flex justify-content-between align-items-center">
                                                                        <span>{{ ucfirst($categoria) }}</span>
                                                                        <button type="button" class="btn btn-outline-primary row-select-btn"
                                                                                onclick="toggleRowPermissions('{{ $categoria }}', {{ $item->id }})">
                                                                            <i class="ti ti-check"></i>
                                                                        </button>
                                                                    </div>
                                                                </th>
                                                                @foreach ($acciones as $accion)
                                                                    <td>
                                                                        @if (isset($matrizPermisos[$categoria][$accion]))
                                                                            @php $permiso = $matrizPermisos[$categoria][$accion]; @endphp
                                                                            <input class="form-check-input permission-checkbox 
                                                                                         category-{{ $categoria }}-{{ $item->id }}
                                                                                         action-{{ $accion }}-{{ $item->id }}"
                                                                                   type="checkbox" 
                                                                                   name="permissions[]" 
                                                                                   value="{{ $permiso->name }}"
                                                                                   id="{{ $permiso->name }}{{ $item->id }}"
                                                                                   {{ in_array($permiso->name, $permisosActivos) ? 'checked' : '' }} />
                                                                        @else
                                                                            -
                                                                        @endif
                                                                    </td>
                                                                @endforeach
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                            <script>
                                                // Función para seleccionar/deseleccionar todos los permisos
                                                function selectAllPermissions(roleId) {
                                                    const checkboxes = document.querySelectorAll('#modalPermisos' + roleId + ' .permission-checkbox');
                                                    checkboxes.forEach(checkbox => checkbox.checked = true);
                                                }
                                                
                                                function deselectAllPermissions(roleId) {
                                                    const checkboxes = document.querySelectorAll('#modalPermisos' + roleId + ' .permission-checkbox');
                                                    checkboxes.forEach(checkbox => checkbox.checked = false);
                                                }

                                                // Función para toggle de permisos por columna (acción)
                                                function toggleColumnPermissions(accion, roleId) {
                                                    const checkboxes = document.querySelectorAll('.action-' + accion + '-' + roleId);
                                                    const checkedCount = document.querySelectorAll('.action-' + accion + '-' + roleId + ':checked').length;
                                                    const shouldCheck = checkedCount < checkboxes.length;
                                                    
                                                    checkboxes.forEach(checkbox => {
                                                        checkbox.checked = shouldCheck;
                                                    });
                                                }

                                                // Función para toggle de permisos por fila (categoría)
                                                function toggleRowPermissions(categoria, roleId) {
                                                    const checkboxes = document.querySelectorAll('.category-' + categoria + '-' + roleId);
                                                    const checkedCount = document.querySelectorAll('.category-' + categoria + '-' + roleId + ':checked').length;
                                                    const shouldCheck = checkedCount < checkboxes.length;
                                                    
                                                    checkboxes.forEach(checkbox => {
                                                        checkbox.checked = shouldCheck;
                                                    });
                                                }
                                            </script>

                                            <div class="d-flex justify-content-end mt-4">
                                                <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">
                                                    Cancelar
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    Guardar Permisos
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="text-center">
                        @if ($item->activo == 1)
                            <form action="{{ route($datos['mantenedor']['routes']['down'], $item->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                <button type="submit" class="btn btn-danger" 
                                        onclick="this.disabled=true; this.innerHTML='<i class=\'icon-base ti tabler-loader\'></i> Procesando...'; setTimeout(() => this.form.submit(), 500);">
                                    <i class="icon-base ti tabler-arrow-down"></i> Desactivar
                                </button>
                            </form>
                        @else
                            <form action="{{ route($datos['mantenedor']['routes']['up'], $item->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                <button type="submit" class="btn btn-primary" 
                                        onclick="this.disabled=true; this.innerHTML='<i class=\'icon-base ti tabler-loader\'></i> Procesando...'; setTimeout(() => this.form.submit(), 500);">
                                    <i class="icon-base ti tabler-arrow-up"></i> Activar
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
~~~

### 11) Modificamos el contenido de la vista backoffice/roles/index, eliminando el codigo y pegando el siguiente:

~~~
@extends('backoffice._partials.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="mb-1">{{ $datos['mantenedor']['titulo'] }}</h4>
        <p class="mb-6">
            {{ $datos['mantenedor']['instruccion'] }}
        </p>

        @include('backoffice._partials.messages')

        <!-- Botón para Crear un Nuevo Rol -->
        <div class="d-flex justify-content-between mb-4">
            <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal" class="btn btn-success">
                <i class="icon-base ti ti-plus"></i> Crear Nuevo Rol
            </a>
        </div>

        <!-- Role Table -->
        <div class="card">
            <div class="card-datatable">
                @include('backoffice._partials.table_roles', [
                    'lista' => $lista,
                    'datos' => $datos
                ])
            </div>
        </div>
        <!--/ Role Table -->

        <!-- Modal para agregar nuevo rol -->
        @include('backoffice._partials.modal', [
            'titulo' => $datos['mantenedor']['titulo'],
            'instruccion' => $datos['mantenedor']['instruccion'],
            'accion' => 'new',
            'ruta' => $datos['mantenedor']['routes']['new'],
            'campos' => $datos['mantenedor']['fields'],
            'permisos' => $permisos
        ])
        <!--/ Modal para agregar nuevo rol -->

    </div>
@endsection

~~~

### 12) Modificar de forma completa el RolesController, pegando el siguiente código:

~~~
<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\RolesModel;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    public function index()
    {

        if (!Auth::check()) {
            // Verifica si el usuario NO está autenticado
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }

        $user = Auth::user();
        $user->load('roles'); // ✅ roles cargados

        //$lista = RolesModel::all();
        $lista = RolesModel::with('permissions')->get();
        $permisos = Permission::all(); // ✅ todos los permisos
        $roles = Role::all();

        $datos = [
            'textos' => [
                'titulo' => 'Iniciar Sesión | Sonkei FC',
                'logo' => '/assets/imgs/logo_sonkei_v2.webp',
                'nombre' => 'Sonkei FC',
                'formulario' => [
                    'titulo' => 'Bienvenido a Sonkei FC ⚽️',
                    'instruccion' => 'Ingrese Credenciales'
                ],
            ],
            'mantenedor' => [
                'titulo' => 'Roles de Usuario',
                'instruccion' => 'Los roles de usuario definen qué puede hacer un usuario dentro del sistema.',
                'routes' => [
                    'new' => 'backoffice.roles.new',
                    'update' => 'backoffice.roles.update',
                    'up' => 'backoffice.roles.up',
                    'down' => 'backoffice.roles.down',
                    'delete' => 'backoffice.roles.destroy',
                    'permissions' => 'backoffice.roles.update.permissions', // 🔹 nueva ruta
                ],
                'fields' => [
                    [
                        'label' => 'Nombre',
                        'name' => 'roles_nombre',
                        'required' => true,
                        'control' => [
                            'element' => 'input',
                            'type' => 'text',
                            'classList' => [
                                'form-control',
                                'mb-4'
                            ],
                            'min' => 3,
                            'max' => 50,
                            'placeholder' => 'Ingrese un nombre'
                        ],
                        'access' => [
                            'editableIn' => [
                                'new' => true,
                                'edit' => true,
                                'show' => false,
                                'up' => false,
                                'down' => false,
                                'delete' => false
                            ],
                            'readIn' => [
                                'new' => true,
                                'edit' => true,
                                'show' => true,
                                'up' => true,
                                'down' => true,
                                'delete' => true
                            ]
                        ]
                    ],
                ]
            ],
            'dev' => [
                'nombre' => 'Instituto Profesional San Sebastián',
                'url' => 'https://www.ipss.cl',
                'logo' => 'https://ipss.cl/wp-content/uploads/2025/04/cropped-LogoIPSS_sello50anos_webipss.png'
            ]
        ];

        return view('backoffice/roles/index', [
            'datos' => $datos,
            'user' => $user,
            'lista' => $lista,
            'permisos' => $permisos,
            'roles' => $roles
        ]);
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }

        $user = Auth::user();

        // Validación de los campos
        $request->validate([
            'roles_nombre' => ['required', 'string', 'max:50', 'min:3'],
        ]);

        // Crear un nuevo rol
        $nuevo = Role::create([
            'name' => $request->roles_nombre
        ]);
        /*
    $nuevo = RolesModel::create([
        'nombre' => $request->roles_nombre,
    ]);
    */

        // Redirigir con mensaje de éxito
        return redirect()->back()->with('success', ':) Rol creado exitosamente.');
    }

    public function down(Request $request, $_id)
    {
        if (!Auth::check()) {
            // Verifica si el usuario NO está autenticado
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }
        $user = Auth::user();

        $buscado = RolesModel::find($_id);

        if ($buscado->activo == 1) {
            $buscado->activo = 0;
            $buscado->save();
            return redirect()->back()->with('success', ':) Rol apagado exitosamente.');
        }
        return redirect()->back()->withErrors('No se realizaron Cambios.');
    }

    public function up(Request $request, $_id)
    {
        if (!Auth::check()) {
            // Verifica si el usuario NO está autenticado
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }
        $user = Auth::user();

        $buscado = RolesModel::find($_id);

        if ($buscado->activo == 0) {
            $buscado->activo = 1;
            $buscado->save();
            return redirect()->back()->with('success', ':) Rol encendido exitosamente.');
        }
        return redirect()->back()->withErrors('No se realizaron Cambios.');
    }
    public function destroy(Request $request, $_id)
    {
        if (!Auth::check()) {
            // Verifica si el usuario NO está autenticado
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }
        $user = Auth::user();

        $buscado = RolesModel::find($_id);

        $buscado->delete();

        return redirect()->back()->with('success', ':) Rol eliminado exitosamente.');
    }

    public function updatePermissions(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }

        $request->validate([
            'permissions' => 'nullable|array',
            'permissions.*' => 'string',
            'modo' => 'required|string|in:agregar,editar',
        ]);

        $role = Role::findOrFail($id);

        $permisos = $request->input('permissions', []);
        $modo = $request->input('modo');

        if ($modo === 'agregar') {
            // Agregar permisos sin eliminar los existentes
            $role->givePermissionTo($permisos);
        } elseif ($modo === 'editar') {
            // Reemplazar permisos
            $role->syncPermissions($permisos);
        }

        return redirect()->back()->with('success', 'Permisos actualizados correctamente.');
    }


    // Toggle (attach/detach) individual permiso via AJAX (fetch)
    public function togglePermission(Request $request, $id)
    {
        if (!Auth::check()) {
            return response()->json(['ok' => false, 'message' => 'No autenticado'], 401);
        }

        $request->validate([
            'permission' => 'required|string',
            'checked' => 'required|boolean',
        ]);

        $role = Role::findOrFail($id);
        $permName = $request->input('permission');

        if ($request->boolean('checked')) {
            if (! $role->hasPermissionTo($permName)) {
                $role->givePermissionTo($permName);
            }
            $status = 'attached';
        } else {
            if ($role->hasPermissionTo($permName)) {
                $role->revokePermissionTo($permName);
            }
            $status = 'detached';
        }

        return response()->json([
            'ok' => true,
            'status' => $status,
            'role' => $role->name,
            'permission' => $permName
        ]);
    }

    // METODO A FUTURO IMPLEMENTAR
    public function changeRole(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }

        // ✅ Validar que tenga el permiso adecuado
        if (!auth()->user()->can('rol-edit')) {
            return redirect()->back()->withErrors('No tiene permiso para cambiar roles.');
        }

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role_id' => 'required|exists:roles,id',
        ]);

        $userAuth = Auth::user(); // Usuario autenticado
        $user = User::findOrFail($request->user_id);
        $role = Role::findOrFail($request->role_id);

        // ✅ Caso 1: el admin cambia su propio rol
        if ($user->id === $userAuth->id) {
            $userAuth->syncRoles([$role->name]);
            return redirect()->back()->with('success', "Te has cambiado al rol: {$role->name}");
        }

        // ✅ Caso 2: el admin cambia el rol de otro usuario
        $user->syncRoles([$role->name]);
        return redirect()->back()->with('success', "El usuario {$user->name} ahora tiene el rol: {$role->name}");
    }
}
~~~

### 13) Aplicar sistema de Roles/Permisos en las Vistas o Controladores según se requiera

- Para aplicar Roles en las vistas Blade usar lo siguiente dependiendo de Rol o de los Roles que se requieran:
~~~
@if(auth()->user()->hasRole('admin')) 

@endif
~~~

~~~
@if(auth()->user()->hasAnyRole(['admin', 'entrenador']))

@endif
~~~


- Para designar un tipo de permiso a un metodo del Controlador, usar lo siguiente:

Alternativa 1: Más flexible, pero más “manual” (no lanza 403 automáticamente a menos que lo programes), ya que se decide manualmente qué hacer si falla
~~~
public function create()
{
    if (!auth()->user()->can('cargos-create')) {
        return redirect()->back()->withErrors('No tiene permiso para crear cargos.'); // o la alternativa es abort(403, 'No tienes permisos para ver x cosa.....');
    }
}
~~~

Alternativa 2: Es la opción recomendada cuando cada acción tiene permisos claros y fijos.
~~~
class CargosController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'permission:cargos-list'])->only('index');
        $this->middleware(['auth', 'permission:cargos-create'])->only('store');
        $this->middleware(['auth', 'permission:cargos-destroy'])->only('destroy');
        $this->middleware(['auth', 'permission:cargos-up'])->only('up');
        $this->middleware(['auth', 'permission:cargos-down'])->only('down');
    }
}
~~~

### 14) Agregar las siguientes rutas:

~~~
Route::get('/backoffice/roles', [RolesController::class, 'index'])->name('backoffice.roles.index');
    Route::post('/backoffice/roles', [RolesController::class, 'store'])->name('backoffice.roles.new');
    Route::post('/backoffice/roles/down/{_id}', [RolesController::class, 'down'])->name('backoffice.roles.down');
    Route::post('/backoffice/roles/up/{_id}', [RolesController::class, 'up'])->name('backoffice.roles.up');
    Route::post('/backoffice/roles/destroy/{_id}', [RolesController::class, 'destroy'])->name('backoffice.roles.destroy');

    Route::put('/backoffice/roles/{id}/permissions', [RolesController::class, 'updatePermissions'])
        ->name('backoffice.roles.update.permissions');
    Route::post('/backoffice/roles/{id}/permissions/toggle', [RolesController::class, 'togglePermission'])
        ->name('backoffice.roles.toggle.permission');
~~~

### RECOMENDACIONES ADICIONALES:

- En el metodo index del UserController, remplazar las siguientes líneas de código:
~~~
$user = Auth::user();
$lista = User::all();
~~~

Por las siguientes:
~~~
$user = Auth::user();
$lista = User::with('roles', 'permissions')->get();
$roles = Role::all();

Importando el use Spatie\Permission\Models\Role;
~~~

- En el fields de ese método index, agregar al final 'has_roles' => true, antes del corchete de 'dev', y en el return view agregar 'roles' => $roles, asi debe quedar:
~~~
              ],
              'has_roles' => true, // Se agrega para pasarle el rol que tiene el usuario a la vista
            ],
            'dev' => [
                'nombre' => 'Instituto Profesional San Sebastián',
                'url' => 'https://www.ipss.cl',
                'logo' => 'https://ipss.cl/wp-content/uploads/2025/04/cropped-LogoIPSS_sello50anos_webipss.png'
            ]
        ];
        return view('backoffice/users/index', [
            'datos' => $datos,
            'user' => $user,
            'lista' => $lista,
            'roles' => $roles
        ]);
~~~

- En el método guardarNuevo del UserController, luego del bloque de $user = User::create([]), antes del redirect, agregar el siguiente código:
~~~
$rolJugador = Role::where('name', 'jugador')->first();

if ($rolJugador) {
    $user->assignRole($rolJugador);
}
~~~


- En el método store del UserController, luego de todo el bloque de $nuevo = User::create([], agregar el siguiente código antes del redirect:
~~~
// Asignar el rol, en base al cargo elegido en el formulario de creacion de usuario
        // Buscar el cargo elegido
        $cargo = CargosModel::find($request->cargoId);

        if ($cargo) {
            $rolName = strtolower($cargo->nombre);
            $rol = Role::where('name', $rolName)->first();

            if ($rol) {
                $nuevo->assignRole($rol); // asigna rol según cargo
            } else {
                // Si no existe rol según cargo, asigna "jugador" por defecto
                $rolJugador = Role::where('name', 'jugador')->first();
                if ($rolJugador) {
                    $nuevo->assignRole($rolJugador);
                }
            }
        }
~~~

- En la migración de users, hacer ->nullable() los campos fechaNacimiento y generoId, CargoId hacerlo $table->string('cargoId')->nullable()->default(1);

- OPCIONAL: En el resources/views/backoffice/_partials/table.blade.php, editar el:
~~~
<td class="text-center">{{ $item->nombre }}</td>
~~~

Por:
~~~
<td class="text-center">
    @if ($item->nombre)
        {{ $item->nombre }}
    @else
        {{ $item->name }}
    @endif
</td>
~~~

### 14) OPCIONAL: Agrupar rutas por medio de roles en el archivo de rutas, siguiendo el siguiente modelo como guía:
~~~
Route::middleware(['auth', 'role:admin'])->group(function () {

    // CARGOS
    Route::get('/backoffice/cargos', [CargosController::class, 'index'])->name('backoffice.cargos.index');
    Route::post('/backoffice/cargos', [CargosController::class, 'store'])->name('backoffice.cargos.new');
    Route::post('/backoffice/cargos/down/{_id}', [CargosController::class, 'down'])->name('backoffice.cargos.down');
    Route::post('/backoffice/cargos/up/{_id}', [CargosController::class, 'up'])->name('backoffice.cargos.up');
    Route::post('/backoffice/cargos/destroy/{_id}', [CargosController::class, 'destroy'])->name('backoffice.cargos.destroy');

    // ROLES
    Route::get('/backoffice/roles', [RolesController::class, 'index'])->name('backoffice.roles.index');
    Route::post('/backoffice/roles', [RolesController::class, 'store'])->name('backoffice.roles.new');
    Route::post('/backoffice/roles/down/{_id}', [RolesController::class, 'down'])->name('backoffice.roles.down');
    Route::post('/backoffice/roles/up/{_id}', [RolesController::class, 'up'])->name('backoffice.roles.up');
    Route::post('/backoffice/roles/destroy/{_id}', [RolesController::class, 'destroy'])->name('backoffice.roles.destroy');

    Route::put('/backoffice/roles/{id}/permissions', [RolesController::class, 'updatePermissions'])
        ->name('backoffice.roles.update.permissions');
    Route::post('/backoffice/roles/{id}/permissions/toggle', [RolesController::class, 'togglePermission'])
        ->name('backoffice.roles.toggle.permission');

    // AGREGAR DEMASES RUTAS
});
~~~

# EXAMEN

### 1) Instalar JWT
~~~
composer require tymon/jwt-auth
php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
php artisan jwt:secret
~~~

### 2) En config/auth.php comprueba/añade el guard api así (manteniendo web como default para tus vistas):
~~~
'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'api' => [
            'driver' => 'jwt',
            'provider' => 'users',
        ],
    ],
~~~

### 3) Cambios en el modelo User: Añade la interfaz JWTSubject e implementa sus dos métodos
~~~
<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'lastname',
        'rut',
        'password',
        'cargoId',
        'generoId',
        'fechaNacimiento',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function rut()
    {
        return 'rut';
    }

    public function genero()
    {
        return $this->belongsTo(GeneroModel::class, 'generoId');
    }

    // Métodos necesarios para JWT
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
~~~

### 4) Cambios en UserController (registro, login y logout con JWT)

- Importar:
~~~
use Illuminate\Support\Facades\Cookie;
~~~

- Agregar el metodo makeJwtCookie
~~~
/**
 * Helper: crea la cookie con el token JWT
 */
protected function makeJwtCookie(string $token)
{
    // TTL en minutos (factory()->getTTL() devuelve minutos)
    $ttl = auth('api')->factory()->getTTL();

    // secure en producción (ajusta si trabajas en localhost con https false)
    $secure = config('app.env') === 'production';

    // cookie(name, value, minutes, path, domain, secure, httpOnly, raw, sameSite)
    return cookie('jwt_token', $token, $ttl, '/', null, $secure, true, false, 'Strict');
}
~~~

- Modificar el metodo guardarNuevo
~~~
public function guardarNuevo(Request $request)
    {

        // 1. Validación de los datos del formulario
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'rut' => ['required', 'min:9', 'max:10', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Password::defaults()],
        ], $this->messages);

        // 2. Creación del nuevo usuario en la base de datos
        $user = User::create([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'rut' => $request->rut,
            'password' => Hash::make($request->password),
        ]);

        // 3. Asignar rol "jugador" por defecto
        $rolJugador = Role::where('name', 'jugador')->first();

        if ($rolJugador) {
            $user->assignRole($rolJugador);
        }

        // 4. Generar JWT para el usuario creado (sin loguearlo)
        $token = auth('api')->login($user); // Esto genera un token válido
        $cookie = $this->makeJwtCookie($token);

        // 5. Redirigir al login con mensaje y cookie JWT (el usuario aún no está logueado)
        return redirect()->route('/') // o la ruta de tu formulario de login
            ->with('success', 'Usuario creado exitosamente. Ahora puede iniciar sesión.')
            ->withCookie($cookie);
    }
~~~

- Modificar el metodo login
~~~
public function login(Request $request)
    {
        // Paso 1: Ver qué llega en la solicitud del formulario
        // dd($request->all());

        $credentials = $request->validate([
            'rut' => ['required'],
            'password' => ['required'],
        ]);

        //dd($credentials);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            // Generar JWT para el mismo usuario
            $token = auth('api')->login($user);
            $cookie = $this->makeJwtCookie($token);

            return redirect()->route('/')->with('success', "Bienvenido {$user->name}, tiene una sesión iniciada exitosamente.")->withCookie($cookie);
        }

        return back()->withErrors([
            'username' => 'Las credenciales no coinciden con nuestros registros.',
        ])->onlyInput('username');
    }
~~~

- Modificar el metodo logout
~~~
public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Invalidar token JWT guardado en cookie (si existe)
        $token = $request->cookie('jwt_token');
        if ($token) {
            try {
                auth('api')->setToken($token)->invalidate();
            } catch (\Exception $e) {
                // Si falla la invalidación (token expirado u otro), lo ignoramos
            }
        }

        // Borrar cookie
        $forget = Cookie::forget('jwt_token');

        return redirect()->route('/')->with('success', 'Sesión cerrada exitosamente.')->withCookie($forget);
    }
~~~

### 5) ARREGLAR BUG del perfil del User

- En return view('backoffice/users/contact' y return view('backoffice/users/security' agregar:
~~~
return view('backoffice/users/contact', [
    'datos' => $datos,
    'user' => $user
]);

return view('backoffice/users/security', [
    'datos' => $datos,
    'user' => $user
]);
~~~

### 6) Crear migracion para tabla intermedia usuario_contacto_table
~~~
php artisan make:migration usuario_contacto_table
~~~

- Pegar el siguiente codigo:
~~~
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('usuario_contacto', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('medio_contacto_id');
            $table->string('valor'); // ej: "correo@gmail.com" o "+56 9 11111111"
            $table->boolean('visible')->default(true);
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('medio_contacto_id')->references('id')->on('medio_contacto')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario_contacto');
    }
};
~~~

### 7) Modificar al completo el contenido de la tabla/migracion, modelo y Controller de User

- Migracion/tabla de Users:
~~~
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('rut')->unique();
            $table->string('name');
            $table->string('lastname');
            $table->string('password')->nullable();
            $table->date('fechaNacimiento')->nullable();
        
            $table->unsignedBigInteger('generoId')->nullable();
            $table->unsignedBigInteger('cargoId')->nullable();
            $table->unsignedBigInteger('oficioId')->nullable();
            $table->unsignedBigInteger('nacionalidadId')->nullable();
            $table->unsignedBigInteger('piernaDominanteId')->nullable();
            $table->unsignedBigInteger('comunaId')->nullable();
        
            $table->rememberToken();
            $table->timestamps();
            $table->boolean('activo')->default(true);
        
            // Llaves foráneas
            $table->foreign('generoId')->references('id')->on('genero')->nullOnDelete();
            $table->foreign('cargoId')->references('id')->on('cargos')->nullOnDelete();
            $table->foreign('oficioId')->references('id')->on('oficios')->nullOnDelete();
            $table->foreign('nacionalidadId')->references('id')->on('nacionalidad')->nullOnDelete();
            $table->foreign('piernaDominanteId')->references('id')->on('pierna_dominante')->nullOnDelete();
            $table->foreign('comunaId')->references('id')->on('comunas')->nullOnDelete();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('rut')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
~~~

- Modelo User
~~~
<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'lastname',
        'rut',
        'password',
        'cargoId',
        'generoId',
        'fechaNacimiento',
        'nacionalidadId',
        'piernaDominanteId',
        'oficioId',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'fechaNacimiento' => 'date',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    // Relaciones

    public function genero()
    {
        return $this->belongsTo(GeneroModel::class, 'generoId');
    }

    public function cargo()
    {
        return $this->belongsTo(CargosModel::class, 'cargoId');
    }

    public function oficio()
    {
        return $this->belongsTo(OficiosModel::class, 'oficioId');
    }

    public function nacionalidad()
    {
        return $this->belongsTo(NacionalidadModel::class, 'nacionalidadId');
    }

    public function piernaDominante()
    {
        return $this->belongsTo(PiernaDominanteModel::class, 'piernaDominanteId');
    }

    public function comuna()
    {
        return $this->belongsTo(ComunasModel::class, 'comunaId');
    }

    // Relación muchos a muchos con medios de contacto
    public function mediosDeContacto()
    {
        return $this->belongsToMany(MedioContactoModel::class, 'usuario_contacto', 'user_id', 'medio_contacto_id')
            ->withPivot('valor', 'visible')
            ->withTimestamps();
    }

    public function mediosDeContactoVisibles()
    {
        return $this->belongsToMany(MedioContactoModel::class, 'usuario_contacto', 'user_id', 'medio_contacto_id')
            ->withPivot('valor', 'visible')
            ->wherePivot('visible', true) // 👈 Solo los visibles
            ->withTimestamps();
    }

    // Métodos JWT
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
~~~

- UserController
~~~
<?php

namespace App\Http\Controllers;

use App\Models\CargosModel;
use App\Models\GeneroModel;
use App\Models\ComunasModel;
use App\Models\OficiosModel;
use Illuminate\Http\Request;
use App\Models\PosicionModel;
use App\Models\NacionalidadModel;
use App\Models\MedioContactoModel;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Models\PiernaDominanteModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\Models\User;  // Importar el modelo User
use Illuminate\Support\Facades\Hash;  // Importar la fachada Hash
use Illuminate\Validation\Rules\Password;  // Importar la clase Password
use Illuminate\Auth\Events\Registered;  // Opcional, si usas el evento Registered

class UserController extends Controller
{

    /**
     * Helper: crea la cookie con el token JWT
     */
    protected function makeJwtCookie(string $token)
    {
        // TTL en minutos (factory()->getTTL() devuelve minutos)
        $ttl = auth('api')->factory()->getTTL();

        // secure en producción (ajusta si trabajas en localhost con https false)
        $secure = config('app.env') === 'production';

        // cookie(name, value, minutes, path, domain, secure, httpOnly, raw, sameSite)
        return cookie('jwt_token', $token, $ttl, '/', null, $secure, true, false, 'Strict');
    }

    public function showFormRegistro()
    {
        if (Auth::check()) {
            // Verifica si el el usuario ya está autenticado
            return redirect()->route('/')->with('success', 'Tiene una sesión iniciada, ciérrela para crear una nueva.');
        }

        $datos = [
            'textos' => [
                'titulo' => 'Registrar | Sonkei FC',
                'logo' => '/assets/imgs/logo_sonkei_v2.webp',
                'nombre' => 'Sonkei FC',
                'formulario' => [
                    'titulo' => 'Registro Sonkei FC ⚽️',
                    'instruccion' => 'Ingrese sus datos para registrarse en el sistema'
                ],
            ],
            'dev' => [
                'nombre' => 'Instituto Profesional San Sebastián',
                'url' => 'https://www.ipss.cl',
                'logo' => 'https://ipss.cl/wp-content/uploads/2025/04/cropped-LogoIPSS_sello50anos_webipss.png'
            ]
        ];

        return view('backoffice/users/registro', $datos);
    }

    public function guardarNuevo(Request $request)
    {

        // 1. Validación de los datos del formulario
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'rut' => ['required', 'min:9', 'max:10', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Password::defaults()],
        ], $this->messages);

        // 2. Buscar el cargo "Jugador" por defecto
        $cargoJugador = DB::table('cargos')->where('nombre', 'Jugador')->first();

        // 3. Creación del nuevo usuario en la base de datos con cargo por defecto
        $user = User::create([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'rut' => $request->rut,
            'cargoId' => $cargoJugador ? $cargoJugador->id : null, // asigna cargo jugador
            'password' => Hash::make($request->password),
        ]);

        // 4. Asignar rol "jugador" por defecto
        $rolJugador = Role::where('name', 'jugador')->first();
        if ($rolJugador) {
            $user->assignRole($rolJugador);
        }

        // 5. Generar JWT para el usuario creado (sin loguearlo)
        $token = auth('api')->login($user); // Esto genera un token válido
        $cookie = $this->makeJwtCookie($token);

        // 6. Redirigir al login con mensaje y cookie JWT (el usuario aún no está logueado)
        return redirect()->route('/') // o la ruta de tu formulario de login
            ->with('success', 'Usuario creado exitosamente. Ahora puede iniciar sesión.')
            ->withCookie($cookie);
    }

    public function showFormLogin()
    {
        $datos = [
            'textos' => [
                'titulo' => 'Iniciar Sesión | Sonkei FC',
                'logo' => '/assets/imgs/logo_sonkei_v2.webp',
                'nombre' => 'Sonkei FC',
                'formulario' => [
                    'titulo' => 'Bienvenido a Sonkei FC ⚽️',
                    'instruccion' => 'Ingrese Credenciales'
                ],
            ],
            'dev' => [
                'nombre' => 'Instituto Profesional San Sebastián',
                'url' => 'https://www.ipss.cl',
                'logo' => 'https://ipss.cl/wp-content/uploads/2025/04/cropped-LogoIPSS_sello50anos_webipss.png'
            ]
        ];


        if (Auth::check()) {
            // Si el usuario ya está autenticado, redirígelo a la página principal
            // o a su dashboard.
            return redirect()->route('/')->with('success', 'Tiene una sesión iniciada, ciérrela para iniciar una nueva.');
        }


        return view('backoffice/users/login', $datos);
    }

    public function login(Request $request)
    {
        // Paso 1: Ver qué llega en la solicitud del formulario
        // dd($request->all());

        $credentials = $request->validate([
            'rut' => ['required'],
            'password' => ['required'],
        ]);

        //dd($credentials);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            // Generar JWT para el mismo usuario
            $token = auth('api')->login($user);
            $cookie = $this->makeJwtCookie($token);

            return redirect()->route('/')->with('success', "Bienvenido {$user->name}, tiene una sesión iniciada exitosamente.")->withCookie($cookie);
        }

        return back()->withErrors([
            'username' => 'Las credenciales no coinciden con nuestros registros.',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Invalidar token JWT guardado en cookie (si existe)
        $token = $request->cookie('jwt_token');
        if ($token) {
            try {
                auth('api')->setToken($token)->invalidate();
            } catch (\Exception $e) {
                // Si falla la invalidación (token expirado u otro), lo ignoramos
            }
        }

        // Borrar cookie
        $forget = Cookie::forget('jwt_token');

        return redirect()->route('/')->with('success', 'Sesión cerrada exitosamente.')->withCookie($forget);
    }

    public function showPerfil()
    {
        if (!Auth::check()) {
            // Verifica si el el usuario ya está autenticado
            return redirect()->route('/')->withErrors('Error: No tiene una sesión iniciada.');
        }

        $user = Auth::user()->load('cargo'); // Carga la relación

        $datos = [
            'textos' => [
                'titulo' => 'Mantenedor Usuarios | Sonkei FC',
                'logo' => '/assets/imgs/logo_sonkei_v2.webp',
                'nombre' => 'Sonkei FC',
                'formulario' => [
                    'titulo' => 'Registro Sonkei FC ⚽️',
                    'instruccion' => 'Ingrese sus datos para registrarse en el sistema'
                ],
            ],
            'dev' => [
                'nombre' => 'Instituto Profesional San Sebastián',
                'url' => 'https://www.ipss.cl',
                'logo' => 'https://ipss.cl/wp-content/uploads/2025/04/cropped-LogoIPSS_sello50anos_webipss.png'
            ],
            'user' => $user
        ];

        return view('backoffice/users/profile', [
            'datos' => $datos,
            'user' => $user
        ]);
    }

    public function showContacto()
    {
        if (!Auth::check()) {
            // Verifica si el el usuario ya está autenticado
            return redirect()->route('/')->withErrors('Error: No tiene una sesión iniciada.');
        }

        $user = Auth::user();

        $datos = [
            'textos' => [
                'titulo' => 'Mantenedor Usuarios | Sonkei FC',
                'logo' => '/assets/imgs/logo_sonkei_v2.webp',
                'nombre' => 'Sonkei FC',
                'formulario' => [
                    'titulo' => 'Registro Sonkei FC ⚽️',
                    'instruccion' => 'Ingrese sus datos para registrarse en el sistema'
                ],
            ],
            'dev' => [
                'nombre' => 'Instituto Profesional San Sebastián',
                'url' => 'https://www.ipss.cl',
                'logo' => 'https://ipss.cl/wp-content/uploads/2025/04/cropped-LogoIPSS_sello50anos_webipss.png'
            ],
            'user' => $user
        ];

        // Traer datos para selects
        $generos = GeneroModel::where('activo', 1)->get();
        $cargos = CargosModel::where('activo', 1)->get();
        $oficios = OficiosModel::where('activo', 1)->get();
        $nacionalidades = NacionalidadModel::where('activo', 1)->get();
        $piernas = PiernaDominanteModel::where('activo', 1)->get();
        $medios = MedioContactoModel::all();
        $comunas = ComunasModel::where('activo', 1)->get();

        return view('backoffice/users/contact', [
            'datos' => $datos,
            'user' => $user,
            'generos' => $generos,
            'cargos' => $cargos,
            'oficios' => $oficios,
            'nacionalidades' => $nacionalidades,
            'piernas' => $piernas,
            'medios' => $medios,
            'comunas' => $comunas
        ]);
    }

    public function updateContacto(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'nacimiento' => 'nullable|date',
            'generoId' => 'nullable|exists:genero,id',
            'oficioId' => 'nullable|exists:oficios,id',
            'nacionalidadId' => 'nullable|exists:nacionalidad,id',
            'piernaDominanteId' => 'nullable|exists:pierna_dominante,id',
            'comunaId' => 'nullable|exists:comunas,id',
            'medios' => 'array',
            'medios.*' => 'nullable|string|max:255',
        ]);

        // Guardar datos básicos
        $user->fechaNacimiento = $request->has('nacimiento') && $request->nacimiento !== ''
            ? $request->nacimiento
            : null; // si borra el campo, queda vacío

        $user->generoId = $request->has('generoId')
            ? ($request->generoId !== '' ? $request->generoId : null)
            : $user->generoId;

        $user->oficioId = $request->has('oficioId')
            ? ($request->oficioId !== '' ? $request->oficioId : null)
            : $user->oficioId;

        $user->nacionalidadId = $request->has('nacionalidadId')
            ? ($request->nacionalidadId !== '' ? $request->nacionalidadId : null)
            : $user->nacionalidadId;

        $user->piernaDominanteId = $request->has('piernaDominanteId')
            ? ($request->piernaDominanteId !== '' ? $request->piernaDominanteId : null)
            : $user->piernaDominanteId;

        $user->comunaId = $request->has('comunaId')
            ? ($request->comunaId !== '' ? $request->comunaId : null)
            : $user->comunaId;

        $user->save();

        // Guardar medios de contacto
        if ($request->has('medios')) {
            foreach ($request->medios as $medioId => $valor) {
                $visible = isset($request->medios_visible[$medioId]) ? 1 : 0;
        
                if ($valor !== null && $valor !== '') {
                    $user->mediosDeContacto()->syncWithoutDetaching([
                        $medioId => [
                            'valor' => $valor,
                            'visible' => $visible,
                        ]
                    ]);
                } else {
                    $user->mediosDeContacto()->detach($medioId);
                }
            }
        }

        return redirect()->route('backoffice.user.contact')
            ->with('success', 'Datos de contacto actualizados correctamente');
    }


    public function showSeguridad()
    {
        if (!Auth::check()) {
            // Verifica si el el usuario ya está autenticado
            return redirect()->route('/')->withErrors('Error: No tiene una sesión iniciada.');
        }

        $user = Auth::user();

        $datos = [
            'textos' => [
                'titulo' => 'Mantenedor Usuarios | Sonkei FC',
                'logo' => '/assets/imgs/logo_sonkei_v2.webp',
                'nombre' => 'Sonkei FC',
                'formulario' => [
                    'titulo' => 'Registro Sonkei FC ⚽️',
                    'instruccion' => 'Ingrese sus datos para registrarse en el sistema'
                ],
            ],
            'dev' => [
                'nombre' => 'Instituto Profesional San Sebastián',
                'url' => 'https://www.ipss.cl',
                'logo' => 'https://ipss.cl/wp-content/uploads/2025/04/cropped-LogoIPSS_sello50anos_webipss.png'
            ],
            'user' => $user
        ];

        return view('backoffice/users/security', [
            'datos' => $datos,
            'user' => $user
        ]);
    }

    public function cambiarClave(Request $_request)
    {
        if (!Auth::check()) {
            // Verifica si el el usuario ya está autenticado
            return redirect()->route('/')->withErrors('Error: No tiene una sesión iniciada.');
        }

        $user = Auth::user();

        $_request->validate([
            'pass_actual' => ['required'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ], $this->messages);

        if (Hash::check($_request->pass_actual, $user->password)) {
            $user->password = Hash::make($_request->password);
            $user->save();
            return redirect()->route('backoffice.user.security')->with('success', 'Contraseña cambiada exitosamente.');
        } else {
            return redirect()->route('backoffice.user.security')->withErrors('Error: Contraseña actual incorrecta.');
        }
    }

    public function index()
    {
        if (!Auth::check()) {
            // Verifica si el usuario NO está autenticado
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }
        $user = Auth::user();
        $lista = User::with('roles', 'permissions', 'cargo')->get();
        $roles = Role::all();

        $listaGenero = GeneroModel::all()->where('activo', 1);
        $listaCargos = CargosModel::all()->where('activo', 1);
        $listaNacionalidades = NacionalidadModel::all()->where('activo', 1);
        $listaPosiciones = PosicionModel::all()->where('activo', 1);

        $datos = [
            'textos' => [
                'titulo' => 'Usuarios | Sonkei FC',
                'logo' => '/assets/imgs/logo_sonkei_v2.webp',
                'nombre' => 'Sonkei FC',
                'formulario' => [
                    'titulo' => 'Bienvenido a Sonkei FC ⚽️',
                    'instruccion' => 'Ingrese Credenciales'
                ],
            ],
            'mantenedor' => [
                'titulo' => 'Usuarios del Sistema',
                'instruccion' => 'Los usuarios del sistema...',
                'routes' => [
                    'new' => 'backoffice.users.new',
                    'update' => 'backoffice.users.update',
                    'up' => 'backoffice.users.up',
                    'down' => 'backoffice.users.down',
                    'delete' => 'backoffice.users.destroy',
                ],
                'fields' => [
                    //rut
                    [
                        'label' => 'RUT (Nombre de usuario)',
                        'name' => 'rut',
                        'required' => true,
                        'control' => [
                            'element' => 'input',
                            'type' => 'text',
                            'classList' => [
                                'form-control',
                                'mb-4'
                            ],
                            'min' => 8,
                            'max' => 10,
                            'placeholder' => 'Ingrese el RUT (ej: 12.123.123-4)'
                        ],
                        'access' => [
                            'editableIn' => [
                                'new' => true,
                                'edit' => false,
                                'show' => false,
                                'up' => false,
                                'down' => false,
                                'delete' => false
                            ],
                            'readIn' => [
                                'new' => true,
                                'edit' => true,
                                'show' => true,
                                'up' => true,
                                'down' => true,
                                'delete' => true
                            ]
                        ]
                    ],
                    //nombre
                    [
                        'label' => 'Nombre',
                        'name' => 'nombre',
                        'required' => true,
                        'control' => [
                            'element' => 'input',
                            'type' => 'text',
                            'classList' => [
                                'form-control',
                                'mb-4',
                            ],
                            'min' => 3,
                            'max' => 50,
                            'placeholder' => 'Ingrese Nombre'
                        ],
                        'access' => [
                            'editableIn' => [
                                'new' => true,
                                'edit' => true,
                                'show' => false,
                                'up' => false,
                                'down' => false,
                                'delete' => false
                            ],
                            'readIn' => [
                                'new' => true,
                                'edit' => true,
                                'show' => true,
                                'up' => true,
                                'down' => true,
                                'delete' => true
                            ]
                        ]
                    ],
                    //apellido
                    [
                        'label' => 'Apellido',
                        'name' => 'apellido',
                        'required' => true,
                        'control' => [
                            'element' => 'input',
                            'type' => 'text',
                            'classList' => [
                                'form-control',
                                'mb-4',
                            ],
                            'min' => 3,
                            'max' => 50,
                            'placeholder' => 'Ingrese Apellido'
                        ],
                        'access' => [
                            'editableIn' => [
                                'new' => true,
                                'edit' => true,
                                'show' => false,
                                'up' => false,
                                'down' => false,
                                'delete' => false
                            ],
                            'readIn' => [
                                'new' => true,
                                'edit' => true,
                                'show' => true,
                                'up' => true,
                                'down' => true,
                                'delete' => true
                            ]
                        ]
                    ],
                    //fecha de nacimiento
                    [
                        'label' => 'Fecha de Nacimiento',
                        'name' => 'nacimiento',
                        'required' => true,
                        'control' => [
                            'element' => 'input',
                            'type' => 'date',
                            'classList' => [
                                'form-control',
                                'mb-4',
                            ],
                            'min' => 3,
                            'max' => 50,
                            'placeholder' => 'Ingrese Apellido'
                        ],
                        'access' => [
                            'editableIn' => [
                                'new' => true,
                                'edit' => true,
                                'show' => false,
                                'up' => false,
                                'down' => false,
                                'delete' => false
                            ],
                            'readIn' => [
                                'new' => true,
                                'edit' => true,
                                'show' => true,
                                'up' => true,
                                'down' => true,
                                'delete' => true
                            ]
                        ]
                    ],
                    //genero
                    [
                        'label' => 'Género',
                        'name' => 'generoId',
                        'required' => true,
                        'control' => [
                            'element' => 'select',
                            'options' => $listaGenero,
                            'type' => 'simple',
                            'classList' => [
                                'form-select',
                                'mb-4',
                            ],
                        ],
                        'access' => [
                            'editableIn' => [
                                'new' => true,
                                'edit' => true,
                                'show' => false,
                                'up' => false,
                                'down' => false,
                                'delete' => false
                            ],
                            'readIn' => [
                                'new' => true,
                                'edit' => true,
                                'show' => true,
                                'up' => true,
                                'down' => true,
                                'delete' => true
                            ]
                        ]
                    ],
                    //cargo
                    [
                        'label' => 'Cargo',
                        'name' => 'cargoId',
                        'required' => true,
                        'control' => [
                            'element' => 'select',
                            'options' => $listaCargos,
                            'type' => 'simple',
                            'classList' => [
                                'form-select',
                                'mb-4',
                            ],
                        ],
                        'access' => [
                            'editableIn' => [
                                'new' => true,
                                'edit' => true,
                                'show' => false,
                                'up' => false,
                                'down' => false,
                                'delete' => false
                            ],
                            'readIn' => [
                                'new' => true,
                                'edit' => true,
                                'show' => true,
                                'up' => true,
                                'down' => true,
                                'delete' => true
                            ]
                        ]
                    ],
                    //nacionalidad
                    [
                        'label' => 'Nacionalidad',
                        'name' => 'nacionalidadIds',
                        'required' => true,
                        'control' => [
                            'element' => 'select',
                            'options' => $listaNacionalidades,
                            'type' => 'multiple',
                            'classList' => [
                                'form-select',
                                'mb-4',
                            ],
                        ],
                        'access' => [
                            'editableIn' => [
                                'new' => true,
                                'edit' => true,
                                'show' => false,
                                'up' => false,
                                'down' => false,
                                'delete' => false
                            ],
                            'readIn' => [
                                'new' => true,
                                'edit' => true,
                                'show' => true,
                                'up' => true,
                                'down' => true,
                                'delete' => true
                            ]
                        ]
                    ],
                    //posiciones de juego
                    [
                        'label' => 'Posiciones de Juego',
                        'name' => 'posicionesIds',
                        'required' => true,
                        'control' => [
                            'element' => 'select',
                            'options' => $listaPosiciones,
                            'type' => 'multiple',
                            'classList' => [
                                'form-select',
                                'mb-4',
                            ],
                        ],
                        'access' => [
                            'editableIn' => [
                                'new' => true,
                                'edit' => true,
                                'show' => false,
                                'up' => false,
                                'down' => false,
                                'delete' => false
                            ],
                            'readIn' => [
                                'new' => true,
                                'edit' => true,
                                'show' => true,
                                'up' => true,
                                'down' => true,
                                'delete' => true
                            ]
                        ]
                    ],
                ],
                'has_roles' => true, // Se agrega para pasarle el rol que tiene el usuario a la vista
            ],
            'dev' => [
                'nombre' => 'Instituto Profesional San Sebastián',
                'url' => 'https://www.ipss.cl',
                'logo' => 'https://ipss.cl/wp-content/uploads/2025/04/cropped-LogoIPSS_sello50anos_webipss.png'
            ]
        ];
        return view('backoffice/users/index', [
            'datos' => $datos,
            'user' => $user,
            'lista' => $lista,
            'roles' => $roles
        ]);
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            // Verifica si el usuario NO está autenticado
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }
        $user = Auth::user();

        $request->validate([
            'rut' => ['required', 'string', 'min:8', 'max:10'],
            'nombre' => ['required', 'string', 'min:3', 'max:50'],
            'apellido' => ['required', 'string', 'min:3', 'max:50'],
            'nacimiento' => ['required', 'date'],
            'generoId' => ['required', 'integer'],
            'cargoId' => ['required', 'integer'],
            //'nacionalidadIds' => ['required', 'array'],
            //'posicionesIds' => ['required', 'array'],
        ], $this->messages);


        // dd($request->all());

        $nuevo = User::create([
            'rut' => $request->rut,
            'name' => $request->nombre,
            'lastname' => $request->apellido,
            'fechaNacimiento' => $request->nacimiento,
            'generoId' => $request->generoId,
            'cargoId' => $request->cargoId,
            // 'nacionalidadIds' => $request->nacionalidadIds,
            // 'posicionesIds' => $request->posicionesIds,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Asignar el rol, en base al cargo elegido en el formulario de creacion de usuario
        // Buscar el cargo elegido
        $cargo = CargosModel::find($request->cargoId);

        if ($cargo) {
            $rolName = strtolower($cargo->nombre);
            $rol = Role::where('name', $rolName)->first();

            if ($rol) {
                $nuevo->assignRole($rol); // asigna rol según cargo
            } else {
                // Si no existe rol según cargo, asigna "jugador" por defecto
                $rolJugador = Role::where('name', 'jugador')->first();
                if ($rolJugador) {
                    $nuevo->assignRole($rolJugador);
                }
            }
        }

        return redirect()->back()->with('success', ':) Usuario creado exitosamente.');
    }
}
~~~

### 8) Modificacion pequeña del seeder de roles (luego de los foreach de los permisos de los roles):
~~~
// Obtener los cargos creados
        $cargoEntrenador = DB::table('cargos')->where('nombre', 'Entrenador')->first();
        $cargoJugador = DB::table('cargos')->where('nombre', 'Jugador')->first();

        // Crear usuarios de prueba
        $adminUser = User::firstOrCreate(
            ['rut' => '12345678-9'],
            [
                'name' => 'Sebastián',
                'lastname' => 'Cabezas',
                'password' => Hash::make('holaMundo'),
                'fechaNacimiento' => '1987-06-08',
                'generoId' => 2,
                'cargoId' => $cargoEntrenador->id, // Admin será entrenador
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]
        );

        $jugadorUser = User::firstOrCreate(
            ['rut' => '21176572-0'],
            [
                'name' => 'Ethan',
                'lastname' => 'Mayorines',
                'password' => Hash::make('holaMundo'),
                'fechaNacimiento' => '1987-06-08',
                'generoId' => 2,
                'cargoId' => $cargoJugador->id, // Jugador
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]
        );

        $entrenadorUser = User::firstOrCreate(
            ['rut' => '20954121-1'],
            [
                'name' => 'Martina',
                'lastname' => 'Antilef',
                'password' => Hash::make('holaMundo'),
                'fechaNacimiento' => '1987-06-08',
                'generoId' => 2,
                'cargoId' => $cargoEntrenador->id, // Entrenador
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]
        );
~~~

### 9) Agregar la ruta para actualizar los medios de contacto
~~~
// Ruta para actualizar datos personales del usuario
Route::put('/backoffice/user/contact', [UserController::class, 'updateContacto'])
    ->name('backoffice.user.contact.update');
~~~

### 10) Modificar vistas de perfil, contacto y header

- Vista backoffice/users/profile.blade.php
~~~
<!doctype html>

<html lang="en" class="layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-skin="default"
    data-assets-path="/vuexy/assets/" data-template="vertical-menu-template" data-bs-theme="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Demo: User Profile - Profile | Vuexy - Bootstrap Dashboard PRO</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/vuexy/assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="/vuexy/assets/vendor/fonts/iconify-icons.css" />

    <!-- Core CSS -->
    <!-- build:css assets/vendor/css/theme.css  -->

    <link rel="stylesheet" href="/vuexy/assets/vendor/libs/node-waves/node-waves.css" />

    <link rel="stylesheet" href="/vuexy/assets/vendor/libs/pickr/pickr-themes.css" />

    <link rel="stylesheet" href="/vuexy/assets/vendor/css/core.css" />
    <link rel="stylesheet" href="/vuexy/assets/css/demo.css" />

    <!-- Vendors CSS -->

    <link rel="stylesheet" href="/vuexy/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- endbuild -->

    <link rel="stylesheet" href="/vuexy/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
    <link rel="stylesheet" href="/vuexy/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="/vuexy/assets/vendor/css/pages/page-profile.css" />

    <!-- Helpers -->
    <script src="/vuexy/assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="/vuexy/assets/vendor/js/template-customizer.js"></script>

    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->

    <script src="/vuexy/assets/js/config.js"></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            @include('backoffice/_partials/aside')

            <div class="menu-mobile-toggler d-xl-none rounded-1">
                <a href="javascript:void(0);"
                    class="layout-menu-toggle menu-link text-large text-bg-secondary p-2 rounded-1">
                    <i class="ti tabler-menu icon-base"></i>
                    <i class="ti tabler-chevron-right icon-base"></i>
                </a>
            </div>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <nav class="layout-navbar container-xxl navbar-detached navbar navbar-expand-xl align-items-center bg-navbar-theme"
                    id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
                            <i class="icon-base ti tabler-menu-2 icon-md"></i>
                        </a>
                    </div>

                    @include('backoffice/_partials/topbar')
                </nav>

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <!-- Header -->
                        @include('backoffice/users/_partials/header')
                        <!--/ Header -->

                        <!-- Navbar pills -->
                        @include('backoffice/users/_partials/menu')
                        <!--/ Navbar pills -->

                        <!-- User Profile Content -->
                        <div class="row">
                            <div class="col-xl-4 col-lg-5 col-md-5">
                                <!-- About User -->
                                <div class="card mb-6">
                                    <div class="card-body">
                                        <p class="card-text text-uppercase text-body-secondary small mb-0">Datos Personales</p>
                                        <ul class="list-unstyled my-3 py-1">


                                            <li class="d-flex align-items-center mb-4">
                                                <i class="icon-base ti tabler-user icon-lg"></i><span
                                                    class="fw-medium mx-2">Nombre:</span> <span>{{ $user->name }}
                                                    {{ $user->lastname }}</span>
                                            </li>

                                            {{-- ASI SE ACCEDE AL NOMBRE DEL ROL --}}
                                            <li class="d-flex align-items-center mb-4">
                                                <i class="icon-base ti tabler-crown icon-lg"></i><span
                                                    class="fw-medium mx-2">Rol:</span>
                                                <span>{{ auth()->user()->getRoleNames()->first() ?? 'Sin rol' }}</span>
                                            </li>

                                            <li class="d-flex align-items-center mb-4">
                                                <i class="icon-base ti tabler-check icon-lg"></i><span
                                                    class="fw-medium mx-2">Estado:</span>
                                                <span
                                                    class="text-{{ $user->activo == 1 ? 'success' : 'danger' }}">{{ $user->activo == 1 ? 'Activo' : 'Inactivo' }}</span>
                                            </li>

                                            <!-- Género -->
                                            <li class="d-flex align-items-center mb-4">
                                                <i class="icon-base ti tabler-user icon-lg"></i>
                                                <span class="fw-medium mx-2">Género:</span>
                                                <span>{{ $user->genero->nombre ?? 'Sin asignar' }}</span>
                                            </li>

                                            <!-- Nacionalidad -->
                                            <li class="d-flex align-items-center mb-4">
                                                <i class="icon-base ti tabler-flag icon-lg"></i>
                                                <span class="fw-medium mx-2">Nacionalidad:</span>
                                                <span>{{ $user->nacionalidad->nombre ?? 'Sin asignar' }}</span>
                                            </li>

                                            <!-- Fecha de nacimiento -->
                                            <li class="d-flex align-items-center mb-4">
                                                <i class="icon-base ti tabler-calendar icon-lg"></i>
                                                <span class="fw-medium mx-2">Fecha de nacimiento:</span>
                                                <span>{{ $user->fechaNacimiento ? \Carbon\Carbon::parse($user->fechaNacimiento)->format('d-m-Y') : 'Sin asignar' }}</span>
                                            </li>

                                            <!-- Cargo -->
                                            <li class="d-flex align-items-center mb-4">
                                                <i class="icon-base ti tabler-briefcase icon-lg"></i>
                                                <span class="fw-medium mx-2">Cargo:</span>
                                                <span>{{ $user->cargo->nombre ?? 'Sin asignar' }}</span>
                                            </li>

                                            <!-- Oficio -->
                                            <li class="d-flex align-items-center mb-4">
                                                <i class="icon-base ti tabler-tools icon-lg"></i>
                                                <span class="fw-medium mx-2">Oficio:</span>
                                                <span>{{ $user->oficio->nombre ?? 'Sin asignar' }}</span>
                                            </li>


                                            <!-- Pierna dominante -->
                                            <li class="d-flex align-items-center mb-4">
                                                <i class="icon-base ti tabler-shape icon-lg"></i>
                                                <span class="fw-medium mx-2">Pierna dominante:</span>
                                                <span>{{ $user->piernaDominante->nombre ?? 'Sin asignar' }}</span>
                                            </li>

                                        </ul>

                                        <!-- Medios de contacto -->
                                        <p class="card-text text-uppercase text-body-secondary small mb-0">Medios de contacto</p>
                                        <ul class="list-unstyled my-3 py-1">
                                            @if($user->mediosDeContactoVisibles->isEmpty())
                                                <li class="d-flex align-items-center mb-4">
                                                    <i class="icon-base ti tabler-info-circle icon-lg"></i>
                                                    <span class="text-muted fst-italic">No definido por el momento</span>
                                                </li>
                                                <li class="mb-3">
                                                    <a href="{{ route('backoffice.user.contact') }}" class="btn btn-sm btn-primary">
                                                        <i class="icon-base ti tabler-users icon-sm me-1_5"></i> Agregar medio de contacto
                                                    </a>
                                                </li>
                                            @else
                                                @foreach ($user->mediosDeContactoVisibles as $contacto)
                                                    @php
                                                        $tipo = strtolower($contacto->nombre ?? 'otro');
                                                        $icon = match ($tipo) {
                                                            'telefono' => 'ti tabler-phone-call',
                                                            'wsp', 'whatsapp' => 'ti tabler-brand-whatsapp',
                                                            'email' => 'ti tabler-mail',
                                                            'skype' => 'ti tabler-messages',
                                                            'twitter' => 'ti tabler-brand-twitter',
                                                            default => 'ti tabler-info-circle',
                                                        };
                                                    @endphp
                                                    <li class="d-flex align-items-center mb-4">
                                                        <i class="icon-base {{ $icon }} icon-lg"></i>
                                                        <span class="fw-medium mx-2">{{ $contacto->nombre }}:</span>
                                                        <span>{{ $contacto->pivot->valor }}</span>
                                                    </li>
                                                @endforeach
                                            @endif
                                        </ul>

                                    </div>
                                </div>
                                <!--/ About User -->
                            </div>
                            <div class="col-xl-8 col-lg-7 col-md-7">
                                <!-- Activity Timeline -->
                                <div class="card card-action mb-6">
                                    <div class="card-header align-items-center">
                                        <h5 class="card-action-title mb-0">
                                            <i class="icon-base ti tabler-chart-bar-popular icon-lg me-4"></i>Activity
                                            Timeline
                                        </h5>
                                        <div class="card-action-element">
                                            <div class="dropdown">
                                                <button type="button"
                                                    class="btn dropdown-toggle hide-arrow p-0 text-body-secondary"
                                                    data-bs-toggle="dropdown" aria-expanded="false"></button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item" href="javascript:void(0);">Share
                                                            timeline</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);">Suggest
                                                            edits</a></li>
                                                    <li>
                                                        <hr class="dropdown-divider" />
                                                    </li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);">Report
                                                            bug</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body pt-3">
                                        <ul class="timeline mb-0">
                                            <li class="timeline-item timeline-item-transparent">
                                                <span class="timeline-point timeline-point-primary"></span>
                                                <div class="timeline-event">
                                                    <div class="timeline-header mb-3">
                                                        <h6 class="mb-0">12 Invoices have been paid</h6>
                                                        <small class="text-body-secondary">12 min ago</small>
                                                    </div>
                                                    <p class="mb-2">Invoices have been paid to the company</p>
                                                    <div class="d-flex align-items-center mb-2">
                                                        <div
                                                            class="badge bg-lighter rounded d-flex align-items-center">
                                                            <img src="/vuexy/assets//img/icons/misc/pdf.png"
                                                                alt="img" width="15" class="me-2" />
                                                            <span class="h6 mb-0 text-body">invoices.pdf</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="timeline-item timeline-item-transparent">
                                                <span class="timeline-point timeline-point-success"></span>
                                                <div class="timeline-event">
                                                    <div class="timeline-header mb-3">
                                                        <h6 class="mb-0">Client Meeting</h6>
                                                        <small class="text-body-secondary">45 min ago</small>
                                                    </div>
                                                    <p class="mb-2">Project meeting with john @10:15am</p>
                                                    <div class="d-flex justify-content-between flex-wrap gap-2 mb-2">
                                                        <div class="d-flex flex-wrap align-items-center mb-50">
                                                            <div class="avatar avatar-sm me-2">
                                                                <img src="/vuexy/assets/img/avatars/1.png"
                                                                    alt="Avatar" class="rounded-circle" />
                                                            </div>
                                                            <div>
                                                                <p class="mb-0 small fw-medium">Lester McCarthy
                                                                    (Client)</p>
                                                                <small>CEO of Pixinvent</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="timeline-item timeline-item-transparent">
                                                <span class="timeline-point timeline-point-info"></span>
                                                <div class="timeline-event">
                                                    <div class="timeline-header mb-3">
                                                        <h6 class="mb-0">Create a new project for client</h6>
                                                        <small class="text-body-secondary">2 Day Ago</small>
                                                    </div>
                                                    <p class="mb-2">6 team members in a project</p>
                                                    <ul class="list-group list-group-flush">
                                                        <li
                                                            class="list-group-item d-flex justify-content-between align-items-center flex-wrap border-top-0 p-0">
                                                            <div class="d-flex flex-wrap align-items-center">
                                                                <ul
                                                                    class="list-unstyled users-list d-flex align-items-center avatar-group m-0 me-2">
                                                                    <li data-bs-toggle="tooltip"
                                                                        data-popup="tooltip-custom"
                                                                        data-bs-placement="top" title="Vinnie Mostowy"
                                                                        class="avatar pull-up">
                                                                        <img class="rounded-circle"
                                                                            src="/vuexy/assets/img/avatars/1.png"
                                                                            alt="Avatar" />
                                                                    </li>
                                                                    <li data-bs-toggle="tooltip"
                                                                        data-popup="tooltip-custom"
                                                                        data-bs-placement="top" title="Allen Rieske"
                                                                        class="avatar pull-up">
                                                                        <img class="rounded-circle"
                                                                            src="/vuexy/assets/img/avatars/4.png"
                                                                            alt="Avatar" />
                                                                    </li>
                                                                    <li data-bs-toggle="tooltip"
                                                                        data-popup="tooltip-custom"
                                                                        data-bs-placement="top"
                                                                        title="Julee Rossignol"
                                                                        class="avatar pull-up">
                                                                        <img class="rounded-circle"
                                                                            src="/vuexy/assets/img/avatars/2.png"
                                                                            alt="Avatar" />
                                                                    </li>
                                                                    <li class="avatar">
                                                                        <span
                                                                            class="avatar-initial rounded-circle pull-up"
                                                                            data-bs-toggle="tooltip"
                                                                            data-bs-placement="bottom"
                                                                            title="3 more">+3</span>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ User Profile Content -->
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    <footer class="content-footer footer bg-footer-theme">
                        <div class="container-xxl">
                            <div
                                class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column">
                                <div class="text-body">
                                    ©
                                    <script>
                                        document.write(new Date().getFullYear());
                                    </script>
                                    , made with ❤️ by <a href="https://pixinvent.com" target="_blank"
                                        class="footer-link">Pixinvent</a>
                                </div>
                                <div class="d-none d-lg-inline-block">
                                    <a href="https://themeforest.net/licenses/standard" class="footer-link me-4"
                                        target="_blank">License</a>
                                    <a href="https://themeforest.net/user/pixinvent/portfolio" target="_blank"
                                        class="footer-link me-4">More Themes</a>

                                    <a href="https://demos.pixinvent.com/vuexy-html-admin-template/documentation/"
                                        target="_blank" class="footer-link me-4">Documentation</a>

                                    <a href="https://pixinvent.ticksy.com/" target="_blank"
                                        class="footer-link d-none d-sm-inline-block">Support</a>
                                </div>
                            </div>
                        </div>
                    </footer>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/theme.js -->

    <script src="/vuexy/assets/vendor/libs/jquery/jquery.js"></script>

    <script src="/vuexy/assets/vendor/libs/popper/popper.js"></script>
    <script src="/vuexy/assets/vendor/js/bootstrap.js"></script>
    <script src="/vuexy/assets/vendor/libs/node-waves/node-waves.js"></script>

    <script src="/vuexy/assets/vendor/libs/@algolia/autocomplete-js.js"></script>

    <script src="/vuexy/assets/vendor/libs/pickr/pickr.js"></script>

    <script src="/vuexy/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="/vuexy/assets/vendor/libs/hammer/hammer.js"></script>

    <script src="/vuexy/assets/vendor/libs/i18n/i18n.js"></script>

    <script src="/vuexy/assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="/vuexy/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>

    <!-- Main JS -->

    <script src="/vuexy/assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="/vuexy/assets/js/app-user-view-account.js"></script>
</body>

</html>
~~~

- Vista backoffice/users/contact.blade.php
~~~
<!doctype html>
<html lang="en" class="layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-skin="default"
      data-assets-path="/vuexy/assets/" data-template="vertical-menu-template" data-bs-theme="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Perfil Usuario - Contacto</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/vuexy/assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="/vuexy/assets/vendor/fonts/iconify-icons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="/vuexy/assets/vendor/libs/node-waves/node-waves.css" />
    <link rel="stylesheet" href="/vuexy/assets/vendor/libs/pickr/pickr-themes.css" />
    <link rel="stylesheet" href="/vuexy/assets/vendor/css/core.css" />
    <link rel="stylesheet" href="/vuexy/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="/vuexy/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="/vuexy/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
    <link rel="stylesheet" href="/vuexy/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="/vuexy/assets/vendor/css/pages/page-profile.css" />

    <!-- Helpers -->
    <script src="/vuexy/assets/vendor/js/helpers.js"></script>
    <script src="/vuexy/assets/vendor/js/template-customizer.js"></script>
    <script src="/vuexy/assets/js/config.js"></script>
</head>

<body>
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Menu -->
        @include('backoffice/_partials/aside')

        <div class="menu-mobile-toggler d-xl-none rounded-1">
            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large text-bg-secondary p-2 rounded-1">
                <i class="ti tabler-menu icon-base"></i>
                <i class="ti tabler-chevron-right icon-base"></i>
            </a>
        </div>

        <!-- Layout container -->
        <div class="layout-page">
            <!-- Navbar -->
            <nav class="layout-navbar container-xxl navbar-detached navbar navbar-expand-xl align-items-center bg-navbar-theme"
                 id="layout-navbar">
                <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                    <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
                        <i class="icon-base ti tabler-menu-2 icon-md"></i>
                    </a>
                </div>
                @include('backoffice/_partials/topbar')
            </nav>
            <!-- / Navbar -->

            <!-- Content wrapper -->
            <div class="content-wrapper">
                <div class="container-xxl flex-grow-1 container-p-y">
                    @include('backoffice/users/_partials/header')
                    @include('backoffice/users/_partials/menu')
                    @include('backoffice/_partials/messages')

                    <div class="row">
                        <div class="col-12">
                            <div class="card mb-6">
                                <div class="card-body">
                                    <p class="card-text text-uppercase text-body-secondary small mb-4 fs-5">
                                        Cambio de datos personales
                                    </p>

                                    <form action="{{ route('backoffice.user.contact.update') }}" method="post">
                                        @csrf
                                        @method('PUT')

                                        {{-- Género --}}
                                        <div class="mb-4 border border-3 rounded p-3 position-relative">
                                            <label class="form-label fw-bold fs-5">Género</label>
                                            <select name="generoId" class="form-control mb-1 {{ $user->generoId ? 'bg-info bg-opacity-10' : '' }}">
                                                <option value="">Seleccione...</option>
                                                @foreach ($generos as $genero)
                                                    <option value="{{ $genero->id }}" {{ $user->generoId == $genero->id ? 'selected' : '' }}>
                                                        {{ $genero->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <small class="text-muted d-block mb-3">
                                                {!! $user->generoId ? 'Valor guardado, <strong>puede modificarlo si desea.</strong>' : 'Seleccione su género.' !!}
                                            </small>
                                        </div>

                                        {{-- Oficio --}}
                                        <div class="mb-4 border border-3 rounded p-3 position-relative">
                                            <label class="form-label fw-bold fs-5">Oficio</label>
                                            <select name="oficioId" class="form-control mb-1 {{ $user->oficioId ? 'bg-info bg-opacity-10' : '' }}">
                                                <option value="">Seleccione...</option>
                                                @foreach ($oficios as $oficio)
                                                    <option value="{{ $oficio->id }}" {{ $user->oficioId == $oficio->id ? 'selected' : '' }}>
                                                        {{ $oficio->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <small class="text-muted d-block mb-3">
                                                {!! $user->oficioId ? 'Valor guardado, <strong>puede modificarlo si desea.</strong>' : 'Seleccione su oficio.' !!}
                                            </small>
                                        </div>

                                        {{-- Nacionalidad --}}
                                        <div class="mb-4 border border-3 rounded p-3 position-relative">
                                            <label class="form-label fw-bold fs-5">Nacionalidad</label>
                                            <select name="nacionalidadId" class="form-control mb-1 {{ $user->nacionalidadId ? 'bg-info bg-opacity-10' : '' }}">
                                                <option value="">Seleccione...</option>
                                                @foreach ($nacionalidades as $nac)
                                                    <option value="{{ $nac->id }}" {{ $user->nacionalidadId == $nac->id ? 'selected' : '' }}>
                                                        {{ $nac->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <small class="text-muted d-block mb-3">
                                                {!! $user->nacionalidadId ? 'Valor guardado, <strong>puede modificarlo si desea.</strong>' : 'Seleccione su nacionalidad.' !!}
                                            </small>
                                        </div>
                                        

                                        {{-- Comuna --}}
                                        <div class="mb-4 border border-3 rounded p-3 position-relative">
                                            <label class="form-label fw-bold fs-5">Comuna</label>
                                              <select name="comunaId" class="form-control mb-1 {{ $user->comunaId ? 'bg-info bg-opacity-10' : '' }}">
                                                  <option value="">Seleccione...</option>
                                                  @foreach ($comunas as $comuna)
                                                      <option value="{{ $comuna->id }}" {{ $user->comunaId == $comuna->id ? 'selected' : '' }}>
                                                          {{ $comuna->nombre }}
                                                      </option>
                                                  @endforeach
                                              </select>
                                              <small class="text-muted d-block mb-3">
                                                {!! $user->comunaId ? 'Valor guardado, <strong>puede modificarlo si desea.</strong>' : 'Seleccione su comuna.' !!}
                                                </small>
                                        </div>
                                        

                                        {{-- Fecha de Nacimiento --}}
                                        <div class="mb-4 border border-3 rounded p-3 position-relative">
                                            <label class="form-label fw-bold fs-5">Fecha de Nacimiento</label>
                                            @php
                                                $fecha = old('nacimiento', $user->fechaNacimiento ? $user->fechaNacimiento->format('Y-m-d') : '');
                                            @endphp
                                            <input type="date" name="nacimiento"
                                                  value="{{ $fecha }}"
                                                  class="form-control mb-1 {{ $user->fechaNacimiento ? 'bg-info bg-opacity-10' : '' }}">
                                            <small class="text-muted d-block mb-3">
                                                    {!! $user->fechaNacimiento ? 'Valor guardado, <strong>puede modificarlo si desea.</strong>' : 'Ingrese su fecha de nacimiento.' !!}
                                            </small>
                                        </div>
                                            

                                        {{-- Pierna Dominante --}}
                                        <div class="mb-4 border border-3 rounded p-3 position-relative">
                                            <label class="form-label fw-bold fs-5">Pierna Dominante</label>
                                            <select name="piernaDominanteId" class="form-control mb-1 {{ $user->piernaDominanteId ? 'bg-info bg-opacity-10' : '' }}">
                                                <option value="">Seleccione...</option>
                                                @foreach ($piernas as $pierna)
                                                    <option value="{{ $pierna->id }}" {{ $user->piernaDominanteId == $pierna->id ? 'selected' : '' }}>
                                                        {{ $pierna->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <small class="text-muted d-block mb-3">
                                                {!! $user->piernaDominanteId ? 'Valor guardado, <strong>puede modificarlo si desea.</strong>' : 'Seleccione su pierna dominante.' !!}
                                            </small>   
                                        </div>                                     

                                        {{-- Medios de Contacto --}}
                                        <br>
                                        <h5 class="fw-bold mt-4 mb-3">Medios de Contacto</h5>
                                        <div id="medios-contacto">
                                            @foreach ($medios as $medio)
                                                @php
                                                    $pivot = $user->mediosDeContacto->where('id', $medio->id)->first()?->pivot;
                                                    $valor = $pivot->valor ?? '';
                                                    $visible = $pivot->visible ?? true; // por defecto visible
                                                @endphp
                                        
                                                <div class="mb-4 border border-3 rounded p-3 position-relative" id="medio-{{ $medio->id }}">

                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <label class="form-label fw-bold fs-5">{{ $medio->nombre }}</label>
                                        
                                                        {{-- Botón eliminar --}}
                                                        {{-- Mostrar botón "No agregar" solo si no hay valor guardado --}}
                                                        @if(!$valor)
                                                        <button type="button" class="btn btn-sm btn-danger"
                                                                onclick="document.getElementById('medio-{{ $medio->id }}').remove();">
                                                            <span class="iconify" data-icon="tabler-trash" data-inline="false"></span> No agregar
                                                        </button>
                                                        @endif
                                                    </div>
                                        
                                                    {{-- Campo de valor --}}
                                                    <input type="text"
                                                           name="medios[{{ $medio->id }}]"
                                                           value="{{ old('medios.' . $medio->id, $valor) }}"
                                                           class="form-control mb-2 {{ $valor ? 'bg-info bg-opacity-10' : '' }}"
                                                           placeholder="Ingrese {{ strtolower($medio->nombre) }}">
                                        
                                                    {{-- Checkbox de visibilidad --}}
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox"
                                                               id="visible-{{ $medio->id }}"
                                                               name="medios_visible[{{ $medio->id }}]"
                                                               value="1" {{ $visible ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="visible-{{ $medio->id }}">
                                                            Visible para otros usuarios
                                                        </label>
                                                    </div>
                                        
                                                    <small class="text-muted d-block mt-1">
                                                        {!! $valor ? 'Valor guardado, <strong>puede modificarlo si desea.</strong>' : 'Ingrese su ' . strtolower($medio->nombre) !!}
                                                    </small>                                                    
                                                </div>
                                            @endforeach
                                        </div>


                                        <button type="submit" class="btn btn-primary mt-2">
                                            <i class="menu-icon icon-base ti tabler-check"></i> Guardar Cambios
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- / Content -->

                <!-- Footer -->
                <footer class="content-footer footer bg-footer-theme">
                    <div class="container-xxl">
                        <div class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column">
                            <div class="text-body">
                                © <script>document.write(new Date().getFullYear());</script>, hecho con ❤️
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- / Footer -->
                <div class="content-backdrop fade"></div>
            </div>
            <!-- / Content wrapper -->
        </div>
        <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
    <div class="drag-target"></div>
</div>
<!-- / Layout wrapper -->

<!-- Core JS -->
<script src="/vuexy/assets/vendor/libs/jquery/jquery.js"></script>
<script src="/vuexy/assets/vendor/libs/popper/popper.js"></script>
<script src="/vuexy/assets/vendor/js/bootstrap.js"></script>
<script src="/vuexy/assets/vendor/libs/node-waves/node-waves.js"></script>
<script src="/vuexy/assets/vendor/libs/@algolia/autocomplete-js.js"></script>
<script src="/vuexy/assets/vendor/libs/pickr/pickr.js"></script>
<script src="/vuexy/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="/vuexy/assets/vendor/libs/hammer/hammer.js"></script>
<script src="/vuexy/assets/vendor/libs/i18n/i18n.js"></script>
<script src="/vuexy/assets/vendor/js/menu.js"></script>

<!-- Vendors JS -->
<script src="/vuexy/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>

<!-- Main JS -->
<script src="/vuexy/assets/js/main.js"></script>
<script src="/vuexy/assets/js/app-user-view-account.js"></script>
</body>
</html>
~~~

- Vista users/_partials/header.blade.php
~~~
<div class="row">
                <div class="col-12">
                  <div class="card mb-6">
                    <div class="user-profile-header-banner">
                      <img src="/vuexy/assets/img/pages/profile-banner.png" alt="Banner image" class="rounded-top" />
                    </div>
                    <div class="user-profile-header d-flex flex-column flex-lg-row text-sm-start text-center mb-5">
                      <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                        <img
                          src="/vuexy/assets/img/avatars/1.png"
                          alt="user image"
                          class="d-block h-auto ms-0 ms-sm-6 rounded user-profile-img" />
                      </div>
                      <div class="flex-grow-1 mt-3 mt-lg-5">
                        <div
                          class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-5 flex-md-row flex-column gap-4">
                          <div class="user-profile-info">
                            <h4 class="mb-2 mt-lg-6">{{ $user->name }} {{ $user->lastname }}</h4>
                            <ul
                              class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-4 my-2">
                              <li class="list-inline-item d-flex gap-2 align-items-center">
                                <i class="icon-base ti tabler-palette icon-lg"></i
                                ><span class="fw-medium">{{ $user->cargo->nombre ?? 'Sin asignar' }}</span>
                              </li>
                              <li class="list-inline-item d-flex gap-2 align-items-center">
                                <i class="icon-base ti tabler-map-pin icon-lg"></i
                                ><span class="fw-medium">{{ $user->comuna->nombre ?? 'Sin asignar' }}</span>
                              </li>
                              <li class="list-inline-item d-flex gap-2 align-items-center">
                                <i class="icon-base ti tabler-calendar icon-lg"></i
                                ><span class="fw-medium">Registrado el: {{  $user->created_at->format('d/m/Y')  }}</span>
                              </li>
                            </ul>
                          </div>
                          <a href="javascript:void(0)" class="btn btn-primary mb-1">
                            <i class="icon-base ti tabler-user-check icon-xs me-2"></i>Connected
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
~~~
