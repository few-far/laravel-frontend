<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Enabled
    |--------------------------------------------------------------------------
    |
    | Turns the frontend routes on. You should ensure this is set to false in
    | production environments.
    |
    */
    'enabled' => env('FRONTEND_ENABLED', false),

    /*
    |--------------------------------------------------------------------------
    | Route Name
    |--------------------------------------------------------------------------
    |
    | Name prefix of the routes defined by the package, e.g.:
    |
    | route('templates.index')
    |
    */
    'route_name' => 'templates',

    /*
    |--------------------------------------------------------------------------
    | Route Path
    |--------------------------------------------------------------------------
    |
    | URL path prefix of the  routes defined by the package, e.g.:
    |
    | /templates/
    |
    */
    'route_path' => 'templates',

    /*
    |--------------------------------------------------------------------------
    | Resource Path
    |--------------------------------------------------------------------------
    |
    | Path prefix within the resources/views/ folder that the package looks for
    | the templates templates.
    |
    */
    'resource_path' => 'templates',

    /*
    |--------------------------------------------------------------------------
    | Index Template Path
    |--------------------------------------------------------------------------
    |
    | Path to the index template that lists out all the others, from the
    | resources/views/ folder.
    |
    */
    'index_template_path' => 'app.templates',

    /*
    |--------------------------------------------------------------------------
    | View Composer Template Flag
    |--------------------------------------------------------------------------
    |
    | Variable to check for in the View's data when the View Composer is
    | loading Page Defaults when rendering frontend tempaltes.
    |
    */
    'template_flag' => '__frontend',


    /*
    |--------------------------------------------------------------------------
    | Echo route path
    |--------------------------------------------------------------------------
    |
    | Path to use when building the TemplateController's echo route.
    |
    */
    'echo_path' => 'echo',

    /*
    |--------------------------------------------------------------------------
    | Route Middleware
    |--------------------------------------------------------------------------
    |
    | Middlewares to run when adding frontend routes.
    |
    */
    'middleware' => [ 'web' ],

];
