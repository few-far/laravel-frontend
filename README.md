<p align="center"><img src="logo.svg" width="474px" alt="Laravel Frontend" /></p>

<p align="center">
<a href="https://travis-ci.org/few-far/laravel-frontend"><img src="https://travis-ci.org/few-far/laravel-frontend.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/few-far/laravel-frontend"><img src="https://poser.pugx.org/few-far/laravel-frontend/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/few-far/laravel-frontend"><img src="https://poser.pugx.org/few-far/laravel-frontend/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/few-far/laravel-frontend"><img src="https://poser.pugx.org/few-far/laravel-frontend/license.svg" alt="License"></a>
</p>

Laravel package to provide frontend template routes for non-production environments.

## Installation

```sh
composer require fewfar/laravel-frontend
```

The package's service provider will be autoloaded on startup.

Next publish the templates and config file:

```sh
php artisan vendor:publish --provider="FewFar\LaravelFrontend\ServiceProvider"
```

The files published this way are examples of structure and are not enforced by the package. Edit `config/vendor/fewfar/frontend.php` to change the paths of these files.

## Basic Usage

Add the following key to your `.env` file to enable the frontend routes (typically, local and staging):

```sh
FRONTEND_ENABLED=true
```

If this key is already in use for your project, you can change this in the `config/vendor/fewfar/frontend.php` file.

Now you can visit `/templates/` and see the templates.

## Page Defaults

Often within an app, it is useful to have view composers that load fallback variables from a configuration or the database when not provided by the controller explicitly. An example of this could be the page title in the HTML `<head>` for example. Depending on the setup you might not have a database defined when building the frontend templates, or you might not even want the database involved. In this case you still want your layout templates to recieve this variables, but it would be nice to hard code them for all the frontend templates.

To do this you can subclass the `PageDefaultsViewComposer` and add register it within a service provider:

### Subclass the View Composer implementing your own values

```
<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

use FewFar\LaravelFrontend\PageDefaultsViewComposer as BaseViewComposer;

class PageDefaultsViewComposer extends BaseViewComposer
{
    /**
     * Gets frontend default variables.
     *
     * @return array
     */
    protected function defaultsForFrontend()
    {
        return [
            'page' => [
                'title' => 'HTML Meta Title',
                'description' => 'HTML Meta Description',
                ...
            ],
        ];
    }

    /**
     * Gets application default variables (i.e. ones used when not in the
     * frontend templates.)
     *
     * @return array
     */
    protected function defaultsForApp()
    {
        return [
            'page' => [
                'title' => config('app.name'),
                ...
            ],
        ];
    }
}
```

### Register your View Composer

```
<?php

namespace App\Http\ViewComposers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

use App\Http\ViewComposers\PageDefaultsViewComposer;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        // Here the 'app/' directory is assumed to be all the individual pages,
        // and does not contain partials, or layouts. This is because the
        // composer will be ran multiple times if the Blade template extends
        // from files also in the 'app/' directory.
        View::composer('app/*', PageDefaultsViewComposer::class);
    }
}
```

## Config Customisation

This package uses [Laravel Config Provider](https://github.com/engageinteractive/laravel-config-provider) to allow you customise how we interact with config, you can find more details over there on how to customise it there.
## Laravel Compatibility

Tested with Laravel 7.

## Development

This package provides a docker setup to develop and test itself. From the root of this directory you can run:

```
$ scripts/composer install
$ scripts/test
```


## License

Laravel Frontend is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
