<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>País de Origen</th>
            <th>Nacionalidad</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($nacionalidades as $nacionalidad)
            <tr>
                <td>{{ $nacionalidad->id }}</td>
                <td>{{ $nacionalidad->pais_origen }}</td> 
                <td>{{ $nacionalidad->nacionalidad_nombre }}</td> 
                <td class="text-center">
                        @if ($nacionalidad->activo == 1)
                            <span class="text-success">Activo</span>
                        @else
                            <span class="text-danger">Desactivado</span>
                        @endif
                    </td>
                    <td class="text-center">
{{--                         ver
                        actualizar --}}
                        @if ($item->activo == 1)
                            <form action="{{ route($datos['mantenedor']['routes']['down'], $item->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                <button type="submit" class="btn btn-danger" onclick="this.disabled=true; this.innerHTML='<i class=\'icon-base ti tabler-loader\'></i> Procesando...'; setTimeout(() => this.form.submit(), 500);">
                                    <i class="icon-base ti tabler-arrow-down"></i>
                                </button>
                            </form>
                        @endif
                        @if ($item->activo == 0)
                            <form action="{{ route($datos['mantenedor']['routes']['up'], $item->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                <button type="submit" class="btn btn-primary" onclick="this.disabled=true; this.innerHTML='<i class=\'icon-base ti tabler-loader\'></i> Procesando...'; setTimeout(() => this.form.submit(), 500);">
                                    <i class="icon-base ti tabler-arrow-up"></i>
                                </button>
                            </form>
                        @endif
                        {{-- <form action="{{ route($datos['mantenedor']['routes']['destroy'], $nacionalidad->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger"><i
                                    class="icon-base ti tabler-trash"></i></button>
                        </form> --}}
                    </td>
                </tr>
        @endforeach
    </tbody>
</table>
