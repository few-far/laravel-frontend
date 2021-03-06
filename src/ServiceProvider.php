<?php

namespace FewFar\LaravelFrontend;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

class ServiceProvider extends BaseServiceProvider
{
    use Concerns\InteractsWithConfigProvider;

    /**
     * Define the routes for the Frontend Build if not in production.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../publishes/config/laravel-frontend.php' => config_path('vendor/fewfar/laravel-frontend.php'),
        ], 'config');

        $this->publishes([
            __DIR__.'/../publishes/resources/views/app/templates.blade.php' => resource_path('views/app/templates.blade.php'),
            __DIR__.'/../publishes/resources/views/templates/example.blade.php' => resource_path('views/templates/example.blade.php'),
        ], 'templates');

        $this->publishes([
            __DIR__.'/../publishes/tests/Feature/FrontendTemplatesTest.php' => base_path('tests/Feature/FrontendTemplatesTest.php'),
        ], 'tests');

        $this->mergeConfigFrom(
            __DIR__.'/../publishes/config/laravel-frontend.php', 'vendor.fewfar.laravel-frontend'
        );

        $this->configProvider = $this->app->make(ConfigProvider::class);

        if ($this->configProvider->get('enabled')) {
            $this->mapRoutes();
        }
    }

    /**
     * Define the "frontend" routes for the application. Uses the RouteProvider
     * to define the route context (url prefix, middleware etc.)
     *
     * @return void
     */
    protected function mapRoutes()
    {
        $prefix = $this->getRoutePath();
        $middleware = $this->configProvider->get('middleware');

        $context = Route::prefix($prefix)->middleware($middleware)->group(function () {
            $routeName = $this->configProvider->get('route_name');
            $echoPath = $this->configProvider->get('echo_path') ?: 'echo';

            Route::get('/', TemplateController::class . '@index')
                ->name($routeName . '.index');

            Route::any('/' . $echoPath, TemplateController::class . '@echo')
                ->name($routeName . '.echo');

            Route::any('/{template}', TemplateController::class . '@show')
                ->where('template', '.+$')
                ->name($routeName . '.show');
        });
    }
}
