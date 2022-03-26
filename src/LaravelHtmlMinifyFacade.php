<?php

namespace DipeshSukhia\LaravelHtmlMinify;

use Illuminate\Support\Facades\Facade;

/**
 * @see \DipeshSukhia\LaravelHtmlMinify\Skeleton\SkeletonClass
 */
class LaravelHtmlMinifyFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-html-minify';
    }

    public static function htmlMinify($html = null)
    {
        return (new LaravelHtmlMinify())->htmlMinify($html);
    }
}
