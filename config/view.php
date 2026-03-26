<?php

return [

    /*
    |--------------------------------------------------------------------------
    | View Storage Paths
    |--------------------------------------------------------------------------
    |
    | Most templating systems load templates from disk or from a string. Here you
    | may define where your view path directories are located. Laravel will
    | automatically load all of these view paths to find your views.
    |
    */

    'paths'    => [
        resource_path('views'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Compilation Storage Path
    |--------------------------------------------------------------------------
    |
    | If you wish to customize where Laravel will store the compiled views for
    | performance reasons, you may define this location below. Laravel will
    | automatically detect the proper permissions for this directory.
    |
    */

    'compiled' => env(
        'VIEW_COMPILED_PATH',
        realpath(storage_path('framework/views'))
    ),

];
