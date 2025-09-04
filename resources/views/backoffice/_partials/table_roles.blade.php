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
