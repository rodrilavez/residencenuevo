<div>
    <h2 class="mb-3">Gestión de Propiedades</h2>

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

    <form wire:submit.prevent="{{ $editMode ? 'update' : 'store' }}" class="mb-4">
        <div class="form-row">
            <div class="form-group col-md-6">
                <input type="text" wire:model="nombre" class="form-control" placeholder="Nombre">
            </div>
            <div class="form-group col-md-6">
                <input type="text" wire:model="zona_id" class="form-control" placeholder="Zona ID">
            </div>
        </div>
        <div class="form-group">
            <textarea wire:model="descripcion" class="form-control" placeholder="Descripción"></textarea>
        </div>
        <div class="form-group">
            <select wire:model="es_amenidad" class="form-control">
                <option value="0">No</option>
                <option value="1">Sí</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">{{ $editMode ? 'Actualizar' : 'Guardar' }}</button>
    </form>

    <table class="table table-hover">
        <thead class="thead-dark">
            <tr>
                <th>Nombre</th>
                <th>Zona ID</th>
                <th>Descripción</th>
                <th>Es Amenidad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($propiedades as $propiedad)
                <tr>
                    <td>{{ $propiedad->nombre }}</td>
                    <td>{{ $propiedad->zona_id }}</td>
                    <td>{{ $propiedad->descripcion }}</td>
                    <td>{{ $propiedad->es_amenidad ? 'Sí' : 'No' }}</td>
                    <td>
                        <button wire:click="edit({{ $propiedad->id }})" class="btn btn-warning btn-sm">Editar</button>
                        <button wire:click="delete({{ $propiedad->id }})" class="btn btn-danger btn-sm">Eliminar</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div> 