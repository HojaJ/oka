<?php

namespace App\Providers;

use App\Models\Image;
use App\Models\Page;
use App\Models\Paragraph;
use App\Models\Policy;
use App\Models\Section;
use App\Models\Unit;
use App\Observers\GlobalObserver;
use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        self::registerGlobalObserver();
    }

    private static function registerGlobalObserver()
    {
        /** @var \Illuminate\Database\Eloquent\Model[] $MODELS */
        $MODELS = [
            Page::class,
            Paragraph::class,
            Policy::class,
            Section::class,
            Unit::class,
        ];

        foreach ($MODELS as $MODEL) {
            $MODEL::observe(GlobalObserver::class);
        }
    }
}
