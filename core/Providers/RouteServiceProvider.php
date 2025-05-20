<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
class RouteServiceProvider extends ServiceProvider
{
    /**
     * @var string
     */
    public const HOME = '/messenger';

    /**
     * @return void
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
        $this->routes(function () {
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}
