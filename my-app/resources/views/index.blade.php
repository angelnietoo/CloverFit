@extends('layouts.app')

@section('content')

  <!-- HERO a ancho completo con imagen de fondo -->
  <section class="relative w-full h-[60vh] md:h-[70vh]">
    <img src="{{ asset('imagenes/cloverfit.jpg') }}" alt="CloverFit Hero"
         class="absolute inset-0 w-full h-full object-cover" />
    <div class="absolute inset-0 bg-black/50"></div>
  </section>

  <!-- CONTENEDOR PRINCIPAL -->
  <div class="max-w-6xl mx-auto px-6 py-12">

    <!-- HERO de texto + imagen lateral -->
    <section class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
      <div>
        <h1 class="text-4xl md:text-5xl font-extrabold leading-tight">
          CloverFit — Fuerza, estética y comunidad
        </h1>
        <p class="mt-4 text-neutral-300">
          Clases dirigidas, entrenadores certificados y planes de membresía pensados para que des lo mejor de ti. Nos adaptamos a tu ritmo.
        </p>

        <div class="mt-6 flex flex-wrap gap-3">
          <a href="#membresias"
             class="inline-block px-6 py-3 rounded-md bg-red-600 text-white font-semibold hover:bg-red-500 transition">
            Únete hoy
          </a>
          <a href="#clases"
             class="inline-block px-6 py-3 rounded-md border border-white/15 text-white hover:border-red-500/70 hover:text-red-400 transition">
            Ver clases
          </a>
        </div>

        <ul class="mt-6 grid grid-cols-2 gap-3 text-sm text-neutral-300">
          <li>💪 Clases de fuerza</li>
          <li>🧘 Yogas y estiramientos</li>
          <li>🏋️ Entrenamiento personalizado</li>
          <li>⏱️ Horarios flexibles</li>
        </ul>
      </div>

      <div class="relative">
        <div class="rounded-2xl p-4 border border-white/10 bg-neutral-900 shadow-lg">
          <img src="{{ asset('imagenes/cloverfit2.jpg') }}" alt="gimnasio"
               class="rounded-xl w-full h-80 object-cover" />
        </div>

        <div class="absolute -bottom-6 left-6 bg-neutral-950/95 text-white rounded-xl p-4 shadow-md w-64 border border-white/10">
          <div class="font-semibold text-red-400">Clase destacada: HIIT</div>
          <div class="text-xs text-neutral-300">Lunes · 19:00 · Nivel intermedio</div>
        </div>
      </div>
    </section>

    <!-- MEMBERSHIPS (MODIFICADO) -->
    <section id="membresias" class="mt-16 bg-neutral-900/60 p-8 rounded-2xl border border-white/10">
      <h2 class="text-2xl font-bold text-center">Nuestras Suscripciones</h2>
      <p class="mt-2 text-center text-neutral-300">
        Elige el plan que mejor se adapta a tus necesidades. Tenemos opciones para empezar y para ir a full.
      </p>

      <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

        <div class="bg-neutral-950 p-6 rounded-2xl border border-white/10 hover:border-red-500/60 transition">
          <h3 class="text-xl font-semibold">FIT</h3>

          <!-- PRECIO ARRIBA -->
          <p class="text-3xl font-extrabold mt-3 text-red-400">
            €19.99<span class="text-base text-neutral-300 font-medium">/mes</span>
          </p>
          <p class="text-xs text-green-400 mt-1">
            Primer mes: <span class="font-bold">€9,99</span>
          </p>

          <!-- DESCRIPCIÓN ABAJO -->
          <p class="mt-4 text-neutral-300">Acceso a todas las clases y zona estándar.</p>

          <a href="{{ route('suscripcion.seleccionar') }}"
             class="mt-6 inline-block w-full text-center px-6 py-3 rounded-md bg-red-600 text-white font-semibold hover:bg-red-500 transition">
            Seleccionar
          </a>
        </div>

        <div class="bg-neutral-950 p-6 rounded-2xl border border-red-500/50 shadow-[0_0_0_1px_rgba(239,68,68,0.25)]">
          <div class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-500/15 text-red-300 border border-red-500/30">
            Más popular
          </div>

          <h3 class="text-xl font-semibold mt-3">PRO</h3>

          <!-- PRECIO ARRIBA -->
          <p class="text-3xl font-extrabold mt-3 text-red-400">
            €24.99<span class="text-base text-neutral-300 font-medium">/mes</span>
          </p>
          <p class="text-xs text-green-400 mt-1">
            Primer mes: <span class="font-bold">€9,99</span>
          </p>

          <!-- DESCRIPCIÓN ABAJO -->
          <p class="mt-4 text-neutral-300">Zonas premium + 4 sesiones con entrenador personal.</p>

          <a href="{{ route('suscripcion.seleccionar') }}"
             class="mt-6 inline-block w-full text-center px-6 py-3 rounded-md bg-red-600 text-white font-semibold hover:bg-red-500 transition">
            Seleccionar
          </a>
        </div>

        <div class="bg-neutral-950 p-6 rounded-2xl border border-white/10 hover:border-red-500/60 transition">
          <h3 class="text-xl font-semibold">ELITE</h3>

          <!-- PRECIO ARRIBA -->
          <p class="text-3xl font-extrabold mt-3 text-red-400">
            €35.99<span class="text-base text-neutral-300 font-medium">/mes</span>
          </p>
          <p class="text-xs text-green-400 mt-1">
            Primer mes: <span class="font-bold">€9,99</span>
          </p>

          <!-- DESCRIPCIÓN ABAJO -->
          <p class="mt-4 text-neutral-300">Acceso total + zonas exclusivas + entrenador personal.</p>

          <a href="{{ route('suscripcion.seleccionar') }}"
             class="mt-6 inline-block w-full text-center px-6 py-3 rounded-md bg-red-600 text-white font-semibold hover:bg-red-500 transition">
            Seleccionar
          </a>
        </div>

      </div>
    </section>

    <!-- FEATURES -->
    <section class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-6">
      <div class="bg-neutral-900/60 text-white p-6 rounded-2xl border border-white/10">
        <h3 class="font-semibold">Entrenadores certificados</h3>
        <p class="mt-2 text-sm text-neutral-300">Profesionales en fuerza, movilidad y nutrición.</p>
      </div>
      <div class="bg-neutral-900/60 text-white p-6 rounded-2xl border border-white/10">
        <h3 class="font-semibold">Instalaciones premium</h3>
        <p class="mt-2 text-sm text-neutral-300">Máquinas actualizadas y zona de peso libre.</p>
      </div>
      <div class="bg-neutral-900/60 text-white p-6 rounded-2xl border border-white/10">
        <h3 class="font-semibold">Planes flexibles</h3>
        <p class="mt-2 text-sm text-neutral-300">Mensual, anual y opciones para familias.</p>
      </div>
    </section>

    <!-- CLASSES -->
    <section id="clases" class="mt-16">
      <h2 class="text-2xl font-bold">Clases populares</h2>
      <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
        <article class="bg-neutral-900/60 p-6 rounded-2xl border border-white/10">
          <h4 class="font-semibold text-red-400">HIIT</h4>
          <p class="text-sm text-neutral-300 mt-2">Alta intensidad para resistencia y quema de grasa.</p>
          <div class="mt-3 text-xs text-neutral-400">45 min · Intermedio</div>
        </article>
        <article class="bg-neutral-900/60 p-6 rounded-2xl border border-white/10">
          <h4 class="font-semibold text-red-400">Yoga Flow</h4>
          <p class="text-sm text-neutral-300 mt-2">Movilidad, respiración y recuperación.</p>
          <div class="mt-3 text-xs text-neutral-400">60 min · Todos</div>
        </article>
        <article class="bg-neutral-900/60 p-6 rounded-2xl border border-white/10">
          <h4 class="font-semibold text-red-400">Powerlifting</h4>
          <p class="text-sm text-neutral-300 mt-2">Técnica de sentadilla, press y peso muerto.</p>
          <div class="mt-3 text-xs text-neutral-400">90 min · Avanzado</div>
        </article>
      </div>
    </section>

    <!-- TRAINERS -->
    <section id="entrenadores" class="mt-16">
      <h2 class="text-2xl font-bold">Nuestros entrenadores</h2>
      <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
        <div class="bg-neutral-900/60 rounded-2xl p-4 border border-white/10 text-center">
          <img src="https://amenzing.com/wp-content/uploads/2020/12/Captura-de-pantalla-2020-12-14-a-las-22.43.06.jpg" alt="entrenador"
               class="mx-auto w-24 h-24 rounded-full object-cover ring-2 ring-red-500/60" />
          <div class="mt-3 font-semibold">Ángel Nieto</div>
          <div class="text-xs text-neutral-300">Fuerza & Movilidad</div>
        </div>

        <div class="bg-neutral-900/60 rounded-2xl p-4 border border-white/10 text-center">
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTrHM7Ldvm-4jrtiLdJ99TzvLsNR_4pLYsnTg&s" alt="entrenador"
               class="mx-auto w-24 h-24 rounded-full object-cover ring-2 ring-red-500/60" />
          <div class="mt-3 font-semibold">Frederic Sadibou</div>
          <div class="text-xs text-neutral-300">Entrenamiento funcional</div>
        </div>

        <div class="bg-neutral-900/60 rounded-2xl p-4 border border-white/10 text-center">
          <img src="https://img.asmedia.epimg.net/resizer/v2/6EGRX5D54RF23IPWXXSJMYSQTY.png?auth=95f64a9c9c05c37e565b8496e211f660a3eeb4a51360f52d69537eedde47fbf7&width=1200&height=1200&smart=true" alt="entrenador"
               class="mx-auto w-24 h-24 rounded-full object-cover ring-2 ring-red-500/60" />
          <div class="mt-3 font-semibold">Héctor Ramos</div>
          <div class="text-xs text-neutral-300">Yoga & Recuperación</div>
        </div>

        <div class="bg-neutral-900/60 rounded-2xl p-4 border border-white/10 text-center">
          <img src="https://eltelevisero.huffingtonpost.es/wp-content/uploads/2021/07/antonio-recio-lqsa-.jpg" alt="entrenador"
               class="mx-auto w-24 h-24 rounded-full object-cover ring-2 ring-red-500/60" />
          <div class="mt-3 font-semibold">Manuel Tocón</div>
          <div class="text-xs text-neutral-300">Cardio & HIIT</div>
        </div>
      </div>
    </section>

    <!-- CONTACT -->
    <section id="contacto" class="mt-16 bg-neutral-900/60 text-white p-8 rounded-2xl border border-white/10">
      <h2 class="text-2xl font-bold">Contacto</h2>

      <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-neutral-950 p-6 rounded-2xl border border-white/10">
          <h4 class="font-semibold text-red-400">Dirección</h4>
          <p class="mt-2 text-sm text-neutral-300">Calle Ejemplo 123, Ciudad — 28000</p>

          <h4 class="font-semibold text-red-400 mt-4">Horario</h4>
          <p class="mt-2 text-sm text-neutral-300">Lun - Vie: 06:00 - 22:00 · Sáb: 08:00 - 14:00</p>

          <h4 class="font-semibold text-red-400 mt-4">Teléfono</h4>
          <p class="mt-2 text-sm text-neutral-300">+34 600 000 000</p>
        </div>

        <form class="bg-neutral-950 p-6 rounded-2xl border border-white/10" method="POST" action="{{ route('contact.send') }}">
          @csrf

          <label class="block text-sm font-medium text-neutral-200">Nombre</label>
          <input name="name" required
                 class="mt-1 block w-full rounded-md bg-neutral-900 border border-white/10 text-white placeholder-neutral-400 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500/70" />

          <label class="block text-sm font-medium text-neutral-200 mt-4">Email</label>
          <input name="email" type="email" required
                 class="mt-1 block w-full rounded-md bg-neutral-900 border border-white/10 text-white placeholder-neutral-400 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500/70" />

          <label class="block text-sm font-medium text-neutral-200 mt-4">Mensaje</label>
          <textarea name="message" rows="4" required
                    class="mt-1 block w-full rounded-md bg-neutral-900 border border-white/10 text-white placeholder-neutral-400 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500/70"></textarea>

          <div class="mt-4 text-right">
            <button type="submit"
                    class="px-4 py-2 rounded-md bg-red-600 text-white font-semibold hover:bg-red-500 transition">
              Enviar
            </button>
          </div>
        </form>
      </div>
    </section>

    <!-- SECCIÓN DE MAPA Y UBICACIÓN -->
    <section class="mt-16 flex justify-center items-center space-x-8">
      <div class="w-1/2">
        <h2 class="text-2xl font-bold text-white">Encuentranos</h2>
        <p class="mt-4 text-neutral-300">
          Dirección:<br>
          Calle Ave del Paraíso, nº6, El Puerto de Santa María, 11500, Cádiz
        </p>
        <p class="mt-4 text-neutral-300">
          Horario:<br>
          Lunes a Viernes: 08:00 a 21:00
        </p>
      </div>

      <!-- Mapa pequeño -->
      <div class="w-1/2 h-40">
        <x-maps-leaflet 
          :centerPoint="['lat' => 36.595531, 'long' => -6.230796]" 
          :zoomLevel="15" 
          :markers="[['lat' => 36.595531, 'long' => -6.230796]]"
        />
      </div>
    </section>

    <!-- FOOTER -->
    <footer class="mt-16 text-sm text-neutral-400">
      <div class="border-t border-white/10 pt-6 flex flex-col md:flex-row items-center justify-between gap-4">
        <div>© {{ date('Y') }} CloverFit. Todos los derechos reservados.</div>
        <div class="flex gap-4">
          <a href="#" class="hover:text-red-400 transition">Términos</a>
          <a href="#" class="hover:text-red-400 transition">Privacidad</a>
        </div>
      </div>
    </footer>

  </div>

@endsection
