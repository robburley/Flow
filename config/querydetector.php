<?php

return [
    /*
     * Enable or disable the query detection.
     * If this is set to "null", the app.debug config value will be used.
     */
    'enabled' => env('QUERY_DETECTOR_ENABLED', null),

    /*
     * Here you can whitelist model relations.
     *
     * Right now, you need to define the model relation both as the class name and the attribute name on the model.
     * So if an "Author" model would have a "posts" relation that points to a "Post" class, you need to add both
     * the "posts" attribute and the "Post::class", since the relation can get resolved in multiple ways.
     */
    'except'  => [
        \App\Models\Note::class => [
            \App\Models\User::class,
            'user',
        ],
    ],

    /*
     * Define the output formats that you want to use.
     * Available options are:
     *
     * Alert:
     * Displays an alert on the website
     * \BeyondCode\QueryDetector\Outputs\Alert::class
     *
     * Debugbar: (make sure you have the barryvdh/laravel-debugbar package installed)
     * Writes the N+1 queries into a custom messages collector of Debugbar
     * \BeyondCode\QueryDetector\Outputs\Debugbar::class
     *
     * Log:
     * Writes the N+1 queries into the Laravel.log file
     * \BeyondCode\QueryDetector\Outputs\Log::class
     */
    'output'  => [
        \BeyondCode\QueryDetector\Outputs\Debugbar::class,
        \BeyondCode\QueryDetector\Outputs\Console::class,
    ],
];
