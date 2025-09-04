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
