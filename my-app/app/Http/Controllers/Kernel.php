protected $routeMiddleware = [
    // Otros middlewares...
    'role' => \App\Http\Middleware\CheckRole::class,
];
