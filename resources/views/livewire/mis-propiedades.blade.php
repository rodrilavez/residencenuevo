<div>
    <h2>Mis Propiedades</h2>

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Es Amenidad</th>
            </tr>
        </thead>
        <tbody>
            @foreach($propiedades as $propiedad)
                <tr>
                    <td>{{ $propiedad->nombre }}</td>
                    <td>{{ $propiedad->descripcion }}</td>
                    <td>{{ $propiedad->es_amenidad ? 'Sí' : 'No' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div> 