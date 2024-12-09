<div>
    <h2>Reservar Amenidad</h2>

    @if (session()->has('message'))
        <div>{{ session('message') }}</div>
    @endif

    <select wire:model="selectedAmenidad">
        <option value="">Seleccione una amenidad</option>
        @foreach($amenidades as $amenidad)
            <option value="{{ $amenidad->id }}">{{ $amenidad->nombre }}</option>
        @endforeach
    </select>
    <button wire:click="reservar">Reservar</button>
</div> 