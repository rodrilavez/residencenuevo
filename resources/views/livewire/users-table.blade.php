<div>
    <h2>Usuarios</h2>

    <form wire:submit.prevent="{{ $editMode ? 'update' : 'store' }}">
        <input type="text" wire:model="name" placeholder="Nombre">
        <input type="email" wire:model="email" placeholder="Email">
        @if(!$editMode)
            <input type="password" wire:model="password" placeholder="Contraseña">
        @endif
        <select wire:model="role">
            <option value="admin">Admin</option>
            <option value="guard">Guardia</option>
            <option value="residente">Residente</option>
        </select>
        <button type="submit">{{ $editMode ? 'Actualizar' : 'Guardar' }}</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        <button wire:click="edit({{ $user->id }})">Editar</button>
                        <button wire:click="delete({{ $user->id }})">Eliminar</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div> 