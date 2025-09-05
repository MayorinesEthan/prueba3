# Documentacion proceso permisos de usuario.

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
$rolAdmin = $role =  Role::firstOrCreate(['name' => 'admin']);
        $rolJugador = $role =  Role::firstOrCreate(['name' => 'jugador']);
        $rolEntrenador = $role =  Role::firstOrCreate(['name' => 'entrenador']);

        $adminPermissions = [
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'user-activate',
            'rol-list',
            'rol-create',
            'rol-edit',
            'rol-delete',
            'producto-list',
            'producto-create',
            'producto-edit',
            'producto-delete',
            'pedido-list',
            'pedido-anulate',
            'cargos-list',
            'cargos-create',
            'cargos-edit',
            'cargos-delete',
            'comunas-list',
            'comunas-create',
            'comunas-edit',
            'comunas-delete',
            'generos-list',
            'generos-create',
            'generos-edit',
            'generos-delete',
            'oficios-list',
            'oficios-create',
            'oficios-edit',
            'oficios-delete',
            'posiciones-list',
            'posiciones-create',
            'posiciones-edit',
            'posiciones-delete',
            'premios-list',
            'premios-create',
            'premios-edit',
            'premios-delete',
            'categorias-list',
            'categorias-create',
            'categorias-edit',
            'categorias-delete',
            'mediospagos-list',
            'mediospagos-create',
            'mediospagos-edit',
            'mediospagos-delete',
            'recintos-list',
            'recintos-create',
            'recintos-edit',
            'recintos-delete',
            'camisetas-list',
            'camisetas-create',
            'camisetas-edit',
            'camisetas-delete',
            'campeonato-list',
            'campeonato-create',
            'campeonato-edit',
            'campeonato-delete',
            'diassemana-list',
            'diassemana-create',
            'diassemana-edit',
            'diassemana-delete',
            'piernadominante-list',
            'piernadominante-create',
            'piernadominante-edit',
            'piernadominante-delete',
            'hora-inicio-list',
            'hora-inicio-create',
            'hora-inicio-edit',
            'hora-inicio-delete',
            'hora-fin-list',
            'hora-fin-create',
            'hora-fin-edit',
            'hora-fin-delete',
            'mediocontacto-list',
            'mediocontacto-create',
            'mediocontacto-edit',
            'mediocontacto-delete',
            'nacionalidad-list',
            'nacionalidad-create',
            'nacionalidad-edit',
            'nacionalidad-delete'
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
            ['rut' => '19704556-6'],
            [
                'rut' => '12345678-9',
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

- ### 10) Crearemos una vista para la tabla de permisos y pegamos el siguiente codigo 
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
                        <!-- Botón para abrir modal de detalles -->
                        <button type="button" class="btn btn-info" data-bs-toggle="modal"
                            data-bs-target="#modalPermisos{{ $item->id }}">
                            Editar Permisos
                        </button>

                        <!-- Modal de permisos -->
                        <div class="modal fade" id="modalPermisos{{ $item->id }}" tabindex="-1"
                            aria-labelledby="modalLabel{{ $item->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <!-- Header -->
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalLabel{{ $item->id }}">
                                            Permisos del rol: {{ $item->name }}
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Cerrar"></button>
                                    </div>

                                    <!-- Form -->
                                    <form action="{{ route($datos['mantenedor']['routes']['permissions'], $item->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')

                                        <!-- Body con scroll -->
                                        <div class="modal-body" style="max-height: 60vh; overflow-y: auto;">
                                            <div class="row">
                                                @foreach ($permisos as $permiso)
                                                    <div class="col-md-4 mb-2">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                name="permissions[]" value="{{ $permiso->name }}"
                                                                id="permiso{{ $permiso->id }}_{{ $item->id }}"
                                                                @if ($item->permissions->contains('id', $permiso->id)) checked @endif />
                                                            <label class="form-check-label"
                                                                for="permiso{{ $permiso->id }}_{{ $item->id }}">
                                                                {{ $permiso->name }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        <!-- Footer fijo -->
                                        <div class="modal-footer"
                                            style="position: sticky; bottom: 0; background: white; z-index: 1000;">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </td>
                    <td class="text-center">
                        @if ($item->activo == 1)
                            <!-- Botón de Desactivar -->
                            <form action="{{ route($datos['mantenedor']['routes']['down'], $item->id) }}"
                                method="POST" class="d-inline-block">
                                @csrf
                                <button type="submit" class="btn btn-danger"
                                    onclick="this.disabled=true; this.innerHTML='<i class=\'icon-base ti tabler-loader\'></i> Procesando...'; setTimeout(() => this.form.submit(), 500);">
                                    <i class="icon-base ti tabler-arrow-down"></i> Desactivar
                                </button>
                            </form>
                        @else
                            <!-- Botón de Activar -->
                            <form action="{{ route($datos['mantenedor']['routes']['up'], $item->id) }}" method="POST"
                                class="d-inline-block">
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

        //$lista = RolesModel::all();
        $lista = RolesModel::with('permissions')->get();
        $permisos = Permission::all(); // ✅ todos los permisos

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
            'permisos' => $permisos
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

    // Sincroniza todos los permisos (botón "Guardar cambios")
    public function updatePermissions(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }

        $request->validate([
            'permissions' => 'nullable|array',
            'permissions.*' => 'string'
        ]);

        $role = Role::findOrFail($id);

        // sincroniza (quita los no marcados y agrega los marcados)
        $role->syncPermissions($request->input('permissions', []));

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
}

~~~

### 13) Aplicar sistema de Roles/Permisos en las Vistas o Controladores según se requiera

- Para aplicar Roles en las vistas Blade usar lo siguiente dependiendo de Rol:
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
        return redirect()->back()->withErrors('No tiene permiso para crear cargos.');
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


- Para aplicar validaciones de Permisos en los Controladores, usar lo siguiente:
~~~
if (auth()->user()->can('user-create')) {

} elseif (auth()->user()->can('user-list')) {
            
} else {
    // no tiene permisos para x cosa
    abort(403, 'No tienes permisos para ver x cosa.....');
}
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
