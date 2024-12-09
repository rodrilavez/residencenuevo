<div>
    <h2>Registro de Actividades</h2>

    <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">
        <input type="text" wire:model="actividad" placeholder="Actividad">
        <input type="text" wire:model="descripcion" placeholder="Descripción">
        <button type="submit">{{ $isEdit ? 'Actualizar' : 'Guardar' }}</button>
        @if($isEdit)
            <button type="button" wire:click="resetForm">Cancelar</button>
        @endif
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Actividad</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($actividades as $actividad)
                <tr>
                    <td>{{ $actividad->id }}</td>
                    <td>{{ $actividad->actividad }}</td>
                    <td>{{ $actividad->descripcion }}</td>
                    <td>
                        <button wire:click="edit({{ $actividad->id }})">Editar</button>
                        <button wire:click="delete({{ $actividad->id }})">Eliminar</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div> 