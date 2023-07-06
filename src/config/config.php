<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Env Variable for HTML_MINIFY
    |--------------------------------------------------------------------------
    |
    | Set this value to the false if you don't need html minify
    | this is by default "true"
    |
    */
    'default' => env('HTML_MINIFY', true),

    // exclude route name for exclude from minify
    'exclude_route' => [
        // 'routeName'
    ]
];
