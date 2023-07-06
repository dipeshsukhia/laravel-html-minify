<?php

namespace DipeshSukhia\LaravelHtmlMinify;

use Illuminate\Support\Facades\Facade;

class LaravelHtmlMinifyFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'laravel-html-minify';
    }

    /**
     * @param $html
     * @return array|string|null
     */
    public static function htmlMinify($html = null): array|string|null
    {
        return (new LaravelHtmlMinify())->htmlMinify($html);
    }
}
