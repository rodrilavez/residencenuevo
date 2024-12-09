<div>
    <h2>Reportar Incidencia</h2>

    <form wire:submit.prevent="store">
        <input type="text" wire:model="titulo" placeholder="Título">
        <textarea wire:model="descripcion" placeholder="Descripción"></textarea>
        <button type="submit">Reportar</button>
    </form>
</div> 