<div>
    <h2>Residentes</h2>

    <form wire:submit.prevent="{{ $editMode ? 'update' : 'store' }}">
        <input type="text" wire:model="user_id" placeholder="User ID">
        <input type="text" wire:model="propiedad_id" placeholder="Propiedad ID">
        <input type="text" wire:model="telefono" placeholder="Teléfono">
        <button type="submit">{{ $editMode ? 'Actualizar' : 'Guardar' }}</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>User ID</th>
                <th>Propiedad ID</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($residentes as $residente)
                <tr>
                    <td>{{ $residente->user_id }}</td>
                    <td>{{ $residente->propiedad_id }}</td>
                    <td>{{ $residente->telefono }}</td>
                    <td>
                        <button wire:click="edit({{ $residente->id }})">Editar</button>
                        <button wire:click="delete({{ $residente->id }})">Eliminar</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div> 