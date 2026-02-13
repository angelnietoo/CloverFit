<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>CloverFit — Tu gimnasio, tu ritmo</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <meta name="description" content="CloverFit - gimnasio local: clases, entrenadores, membresías y más." />
</head>
<body class="antialiased bg-gray-50 text-gray-800">

  <h1 class="text-3xl font-bold mb-6">Listado de Entidades</h1>

  <!-- Mostrar todas las entidades -->
  @foreach ($entities as $entity)
    <div class="bg-white p-4 rounded-lg shadow-sm mb-4">
      <h3 class="font-semibold">{{ $entity->field1 }}</h3>
      <p>{{ $entity->field2 }}</p>

      <!-- Mostrar la imagen asociada -->
      <img src="{{ asset('storage/' . $entity->image) }}" alt="Imagen de clase" class="rounded-lg w-full h-72 object-cover mt-2">

      <!-- Si la entidad está eliminada, mostrar la opción para restaurar -->
      @if ($entity->deleted_at)
        <p class="text-red-500">Esta entidad ha sido eliminada.</p>
        <a href="{{ route('entities.restore', $entity->id) }}" class="text-green-600">Restaurar</a>
      @else
        <!-- Si no está eliminada, mostrar las opciones de editar y eliminar -->
        <div class="mt-4 flex gap-4">
          <a href="{{ route('entities.edit', $entity->id) }}" class="text-blue-600">Editar</a>
          
          <!-- Formulario para eliminar (SoftDelete) -->
          <form action="{{ route('entities.destroy', $entity->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-600">Eliminar</button>
          </form>
        </div>
      @endif
    </div>
  @endforeach

  <!-- Enlace para crear una nueva entidad -->
  <a href="{{ route('entities.create') }}" class="inline-block px-6 py-3 rounded-md bg-green-600 text-white font-medium mt-6">Crear Nueva Entidad</a>

</body>
</html>
