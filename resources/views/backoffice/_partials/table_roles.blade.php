<table class="datatables-users table border-top">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Estado</th>
            <th>Permisos</th> <!-- Columna de Permisos -->
            <th>Acciones</th> <!-- Columna de Acciones -->
        </tr>
    </thead>
    <tbody>
        @if (count($lista) == 0)
            <tr>
                <td colspan="5" class="text-center">Sin Registros</td> <!-- Se cambia el colspan a 5 -->
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
                        <!-- Botón de ver permisos -->
                        <button class="btn btn-info" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $item->id }}" aria-expanded="false" aria-controls="collapse{{ $item->id }}">
                            Ver permisos
                        </button>
                        <div class="collapse" id="collapse{{ $item->id }}">
                            <div class="p-3 mt-2 rounded border" style="background-color: #f8f9fa;">
                                @if (count($item->permissions) > 0)
                                    <div class="d-flex flex-wrap">
                                        @foreach ($item->permissions as $permiso)
                                            <span class="badge bg-primary text-white me-2 mb-2">
                                                {{ $permiso->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="text-muted">Este rol no tiene permisos asignados.</span>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td class="text-center">
                        @if ($item->activo == 1)
                            <!-- Botón de Desactivar -->
                            <form action="{{ route($datos['mantenedor']['routes']['down'], $item->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                <button type="submit" class="btn btn-danger" onclick="this.disabled=true; this.innerHTML='<i class=\'icon-base ti tabler-loader\'></i> Procesando...'; setTimeout(() => this.form.submit(), 500);">
                                    <i class="icon-base ti tabler-arrow-down"></i> Desactivar
                                </button>
                            </form>
                        @else
                            <!-- Botón de Activar -->
                            <form action="{{ route($datos['mantenedor']['routes']['up'], $item->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                <button type="submit" class="btn btn-primary" onclick="this.disabled=true; this.innerHTML='<i class=\'icon-base ti tabler-loader\'></i> Procesando...'; setTimeout(() => this.form.submit(), 500);">
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
