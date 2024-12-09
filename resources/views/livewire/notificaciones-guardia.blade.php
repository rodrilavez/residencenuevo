<div>
    <h2>Notificaciones</h2>
    @if (session()->has('message'))
        <div>{{ session('message') }}</div>
    @endif

    <ul>
        @foreach($notificaciones as $notificacion)
            <li>{{ $notificacion->mensaje }} - {{ $notificacion->created_at->format('d/m/Y H:i') }}</li>
        @endforeach
    </ul>
</div> 