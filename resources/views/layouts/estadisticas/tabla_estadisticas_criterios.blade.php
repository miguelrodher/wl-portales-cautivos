<table class="table">
  <thead>
    <tr>
      <th>Criterio</th>
      <th>Número de sesiones</th>
      <th>Número de usuarios</th>
    </tr>
  </thead>
  <tbody>
    @forelse($estadisticas_criterios as $estadistica_criterio)
    <tr>
      <td>{{ $estadistica_criterio->criterio }}</td>
      <td>{{ $estadistica_criterio->numero_sesiones }}</td>
      <td>{{ $estadistica_criterio->numero_usuarios }}</td>
    </tr>
    @empty
    <tr>
      <td colspan="7" class="text-center py-4">
        No hay usuarios registrados.
      </td>
    </tr>
    @endforelse
  </tbody>
</table>