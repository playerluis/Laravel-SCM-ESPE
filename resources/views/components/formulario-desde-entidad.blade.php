@php
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Support\Facades\DB;
    use App\Utils\TextoConstructor;

    /* @var string $tabla */
    /* @var string $rutaPrefijo */
    /* @var string $accion */

    $foreignKeys  = Schema::getConnection()
        ->getDoctrineSchemaManager()
        ->listTableForeignKeys($tabla);
@endphp

<form
    method="POST"
    action="{{ isset($registro) ?
        route($rutaPrefijo . ".actualizar", ['id'=>$registro->id]):
        route($rutaPrefijo . ".guardar")
    }}"
    class="container">
    <div class="row">
        @csrf
        @foreach(Schema::getColumnListing($tabla) as $column)

            @if(in_array($column, ['created_at', 'updated_at', 'id', 'remember_token']))
                @continue
            @endif

            @php
                $isForeignKey = false;
                $columnType = Schema::getColumnType($tabla, $column);
            @endphp

            @foreach($foreignKeys as $foreignKey)
                @if($foreignKey->getLocalColumns()[0] === $column)
                    @php
                        $isForeignKey = true;
                        $relatedTable = $foreignKey->getForeignTableName();
                        $relatedResults = DB::table($relatedTable)->get();
                    @endphp
                    @break
                @endif
            @endforeach

            <div class="form-group col-12 col-sm-6">

                <label for="{{ $column }}">{{ TextoConstructor::formatText($column) }}</label>
                {{$value = isset($registro) ? $registro->$column : '' }}

                @if($isForeignKey)
                    <select
                        id="{{ $column }}"
                        name="{{ $column }}"
                        class="form-control"
                        value="{{ $value }}"
                        required
                    >
                        @foreach($relatedResults as $row)
                            <option value="{{ $row->id }}">{{ $row->id }}</option>
                        @endforeach
                    </select>

                @elseif($columnType === 'integer' or $columnType === "bigint")
                    <input
                        type="number"
                        id="{{ $column }}"
                        name="{{ $column }}"
                        class="form-control"
                        value="{{ $value }}"
                        required
                    >
                @elseif($columnType === 'text')
                    <textarea
                        id="{{ $column }}"
                        name="{{ $column }}"
                        class="form-control"
                        value="{{ $value }}"
                        required
                    ></textarea>
                @elseif($columnType === 'boolean')
                    <select
                        id="{{ $column }}"
                        name="{{ $column }}"
                        class="form-control"
                        value="{{ $value }}"
                        required
                    >
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                @elseif($columnType === "datetime")
                    <input
                        type="datetime-local"
                        id="{{ $column }}"
                        name="{{ $column }}"
                        class="form-control"
                        value="{{ $value }}"
                        required
                    >
                @elseif($columnType === "date")
                    <input
                        type="date"
                        id="{{ $column }}"
                        name="{{ $column }}"
                        class="form-control"
                        value="{{ $value }}"
                        required
                    >
                @elseif(in_array($column, ['password', 'contraseña', 'pass']))
                    <input
                        type="password"
                        id="{{ $column }}"
                        name="{{ $column }}"
                        class="form-control"
                        value="{{ $value }}"
                        required
                    >
                @elseif(in_array($column, ['email', 'correo', 'mail']))
                    <input
                        type="email"
                        id="{{ $column }}"
                        name="{{ $column }}"
                        class="form-control"
                        value="{{ $value }}"
                        required
                    >
                @else
                    <input
                        type="text"
                        id="{{ $column }}"
                        name="{{ $column }}"
                        class="form-control"
                        value="{{ $value }}"
                        required
                    >
                @endif
            </div>
        @endforeach
    </div>
    <button type="submit" class="btn btn-primary my-2">
        @if(isset($registro))
            Actualizar
        @else
            Crear
        @endif
    </button>
</form>
