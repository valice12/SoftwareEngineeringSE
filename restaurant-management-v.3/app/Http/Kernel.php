protected $routeMiddleware = [
    'staff' => \App\Http\Middleware\Authenticate::class,
    'staff.role' => \App\Http\Middleware\CheckStaffRole::class,
];