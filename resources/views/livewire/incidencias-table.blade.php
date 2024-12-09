<div>
    <h2>Incidencias</h2>

    <form wire:submit.prevent="{{ $editMode ? 'update' : 'store' }}">
        <input type="text" wire:model="titulo" placeholder="Título">
        <textarea wire:model="descripcion" placeholder="Descripción"></textarea>
        <button type="submit">{{ $editMode ? 'Actualizar' : 'Guardar' }}</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>Título</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($incidencias as $incidencia)
                <tr>
                    <td>{{ $incidencia->titulo }}</td>
                    <td>{{ $incidencia->descripcion }}</td>
                    <td>
                        <button wire:click="edit({{ $incidencia->id }})">Editar</button>
                        <button wire:click="delete({{ $incidencia->id }})">Eliminar</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div> 