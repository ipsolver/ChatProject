<?php

namespace App\Providers;

use App\Brokers\JanusBroker;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use RTippin\Messenger\Facades\Messenger;
use RTippin\Messenger\Facades\MessengerBots;
use Illuminate\Support\Facades\Schema;
/**
 * Laravel Messenger System.
 *
 */
class MessengerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
         Schema::defaultStringLength(191);
        Relation::morphMap([
            'users' => User::class,
        ]);

        Messenger::registerProviders([
            User::class,
        ]);
    }
}
