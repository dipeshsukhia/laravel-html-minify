<?php
namespace DipeshSukhia\LaravelHtmlMinify\Middleware;

use Closure;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use DipeshSukhia\LaravelHtmlMinify\LaravelHtmlMinifyFacade;

class LaravelMinifyHtml
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if (
            Config::get('htmlminify.default') &&
            $this->isResponseObject($response) &&
            $this->isHtmlResponse($response) &&
            !$this->isRouteExclude($request) &&
            ( $response->isSuccessful() || App::isProduction() )
        ) {
            $response->setContent(LaravelHtmlMinifyFacade::htmlMinify($response->getContent()));
        }
        return $response;
    }

    protected function isResponseObject($response)
    {
        return is_object($response) && $response instanceof Response;
    }

    protected function isHtmlResponse(Response $response)
    {
        return strtolower(strtok($response->headers->get('Content-Type'), ';')) === 'text/html';
    }

    protected function isRouteExclude($request)
    {
        return $request->route() && in_array($request->route()->getName(),config('htmlminify.exclude_route', []));
    }
}
