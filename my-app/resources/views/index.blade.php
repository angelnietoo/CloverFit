<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>CloverFit — Tu gimnasio, tu ritmo</title>
<<<<<<< HEAD
  <!-- Tailwind CDN -->
=======
>>>>>>> d120ea84ed0c50f84d2a70341e755207d90b8bd9
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

        <div class="mt-6 flex gap-3">
          <a href="#membresias" class="inline-block px-6 py-3 rounded-md bg-green-600 text-white font-medium">Únete hoy</a>
          <a href="#clases" class="inline-block px-6 py-3 rounded-md border border-gray-200">Ver clases</a>
        </div>

        <ul class="mt-6 grid grid-cols-2 gap-3 text-sm text-gray-600">
          <li>💪 Clases de fuerza</li>
          <li>🧘 Yogas y estiramientos</li>
          <li>🏋️ Entrenamiento personalizado</li>
          <li>⏱️ Horarios flexibles</li>
        </ul>
      </div>

      <div class="relative">
        <div class="bg-gradient-to-tr from-green-100 to-white rounded-2xl p-6 shadow-lg">
          <img src="https://images.unsplash.com/photo-1558611848-73f7eb4001d0?q=80&w=1200&auto=format&fit=crop&ixlib=rb-4.0.3&s=000" alt="gimnasio" class="rounded-lg w-full h-72 object-cover" />
        </div>
        <div class="absolute -bottom-6 left-6 bg-white rounded-xl p-4 shadow-md w-64">
          <div class="font-semibold">Clase destacada: HIIT</div>
          <div class="text-xs text-gray-500">Lunes · 19:00 · Nivel intermedio</div>
        </div>
      </div>
    </section>

    <!-- FEATURES -->
    <section class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6">
      <div class="bg-white p-6 rounded-lg shadow-sm">
        <h3 class="font-semibold">Entrenadores certificados</h3>
        <p class="mt-2 text-sm text-gray-600">Nuestro equipo cuenta con profesionales en fuerza, movilidad y nutrición.</p>
      </div>
      <div class="bg-white p-6 rounded-lg shadow-sm">
        <h3 class="font-semibold">Instalaciones premium</h3>
        <p class="mt-2 text-sm text-gray-600">Máquinas actualizadas, zona de peso libre y sala de clases climatizada.</p>
      </div>
      <div class="bg-white p-6 rounded-lg shadow-sm">
        <h3 class="font-semibold">Planes flexibles</h3>
        <p class="mt-2 text-sm text-gray-600">Membresías mensuales y anuales con acceso a todas las clases.</p>
      </div>
    </section>

    <!-- CLASSES -->
    <section id="clases" class="mt-12">
      <h2 class="text-2xl font-bold">Clases populares</h2>
      <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-6">
        <article class="bg-white p-4 rounded-lg shadow-sm">
          <h4 class="font-semibold">HIIT</h4>
          <p class="text-sm text-gray-600 mt-2">Entrenamiento interválico de alta intensidad para quemar grasa y ganar resistencia.</p>
          <div class="mt-3 text-xs text-gray-500">Duración: 45 min · Nivel: Intermedio</div>
        </article>
        <article class="bg-white p-4 rounded-lg shadow-sm">
          <h4 class="font-semibold">Yoga Flow</h4>
          <p class="text-sm text-gray-600 mt-2">Clase para mejorar movilidad, respiración y recuperación.</p>
          <div class="mt-3 text-xs text-gray-500">Duración: 60 min · Nivel: Todos</div>
        </article>
        <article class="bg-white p-4 rounded-lg shadow-sm">
          <h4 class="font-semibold">Powerlifting</h4>
          <p class="text-sm text-gray-600 mt-2">Trabajo técnico de sentadilla, press y peso muerto con entrenador.</p>
          <div class="mt-3 text-xs text-gray-500">Duración: 90 min · Nivel: Avanzado</div>
        </article>
      </div>
    </section>

    <!-- TRAINERS -->
    <section id="entrenadores" class="mt-12">
      <h2 class="text-2xl font-bold">Nuestros entrenadores</h2>
      <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-lg p-4 shadow-sm text-center">
          <img src="https://amenzing.com/wp-content/uploads/2020/12/Captura-de-pantalla-2020-12-14-a-las-22.43.06.jpg" alt="entrenador" class="mx-auto w-24 h-24 rounded-full object-cover" />
          <div class="mt-3 font-semibold">Ángel Nieto</div>
          <div class="text-xs text-gray-500">Fuerza & Movilidad</div>
        </div>
        <div class="bg-white rounded-lg p-4 shadow-sm text-center">
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTrHM7Ldvm-4jrtiLdJ99TzvLsNR_4pLYsnTg&s" alt="entrenador" class="mx-auto w-24 h-24 rounded-full object-cover" />
          <div class="mt-3 font-semibold">Frederic Sadibou</div>
          <div class="text-xs text-gray-500">Entrenamiento funcional</div>
        </div>
        <div class="bg-white rounded-lg p-4 shadow-sm text-center">
          <img src="https://img.asmedia.epimg.net/resizer/v2/6EGRX5D54RF23IPWXXSJMYSQTY.png?auth=95f64a9c9c05c37e565b8496e211f660a3eeb4a51360f52d69537eedde47fbf7&width=1200&height=1200&smart=true" alt="entrenador" class="mx-auto w-24 h-24 rounded-full object-cover" />
          <div class="mt-3 font-semibold">Héctor Ramos</div>
          <div class="text-xs text-gray-500">Yoga & Recuperación</div>
        </div>
        <div class="bg-white rounded-lg p-4 shadow-sm text-center">
          <img src="https://eltelevisero.huffingtonpost.es/wp-content/uploads/2021/07/antonio-recio-lqsa-.jpg" alt="entrenador" class="mx-auto w-24 h-24 rounded-full object-cover" />
          <div class="mt-3 font-semibold">Manuel Tocón</div>
          <div class="text-xs text-gray-500">Cardio & HIIT</div>
        </div>
      </div>
    </section>

    <!-- MEMBERSHIP CTA -->
    <section id="membresias" class="mt-12 bg-green-50 p-8 rounded-lg">
      <div class="flex flex-col md:flex-row items-center justify-between gap-6">
        <div>
          <h3 class="text-2xl font-bold">Planes a tu medida</h3>
          <p class="mt-2 text-gray-600">Desde mensual a anual, con opciones familiares y acceso ilimitado a las clases.</p>
        </div>
        <div class="flex gap-3">
          <a href="{{ url('/register') }}" class="inline-block px-6 py-3 rounded-md bg-green-600 text-white">Comenzar</a>
          <a href="#" class="inline-block px-6 py-3 rounded-md border border-green-600">Comparar planes</a>
        </div>
      </div>
    </section>

    <!-- CONTACT -->
    <section id="contacto" class="mt-12">
      <h2 class="text-2xl font-bold">Contacto</h2>
      <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white p-6 rounded-lg shadow-sm">
          <h4 class="font-semibold">Dirección</h4>
          <p class="mt-2 text-sm text-gray-600">Calle Ejemplo 123, Ciudad — 28000</p>

          <h4 class="font-semibold mt-4">Horario</h4>
          <p class="mt-2 text-sm text-gray-600">Lun - Vie: 06:00 - 22:00 · Sáb: 08:00 - 14:00</p>

          <h4 class="font-semibold mt-4">Teléfono</h4>
          <p class="mt-2 text-sm text-gray-600">+34 600 000 000</p>
        </div>

        <form class="bg-white p-6 rounded-lg shadow-sm" method="POST" action="{{ route('contact.send') }}">
          @csrf
          <label class="block text-sm font-medium">Nombre</label>
          <input name="name" class="mt-1 block w-full rounded-md border-gray-200 shadow-sm" required />

          <label class="block text-sm font-medium mt-4">Email</label>
          <input name="email" type="email" class="mt-1 block w-full rounded-md border-gray-200 shadow-sm" required />

          <label class="block text-sm font-medium mt-4">Mensaje</label>
          <textarea name="message" rows="4" class="mt-1 block w-full rounded-md border-gray-200 shadow-sm" required></textarea>

          <div class="mt-4 text-right">
            <button type="submit" class="px-4 py-2 rounded-md bg-green-600 text-white">Enviar</button>
          </div>
        </form>
      </div>
    </section>

    <!-- FOOTER -->
    <footer class="mt-12 text-sm text-gray-500">
      <div class="border-t pt-6 flex flex-col md:flex-row items-center justify-between gap-4">
        <div>© {{ date('Y') }} CloverFit. Todos los derechos reservados.</div>
        <div class="flex gap-4">
          <a href="#" class="hover:text-gray-700">Términos</a>
          <a href="#" class="hover:text-gray-700">Privacidad</a>
        </div>
      </div>
    </footer>
  </main>
</body>
</html>
