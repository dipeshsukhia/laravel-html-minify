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
            Config::get('htmlminify.default') &&
            $this->isResponseObject($response) &&
            $this->isHtmlResponse($response) &&
            !$this->isServerError($response) &&
            !$this->isRouteExclude($request)
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
        return $request->route() && in_array($request->route()->getName(),config('htmlminify.exclude_route', []));
    }

    /**
     * @param Response $response
     * @return bool
     */
    protected function isServerError(Response $response): bool
    {
        return in_array($response->getStatusCode(), [
            Response::HTTP_INTERNAL_SERVER_ERROR,
            Response::HTTP_NOT_IMPLEMENTED,
            Response::HTTP_BAD_GATEWAY,
            Response::HTTP_SERVICE_UNAVAILABLE,
            Response::HTTP_GATEWAY_TIMEOUT,
            Response::HTTP_VERSION_NOT_SUPPORTED,
            Response::HTTP_VARIANT_ALSO_NEGOTIATES_EXPERIMENTAL,
            Response::HTTP_INSUFFICIENT_STORAGE,
            Response::HTTP_LOOP_DETECTED,
            Response::HTTP_NOT_EXTENDED,
            Response::HTTP_NETWORK_AUTHENTICATION_REQUIRED,
        ]);
    }
}
