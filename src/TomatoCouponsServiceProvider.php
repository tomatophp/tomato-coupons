<?php

namespace TomatoPHP\TomatoCoupons;

use Illuminate\Support\ServiceProvider;
use TomatoPHP\TomatoAdmin\Facade\TomatoMenu;
use TomatoPHP\TomatoAdmin\Services\Contracts\Menu;


class TomatoCouponsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //Register generate command
        $this->commands([
           \TomatoPHP\TomatoCoupons\Console\TomatoCouponsInstall::class,
        ]);

        //Register Config file
        $this->mergeConfigFrom(__DIR__.'/../config/tomato-coupons.php', 'tomato-coupons');

        //Publish Config
        $this->publishes([
           __DIR__.'/../config/tomato-coupons.php' => config_path('tomato-coupons.php'),
        ], 'tomato-coupons-config');

        //Register Migrations
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        //Publish Migrations
        $this->publishes([
           __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'tomato-coupons-migrations');
        //Register views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'tomato-coupons');

        //Publish Views
        $this->publishes([
           __DIR__.'/../resources/views' => resource_path('views/vendor/tomato-coupons'),
        ], 'tomato-coupons-views');

        //Register Langs
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'tomato-coupons');

        //Publish Lang
        $this->publishes([
           __DIR__.'/../resources/lang' => base_path('lang/vendor/tomato-coupons'),
        ], 'tomato-coupons-lang');

        //Register Routes
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

    }

    public function boot(): void
    {
        TomatoMenu::register([
            Menu::make()
                ->group(__('Offers'))
                ->label(__('Coupons'))
                ->icon('bx bxs-discount')
                ->route('admin.coupons.index'),
            Menu::make()
                ->group(__('Offers'))
                ->label(__('Gift Cards'))
                ->icon('bx bx-gift')
                ->route('admin.gift-cards.index'),
            Menu::make()
                ->group(__('Offers'))
                ->label(__('Referral Codes'))
                ->icon('bx bx-link')
                ->route('admin.referral-codes.index')
        ]);
    }
}
