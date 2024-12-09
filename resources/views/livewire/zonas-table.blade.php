<div>
    <h2>Gestión de Zonas</h2>

    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">
        <input type="text" wire:model="nombre" placeholder="Nombre">
        <textarea wire:model="descripcion" placeholder="Descripción"></textarea>
        <button type="submit">{{ $isEdit ? 'Actualizar' : 'Guardar' }}</button>
        @if($isEdit)
            <button type="button" wire:click="resetInputFields">Cancelar</button>
        @endif
    </form>

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($zonas as $zona)
                <tr>
                    <td>{{ $zona->nombre }}</td>
                    <td>{{ $zona->descripcion }}</td>
                    <td>
                        <button wire:click="edit({{ $zona->id }})">Editar</button>
                        <button wire:click="delete({{ $zona->id }})">Eliminar</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
