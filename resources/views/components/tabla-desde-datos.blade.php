@php
    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Facades\Schema;
    use App\Utils\TextoConstructor;

    /* @var Collection | Model $registros */
    /* @var string $tabla */
    $columnas = Schema::getColumnListing($tabla);
@endphp

<table class="table table-hover col-12">
    <thead>
    <tr>
        @foreach($columnas as $columa)
            @if(in_array($columa, ['created_at', 'updated_at', 'remember_token', 'password']))
                @continue
            @endif
            <th scope="col">{{ TextoConstructor::formatText($columa) }}</th>
        @endforeach
        <th scope="col">Acciones</th>
    </tr>
    </thead>
    <tbody>
    @if($registros instanceof Collection)
        @foreach($registros as $dato)
            <tr>
                @foreach($columnas as $columa)
                    @if(in_array($columa, ['created_at', 'updated_at', 'remember_token', 'password']))
                        @continue
                    @endif
                    <td class="text-wrap">
                        {{ $dato->$columa }}
                    </td>
                @endforeach
                <td>
                    <a href="{{route($rutaPrefijo . ".editar", ['id' => $dato->id]) }}"
                       class="btn btn-primary my-2">
                        <i class="fa-solid fa-file-pen"></i>
                        Editar
                    </a>
                    <form action="{{ route($rutaPrefijo . '.eliminar', ['id' => $dato->id]) }}" method="POST"
                          style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-warning my-2">
                            <i class="fa-solid fa-trash-can"></i>
                            Eliminar
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    @elseif($registros instanceof Model)
        <tr>
            @foreach($columnas as $columa)
                @if(in_array($columa, ['created_at', 'updated_at', 'remember_token', 'password']))
                    @continue
                @endif
                <td class="text-wrap">
                    {{ $registros->$columa }}
                </td>
            @endforeach
            <td>
                <a href="{{route($rutaPrefijo. ".editar", ['id' => $registros->id]) }}"
                   class="btn btn-primary my-2">
                    <i class="fa-solid fa-file-pen"></i>
                    Editar
                </a>
                <form action="{{ route($rutaPrefijo . '.eliminar', ['id' => $dato->id]) }}" method="POST"
                      style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-warning my-2">
                        <i class="fa-solid fa-trash-can"></i>
                        Eliminar
                    </button>
                </form>
            </td>
        </tr>
    @endif
    </tbody>
</table>
