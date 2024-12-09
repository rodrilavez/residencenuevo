<div>
    <h2>Mis Horarios</h2>

    <table>
        <thead>
            <tr>
                <th>Inicio</th>
                <th>Fin</th>
            </tr>
        </thead>
        <tbody>
            @foreach($horarios as $horario)
                <tr>
                    <td>{{ $horario->inicio }}</td>
                    <td>{{ $horario->fin }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div> 