<?php

namespace DipeshSukhia\LaravelHtmlMinify\Middleware;

use Closure;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use DipeshSukhia\LaravelHtmlMinify\LaravelHtmlMinifyFacade;

class LaravelMinifyHtml
{
    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next): mixed
    {
        $response = $next($request);

        if (
            Config::get('htmlminify.default') &&
            $this->isResponseObject($response) &&
            $this->isHtmlResponse($response) &&
            !$this->isRouteExclude($request) &&
            ($response->isSuccessful() || App::isProduction())
        ) {
            $response->setContent(LaravelHtmlMinifyFacade::htmlMinify($response->getContent()));
        }
        return $response;
    }

    /**
     * @param $response
     * @return bool
     */
    protected function isResponseObject($response): bool
    {
        return is_object($response) && $response instanceof Response;
    }

    /**
     * @param Response $response
     * @return bool
     */
    protected function isHtmlResponse(Response $response): bool
    {
        return strtolower(strtok($response->headers->get('Content-Type'), ';')) === 'text/html';
    }

    /**
     * @param $request
     * @return bool
     */
    protected function isRouteExclude($request): bool
    {
        return $request->route() && in_array($request->route()->getName(), Config::get('htmlminify.exclude_route', []));
    }
}
