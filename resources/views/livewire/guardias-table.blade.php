<div>
    <h2>Guardias</h2>

    <form wire:submit.prevent="{{ $editMode ? 'update' : 'store' }}">
        <input type="text" wire:model="user_id" placeholder="User ID">
        <input type="text" wire:model="zona_id" placeholder="Zona ID">
        <button type="submit">{{ $editMode ? 'Actualizar' : 'Guardar' }}</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>User ID</th>
                <th>Zona ID</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($guardias as $guardia)
                <tr>
                    <td>{{ $guardia->user_id }}</td>
                    <td>{{ $guardia->zona_id }}</td>
                    <td>
                        <button wire:click="edit({{ $guardia->id }})">Editar</button>
                        <button wire:click="delete({{ $guardia->id }})">Eliminar</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div> 