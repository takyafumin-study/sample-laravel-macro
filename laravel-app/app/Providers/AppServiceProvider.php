<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\ServiceProvider;

/**
 * @method void update()
 * @method void delete()
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Factory::guessFactoryNamesUsing(function (string $modelName) {
            return "Database\\Factories\\" . class_basename($modelName) . "Factory";
        });

        $this->extendsBuilder();
    }

    /**
     * Eloquent Builder拡張定義
     *
     * @return void
     */
    private function extendsBuilder()
    {
        // Builder::macro('updateWithWho', function ($attributes = []) {
        //     $attributes['updated_by'] = Auth()->user->id ?? 0;
        //     return $this->update($attributes);
        // });

        // Builder::macro('deleteWithWho', function () {
        //     $this->update(['deleted_by' => Auth()->user->id ?? 0]);
        //     return $this->delete();
        // });
    }
}
