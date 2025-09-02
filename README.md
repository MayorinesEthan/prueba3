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

- Se debe hacer las importaciones de Spatie "use Spatie\Permission\Models\Permission;" y "use Spatie\Permission\Models\Role;".

### 6) Agregar el trait HasRoles.

- Tanto en el modelo de roles y users (Esto se debe hacer en todos los modelos que a futuro usen permisos).

~~~
use Spatie\Permission\Traits\HasRoles;

use HasFactory, HasRoles;
~~~


### 7)Modificar rolesController.

- En vez de tener:  
~~~
$lista = RolesModel::all();
~~~
 Se debe tener: 
 ~~~
$lista = RolesModel::with('permissions')->get();
 ~~~

### 8) Realizar migraciones.
- Primero por seguridad realizar:
~~~
php artisan migrate:fresh
~~~

- Si usted *TIENE* seeders en su proyecto debe usar el comando:
~~~
 php artisan migrate:fresh --seed
 ~~~

### 9) Modificar la tabla roles creada por laravel permissions.

- Buscar la tabla roles dentro del archivo y agregar lo siguiente despues del campo "guard_name":
~~~
$table->boolean('activo')->default(true);
~~~

- Despues de esto se debe realizar nuevamente el paso 8.
