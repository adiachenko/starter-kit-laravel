<?php

declare(strict_types=1);

namespace App\Providers;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Sleep;

class AppServiceProvider extends ServiceProvider
{
    #[\Override]
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Date::use(CarbonImmutable::class);

        DB::prohibitDestructiveCommands(app()->isProduction());

        Model::unguard();
        Model::preventLazyLoading();
        Model::preventSilentlyDiscardingAttributes();
        Model::preventAccessingMissingAttributes();

        if (App::environment('testing')) {
            Sleep::fake();
            Http::preventStrayRequests();
        }
    }
}
