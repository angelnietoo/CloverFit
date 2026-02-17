<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'CloverFit')); ?></title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-neutral-950 text-white antialiased overflow-y-auto">
    <div id="app">
        <nav class="bg-neutral-950 border-b border-white/10">
            <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">
                <a class="flex items-center gap-3" href="<?php echo e(url('/')); ?>">
                    <div class="w-10 h-10 bg-red-600 rounded-md flex items-center justify-center text-white font-bold">CF</div>
                    <span class="font-semibold text-lg"><?php echo e(config('app.name', 'CloverFit')); ?></span>
                </a>

                <div class="flex items-center gap-4">
                    <?php if(auth()->guard()->guest()): ?>
                        <?php if(Route::has('login')): ?>
                            <a class="text-sm text-neutral-300 hover:text-red-400" href="<?php echo e(route('login')); ?>">
                                <?php echo e(__('Login')); ?>

                            </a>
                        <?php endif; ?>

                        <?php if(Route::has('register')): ?>
                            <a class="text-sm px-4 py-2 rounded-md bg-red-600 text-white font-semibold hover:bg-red-500"
                               href="<?php echo e(route('register')); ?>">
                                <?php echo e(__('Register')); ?>

                            </a>
                        <?php endif; ?>
                    <?php else: ?>
                        <div class="relative">
                            <details class="group">
                                <summary class="cursor-pointer list-none flex items-center gap-2 text-sm text-neutral-300 hover:text-red-400">
                                    <span><?php echo e(Auth::user()->name); ?></span>
                                    <span class="transition group-open:rotate-180">▾</span>
                                </summary>

                                <div class="absolute right-0 mt-2 w-48 rounded-md bg-neutral-900 border border-white/10 shadow-lg overflow-hidden">
                                    <a class="block px-4 py-2 text-sm hover:bg-neutral-800"
                                       href="<?php echo e(route('logout')); ?>"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <?php echo e(__('Logout')); ?>

                                    </a>
                                </div>
                            </details>

                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="hidden">
                                <?php echo csrf_field(); ?>
                            </form>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </nav>

        <main class="max-w-full mx-auto px-0 py-0">
            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>
</body>
</html>
<?php /**PATH C:\Users\daw\Documents\GitHub\CloverFit\my-app\resources\views/layouts/app.blade.php ENDPATH**/ ?>