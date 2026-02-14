<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>CloverFit — Tu gimnasio, tu ritmo</title>
  <!-- Tailwind CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <meta name="description" content="CloverFit - gimnasio local: clases, entrenadores, membresías y más." />
</head>
<body class="antialiased bg-gray-800 text-white">

  <!-- NAV -->
  <header class="bg-gray-900 text-white shadow-md">
    <div class="container mx-auto px-6 py-4 flex items-center justify-between">
      <a href="{{ url('/') }}" class="flex items-center gap-3">
        <div class="w-10 h-10 bg-orange-600 rounded-md flex items-center justify-center text-white font-bold">CF</div>
        <span class="font-semibold text-lg">CloverFit</span>
      </a>

      <nav class="hidden md:flex gap-6 items-center">
        <a href="#clases" class="hover:text-orange-500">Clases</a>
        <a href="#entrenadores" class="hover:text-orange-500">Entrenadores</a>
        <a href="#membresias" class="hover:text-orange-500">Membresías</a>
        <a href="#contacto" class="hover:text-orange-500">Contacto</a>
      </nav>

      <div class="flex items-center gap-3">
        @guest
          <a href="{{ route('login') }}" class="text-sm hover:text-orange-500">Iniciar sesión</a>
          <a href="{{ route('register') }}" class="ml-2 inline-block px-4 py-2 rounded-md bg-orange-600 text-white text-sm">Regístrate</a>
        @else
          <a href="{{ route('dashboard') }}" class="inline-block px-4 py-2 rounded-md bg-gray-700 text-sm">Panel</a>
        @endguest
      </div>
    </div>
  </header>

  <!-- IMAGE BELOW HEADER -->
  <div class="w-full" style="height: 650px;">
    <!-- Imagen de gimnasio con altura personalizada -->
    <img src="{{ asset('imagenes/gimnasio.jpg') }}" alt="Gimnasio" class="w-full h-full object-cover object-top rounded-tl-xl rounded-tr-xl"/>
  </div>

  <!-- HERO -->
  <main class="container mx-auto px-6 py-12">
    <section class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
      <div>
        <h1 class="text-4xl md:text-5xl font-extrabold leading-tight text-white">CloverFit — Fuerza, estética y comunidad</h1>
        <p class="mt-4 text-gray-300">Clases dirigidas, entrenadores certificados y planes de membresía pensados para que des lo mejor de ti. Nos adaptamos a tu ritmo.</p>

        <div class="mt-6 flex gap-3">
          <a href="#membresias" class="inline-block px-6 py-3 rounded-md bg-orange-600 text-white font-medium hover:bg-orange-500">Únete hoy</a>
          <a href="#clases" class="inline-block px-6 py-3 rounded-md border border-gray-600 text-white hover:border-orange-500">Ver clases</a>
        </div>

        <ul class="mt-6 grid grid-cols-2 gap-3 text-sm text-gray-400">
          <li>💪 Clases de fuerza</li>
          <li>🧘 Yogas y estiramientos</li>
          <li>🏋️ Entrenamiento personalizado</li>
          <li>⏱️ Horarios flexibles</li>
        </ul>
      </div>

      <div class="relative">
        <div class="bg-gradient-to-tr from-orange-600 to-black rounded-2xl p-6 shadow-lg">
          <img src="{{ asset('imagenes/gimnasio.jpg') }}" alt="gimnasio" class="rounded-lg w-full h-72 object-cover" />
        </div>
        <div class="absolute -bottom-6 left-6 bg-black text-white rounded-xl p-4 shadow-md w-64">
          <div class="font-semibold">Clase destacada: HIIT</div>
          <div class="text-xs text-gray-400">Lunes · 19:00 · Nivel intermedio</div>
        </div>
      </div>
    </section>

    <!-- MEMBERSHIPS (Nuevo apartado de suscripciones) -->
    <section id="membresias" class="mt-12 bg-gray-700 p-8 rounded-lg">
      <h2 class="text-2xl font-bold text-white text-center">Nuestras Suscripciones</h2>
      <p class="mt-2 text-center text-gray-400">Elige el plan que mejor se adapta a tus necesidades. Desde acceso básico hasta entrenamientos personalizados, tenemos la opción perfecta para ti.</p>
      
      <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        
        <!-- Suscripción Básica -->
        <div class="bg-gray-600 text-white p-6 rounded-lg shadow-lg border-2 border-orange-500 hover:border-orange-600 transition duration-300">
          <h3 class="text-xl font-semibold">Básica</h3>
          <p class="mt-2 text-gray-400">Acceso a todas las clases, acceso a instalaciones estándar y una clase gratis por semana.</p>
          <p class="text-2xl font-bold mt-4">€20/mes</p>
          <a href="#" class="mt-6 inline-block px-6 py-3 rounded-md bg-orange-600 text-white hover:bg-orange-500 transition duration-300">Seleccionar</a>
        </div>

        <!-- Suscripción Premium -->
        <div class="bg-gray-600 text-white p-6 rounded-lg shadow-lg border-2 border-orange-500 hover:border-orange-600 transition duration-300">
          <h3 class="text-xl font-semibold">Premium</h3>
          <p class="mt-2 text-gray-400">Acceso a todas las clases, zonas premium y un entrenador personal para 4 sesiones mensuales.</p>
          <p class="text-2xl font-bold mt-4">€40/mes</p>
          <a href="#" class="mt-6 inline-block px-6 py-3 rounded-md bg-orange-600 text-white hover:bg-orange-500 transition duration-300">Seleccionar</a>
        </div>

        <!-- Suscripción VIP -->
        <div class="bg-gray-600 text-white p-6 rounded-lg shadow-lg border-2 border-orange-500 hover:border-orange-600 transition duration-300">
          <h3 class="text-xl font-semibold">VIP</h3>
          <p class="mt-2 text-gray-400">Acceso ilimitado a todas las clases y zonas exclusivas, entrenador personal y acceso ilimitado al gimnasio.</p>
          <p class="text-2xl font-bold mt-4">€60/mes</p>
          <a href="#" class="mt-6 inline-block px-6 py-3 rounded-md bg-orange-600 text-white hover:bg-orange-500 transition duration-300">Seleccionar</a>
        </div>
      </div>
    </section>

    <!-- FEATURES -->
    <section class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6">
      <div class="bg-gray-800 text-white p-6 rounded-lg shadow-sm">
        <h3 class="font-semibold">Entrenadores certificados</h3>
        <p class="mt-2 text-sm text-gray-400">Nuestro equipo cuenta con profesionales en fuerza, movilidad y nutrición.</p>
      </div>
      <div class="bg-gray-800 text-white p-6 rounded-lg shadow-sm">
        <h3 class="font-semibold">Instalaciones premium</h3>
        <p class="mt-2 text-sm text-gray-400">Máquinas actualizadas, zona de peso libre y sala de clases climatizada.</p>
      </div>
      <div class="bg-gray-800 text-white p-6 rounded-lg shadow-sm">
        <h3 class="font-semibold">Planes flexibles</h3>
        <p class="mt-2 text-sm text-gray-400">Membresías mensuales y anuales con acceso a todas las clases.</p>
      </div>
    </section>

    <!-- CLASSES -->
    <section id="clases" class="mt-12">
      <h2 class="text-2xl font-bold text-white">Clases populares</h2>
      <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-6">
        <article class="bg-gray-800 text-white p-4 rounded-lg shadow-sm">
          <h4 class="font-semibold">HIIT</h4>
          <p class="text-sm text-gray-400 mt-2">Entrenamiento interválico de alta intensidad para quemar grasa y ganar resistencia.</p>
          <div class="mt-3 text-xs text-gray-400">Duración: 45 min · Nivel: Intermedio</div>
        </article>
        <article class="bg-gray-800 text-white p-4 rounded-lg shadow-sm">
          <h4 class="font-semibold">Yoga Flow</h4>
          <p class="text-sm text-gray-400 mt-2">Clase para mejorar movilidad, respiración y recuperación.</p>
          <div class="mt-3 text-xs text-gray-400">Duración: 60 min · Nivel: Todos</div>
        </article>
        <article class="bg-gray-800 text-white p-4 rounded-lg shadow-sm">
          <h4 class="font-semibold">Powerlifting</h4>
          <p class="text-sm text-gray-400 mt-2">Trabajo técnico de sentadilla, press y peso muerto con entrenador.</p>
          <div class="mt-3 text-xs text-gray-400">Duración: 90 min · Nivel: Avanzado</div>
        </article>
      </div>
    </section>

    <!-- TRAINERS -->
    <section id="entrenadores" class="mt-12">
      <h2 class="text-2xl font-bold text-white">Nuestros entrenadores</h2>
      <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
        <div class="bg-gray-800 text-white rounded-lg p-4 shadow-sm text-center">
          <img src="https://amenzing.com/wp-content/uploads/2020/12/Captura-de-pantalla-2020-12-14-a-las-22.43.06.jpg" alt="entrenador" class="mx-auto w-24 h-24 rounded-full object-cover" />
          <div class="mt-3 font-semibold">Ángel Nieto</div>
          <div class="text-xs text-gray-400">Fuerza & Movilidad</div>
        </div>
        <div class="bg-gray-800 text-white rounded-lg p-4 shadow-sm text-center">
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTrHM7Ldvm-4jrtiLdJ99TzvLsNR_4pLYsnTg&s" alt="entrenador" class="mx-auto w-24 h-24 rounded-full object-cover" />
          <div class="mt-3 font-semibold">Frederic Sadibou</div>
          <div class="text-xs text-gray-400">Entrenamiento funcional</div>
        </div>
        <div class="bg-gray-800 text-white rounded-lg p-4 shadow-sm text-center">
          <img src="https://img.asmedia.epimg.net/resizer/v2/6EGRX5D54RF23IPWXXSJMYSQTY.png?auth=95f64a9c9c05c37e565b8496e211f660a3eeb4a51360f52d69537eedde47fbf7&width=1200&height=1200&smart=true" alt="entrenador" class="mx-auto w-24 h-24 rounded-full object-cover" />
          <div class="mt-3 font-semibold">Héctor Ramos</div>
          <div class="text-xs text-gray-400">Yoga & Recuperación</div>
        </div>
        <div class="bg-gray-800 text-white rounded-lg p-4 shadow-sm text-center">
          <img src="https://eltelevisero.huffingtonpost.es/wp-content/uploads/2021/07/antonio-recio-lqsa-.jpg" alt="entrenador" class="mx-auto w-24 h-24 rounded-full object-cover" />
          <div class="mt-3 font-semibold">Manuel Tocón</div>
          <div class="text-xs text-gray-400">Cardio & HIIT</div>
        </div>
      </div>
    </section>

    <!-- CONTACT -->
    <section id="contacto" class="mt-12 bg-gray-800 text-white p-8 rounded-lg">
      <h2 class="text-2xl font-bold">Contacto</h2>
      <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white text-black p-6 rounded-lg shadow-sm">
          <h4 class="font-semibold">Dirección</h4>
          <p class="mt-2 text-sm text-gray-600">Calle Ejemplo 123, Ciudad — 28000</p>

          <h4 class="font-semibold mt-4">Horario</h4>
          <p class="mt-2 text-sm text-gray-600">Lun - Vie: 06:00 - 22:00 · Sáb: 08:00 - 14:00</p>

          <h4 class="font-semibold mt-4">Teléfono</h4>
          <p class="mt-2 text-sm text-gray-600">+34 600 000 000</p>
        </div>

        <form class="bg-white text-black p-6 rounded-lg shadow-sm" method="POST" action="{{ route('contact.send') }}">
          @csrf
          <label class="block text-sm font-medium">Nombre</label>
          <input name="name" class="mt-1 block w-full rounded-md border-gray-200 shadow-sm" required />

          <label class="block text-sm font-medium mt-4">Email</label>
          <input name="email" type="email" class="mt-1 block w-full rounded-md border-gray-200 shadow-sm" required />

          <label class="block text-sm font-medium mt-4">Mensaje</label>
          <textarea name="message" rows="4" class="mt-1 block w-full rounded-md border-gray-200 shadow-sm" required></textarea>

          <div class="mt-4 text-right">
            <button type="submit" class="px-4 py-2 rounded-md bg-orange-500 text-white">Enviar</button>
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
