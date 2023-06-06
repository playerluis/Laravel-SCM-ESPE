<?php

namespace App\Providers;

use App\Utils\Pagina;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        //
    }

    public function boot(): void
    {

        app()->singleton('paginas', function () {
            return Pagina::obtenerPaginas();
        });

        view()->share("paginas", Pagina::obtenerPaginas());
    }
}
