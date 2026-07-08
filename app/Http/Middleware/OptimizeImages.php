<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\ImageOptimizer;

class OptimizeImages
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if (!($response instanceof Response)) {
            return $response;
        }

        $contentType = $response->headers->get('Content-Type');
        if (!$contentType || stripos($contentType, 'text/html') === false) {
            return $response;
        }

        $content = $response->getContent();
        if (!is_string($content) || $content === '') {
            return $response;
        }

        $content = $this->addLazyLoading($content);
        $content = $this->rewriteSrcToWebp($content, $request);

        $response->setContent($content);

        return $response;
    }

    /**
     * Add loading="lazy" to img tags that do not already include a loading attribute.
     *
     * @param string $content
     * @return string
     */
    protected function addLazyLoading(string $content): string
    {
        return preg_replace_callback('/<img\b(?![^>]*\bloading=)([^>]*)>/i', function ($matches) {
            return '<img loading="lazy"' . $matches[1] . '>';
        }, $content);
    }

    /**
     * Rewrite local image src URLs to WebP when a cached WebP file exists.
     *
     * @param string $content
     * @param \Illuminate\Http\Request $request
     * @return string
     */
    protected function rewriteSrcToWebp(string $content, Request $request): string
    {
        $acceptsWebp = stripos($request->header('Accept', ''), 'image/webp') !== false;
        if (!$acceptsWebp) {
            return $content;
        }

        return preg_replace_callback('/<img\b([^>]*?)\bsrc=("|\\\')([^"\']+\.(?:jpe?g|png|gif))(\2)([^>]*)>/i', function ($matches) use ($request) {
            $src = $matches[3];
            $webpUrl = ImageOptimizer::resolveWebpUrl($src, $request);
            if (!$webpUrl) {
                return $matches[0];
            }

            return str_replace($src, $webpUrl, $matches[0]);
        }, $content);
    }
}
