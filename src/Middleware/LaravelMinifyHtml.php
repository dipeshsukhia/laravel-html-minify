<?php
namespace DipeshSukhia\LaravelHtmlMinify\Middleware;

use Closure;
use Illuminate\Http\Response;
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
            $this->isResponseObject($response) &&
            $this->isHtmlResponse($response) &&
            Config::get('htmlminify.default') &&
            !$this->isRouteExclude($request) &&
            !$this->isErrorServer($response)
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
        if (!$request->route()) {
            return false;
        }
        return in_array($request->route()->getName(), config('htmlminify.exclude_route', []));
    }

    protected function isErrorServer($response): bool
    {
        return in_array($response->getStatusCode(), config('htmlminify.status_server_error', []));
    }
}
