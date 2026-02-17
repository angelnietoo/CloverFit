<?php $__env->startSection('content'); ?>
<div class="fixed inset-0 -z-20 bg-neutral-950">
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,rgba(239,68,68,0.18),transparent_55%)]"></div>
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_bottom,rgba(255,255,255,0.06),transparent_60%)]"></div>
</div>

<div class="relative px-4 py-8 sm:px-6 lg:px-8 flex flex-col items-center justify-start w-full pb-16 sm:pb-20">

    <div class="w-full max-w-3xl">
        <div class="text-center">
            <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-white">
                Selecciona tu tipo de suscripción
            </h2>
            <p class="mt-2 text-sm sm:text-base text-neutral-300">
                Elige el plan que mejor se adapte a tus necesidades
            </p>
        </div>

        <form action="<?php echo e(route('suscripcion.pagar')); ?>" method="POST" class="mt-10">
            <?php echo csrf_field(); ?>

            <div class="relative rounded-2xl border border-white/10 bg-neutral-900/70 backdrop-blur-xl shadow-2xl p-6 sm:p-8 overflow-hidden">
                
                <div class="pointer-events-none absolute -top-24 left-1/2 h-48 w-[36rem] -translate-x-1/2 rounded-full bg-red-500/20 blur-3xl"></div>

                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-6">

                    
                    <label class="group cursor-pointer">
                        <input type="radio" name="tipo_suscripcion" value="fit" class="peer sr-only" checked>

                        <div class="h-full rounded-2xl border border-white/10 bg-neutral-950/60 p-5 transition
                                    shadow-[inset_0_1px_0_rgba(255,255,255,0.04)]
                                    hover:border-red-500/40 hover:bg-neutral-950/80
                                    peer-checked:border-red-500/60 peer-checked:ring-2 peer-checked:ring-red-500/30">
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <div class="text-sm font-semibold text-neutral-200">Plan</div>
                                    <div class="mt-1 text-xl font-extrabold text-white">FIT</div>
                                </div>
                                <span class="inline-flex items-center rounded-full border border-white/10 bg-white/5 px-2.5 py-1 text-xs text-neutral-200">
                                    Starter
                                </span>
                            </div>

                            <div class="mt-4 flex items-baseline gap-2">
                                <div class="text-3xl font-extrabold text-red-400">€19,99</div>
                                <div class="text-sm text-neutral-400">/ mes</div>
                            </div>

                            <div class="mt-2 text-xs text-green-400">
                                Primer mes: <span class="font-bold">€9.99</span>
                            </div>

                            <ul class="mt-4 space-y-2 text-sm text-neutral-300">
                                <li class="flex gap-2"><span class="text-red-400">•</span> Acceso sala y zona estándar</li>
                                <li class="flex gap-2"><span class="text-red-400">•</span> Clases básicas incluidas</li>
                                <li class="flex gap-2"><span class="text-red-400">•</span> Horario completo</li>
                            </ul>

                            <div class="mt-5 text-xs text-neutral-500">
                                Ideal para empezar y coger rutina.
                            </div>
                        </div>
                    </label>

                    
                    <label class="group cursor-pointer">
                        <input type="radio" name="tipo_suscripcion" value="pro" class="peer sr-only">

                        <div class="h-full rounded-2xl border border-white/10 bg-neutral-950/60 p-5 transition
                                    shadow-[inset_0_1px_0_rgba(255,255,255,0.04)]
                                    hover:border-red-500/40 hover:bg-neutral-950/80
                                    peer-checked:border-red-500/60 peer-checked:ring-2 peer-checked:ring-red-500/30">
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <div class="text-sm font-semibold text-neutral-200">Plan</div>
                                    <div class="mt-1 text-xl font-extrabold text-white">PRO</div>
                                </div>
                                <span class="inline-flex items-center rounded-full border border-red-500/30 bg-red-500/10 px-2.5 py-1 text-xs text-red-200">
                                    Recomendado
                                </span>
                            </div>

                            <div class="mt-4 flex items-baseline gap-2">
                                <div class="text-3xl font-extrabold text-red-400">€34,99</div>
                                <div class="text-sm text-neutral-400">/ mes</div>
                            </div>

                            <div class="mt-2 text-xs text-green-400">
                                Primer mes: <span class="font-bold">€9.99</span>
                            </div>

                            <ul class="mt-4 space-y-2 text-sm text-neutral-300">
                                <li class="flex gap-2"><span class="text-red-400">•</span> Todo lo del Básico</li>
                                <li class="flex gap-2"><span class="text-red-400">•</span> Clases dirigidas (full)</li>
                                <li class="flex gap-2"><span class="text-red-400">•</span> 1 sesión de asesoría/mes</li>
                            </ul>

                            <div class="mt-5 text-xs text-neutral-500">
                                Perfecto para progresar rápido.
                            </div>
                        </div>
                    </label>

                    
                    <label class="group cursor-pointer">
                        <input type="radio" name="tipo_suscripcion" value="elite" class="peer sr-only">

                        <div class="h-full rounded-2xl border border-white/10 bg-neutral-950/60 p-5 transition
                                    shadow-[inset_0_1px_0_rgba(255,255,255,0.04)]
                                    hover:border-red-500/40 hover:bg-neutral-950/80
                                    peer-checked:border-red-500/60 peer-checked:ring-2 peer-checked:ring-red-500/30">
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <div class="text-sm font-semibold text-neutral-200">Plan</div>
                                    <div class="mt-1 text-xl font-extrabold text-white">ELITE</div>
                                </div>
                                <span class="inline-flex items-center rounded-full border border-white/10 bg-white/5 px-2.5 py-1 text-xs text-neutral-200">
                                    Pro
                                </span>
                            </div>

                            <div class="mt-4 flex items-baseline gap-2">
                                <div class="text-3xl font-extrabold text-red-400">€45,99</div>
                                <div class="text-sm text-neutral-400">/ mes</div>
                            </div>

                            <div class="mt-2 text-xs text-green-400">
                                Primer mes: <span class="font-bold">€9.99</span>
                            </div>

                            <ul class="mt-4 space-y-2 text-sm text-neutral-300">
                                <li class="flex gap-2"><span class="text-red-400">•</span> Acceso total + zonas premium</li>
                                <li class="flex gap-2"><span class="text-red-400">•</span> Entrenamiento personalizado</li>
                                <li class="flex gap-2"><span class="text-red-400">•</span> Prioridad en reservas</li>
                            </ul>

                            <div class="mt-5 text-xs text-neutral-500">
                                Para ir a full y sin límites.
                            </div>
                        </div>
                    </label>

                </div>

                
                <div class="mt-8 flex flex-col sm:flex-row gap-3 sm:items-center sm:justify-between">
                    <p class="text-sm text-neutral-400">
                        Puedes cambiar o cancelar tu plan cuando quieras.
                    </p>

                    <button type="submit"
                        class="inline-flex items-center justify-center rounded-xl px-5 py-2.5 font-semibold text-white transition
                               bg-gradient-to-r from-red-600 to-red-500
                               hover:from-red-500 hover:to-red-400
                               shadow-lg shadow-red-500/10
                               active:translate-y-[1px] active:shadow-red-500/5">
                        Continuar al pago
                    </button>
                </div>
            </div>
        </form>

        <p class="mt-6 text-center text-xs text-neutral-500">
            © <?php echo e(date('Y')); ?> CloverFit
        </p>

        
        <div class="mt-12">
            <h3 class="text-2xl font-extrabold text-white text-center mb-8">
                Comparativa de planes
            </h3>
            
            <div class="overflow-x-auto rounded-2xl border border-white/10">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-white/10 bg-neutral-900/40">
                            <th class="px-6 py-4 text-left text-sm font-semibold text-white">Características</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold text-white">FIT</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold text-white">PRO</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold text-white">ELITE</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        <tr class="hover:bg-neutral-900/30 transition">
                            <td class="px-6 py-4 text-sm text-neutral-300">Acceso a la sala</td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-green-500/20 text-green-400">✓</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-green-500/20 text-green-400">✓</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-green-500/20 text-green-400">✓</span>
                            </td>
                        </tr>
                        <tr class="hover:bg-neutral-900/30 transition">
                            <td class="px-6 py-4 text-sm text-neutral-300">Zona estándar</td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-green-500/20 text-green-400">✓</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-green-500/20 text-green-400">✓</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-green-500/20 text-green-400">✓</span>
                            </td>
                        </tr>
                        <tr class="hover:bg-neutral-900/30 transition">
                            <td class="px-6 py-4 text-sm text-neutral-300">Zonas premium</td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-red-400">✗</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-red-400">✗</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-green-500/20 text-green-400">✓</span>
                            </td>
                        </tr>
                        <tr class="hover:bg-neutral-900/30 transition">
                            <td class="px-6 py-4 text-sm text-neutral-300">Clases básicas</td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-green-500/20 text-green-400">✓</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-green-500/20 text-green-400">✓</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-green-500/20 text-green-400">✓</span>
                            </td>
                        </tr>
                        <tr class="hover:bg-neutral-900/30 transition">
                            <td class="px-6 py-4 text-sm text-neutral-300">Clases dirigidas (full)</td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-red-400">✗</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-green-500/20 text-green-400">✓</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-green-500/20 text-green-400">✓</span>
                            </td>
                        </tr>
                        <tr class="hover:bg-neutral-900/30 transition">
                            <td class="px-6 py-4 text-sm text-neutral-300">Sesiones de asesoría</td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-neutral-400 text-sm">-</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-sm text-neutral-300">1/mes</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-sm text-neutral-300">Ilimitadas</span>
                            </td>
                        </tr>
                        <tr class="hover:bg-neutral-900/30 transition">
                            <td class="px-6 py-4 text-sm text-neutral-300">Entrenador personal</td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-red-400">✗</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-red-400">✗</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-green-500/20 text-green-400">✓</span>
                            </td>
                        </tr>
                        <tr class="hover:bg-neutral-900/30 transition">
                            <td class="px-6 py-4 text-sm text-neutral-300">Prioridad en reservas</td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-red-400">✗</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-red-400">✗</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-green-500/20 text-green-400">✓</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\daw\Documents\GitHub\CloverFit\my-app\resources\views/suscripcion.blade.php ENDPATH**/ ?>