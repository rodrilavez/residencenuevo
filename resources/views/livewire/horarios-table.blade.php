<div>
    <h2>Horarios</h2>

    <form wire:submit.prevent="{{ $editMode ? 'update' : 'store' }}">
        <input type="text" wire:model="guardia_id" placeholder="Guardia ID">
        <input type="datetime-local" wire:model="inicio" placeholder="Inicio">
        <input type="datetime-local" wire:model="fin" placeholder="Fin">
        <button type="submit">{{ $editMode ? 'Actualizar' : 'Guardar' }}</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>Guardia ID</th>
                <th>Inicio</th>
                <th>Fin</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($horarios as $horario)
                <tr>
                    <td>{{ $horario->guardia_id }}</td>
                    <td>{{ $horario->inicio }}</td>
                    <td>{{ $horario->fin }}</td>
                    <td>
                        <button wire:click="edit({{ $horario->id }})">Editar</button>
                        <button wire:click="delete({{ $horario->id }})">Eliminar</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div> 