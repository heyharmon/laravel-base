<?php

namespace DDD\App\Services\Url;

class UrlService
{
    /*
     * Get all url parts
     */
    public function getAll($url)
    {
        return $url_parts = [
            'url' => $url,
            'clean' => $this->getClean($url),
            'scheme' => $this->getScheme($url),
            'host' => $this->getHost($url),
            'domain' => $this->getDomain($url),
            'path' => $this->getPath($url),
        ];
    }

    /*
     * Get clean url
     *
     * e.g., "https://google.com?foo=bar#hash" to "https://google.com"
     */
    public static function getClean($url)
    {
        $clean = explode('?', $url)[0];
        $clean = explode('#', $clean)[0];

        return $clean;
    }

    /*
     * Get url scheme
     *
     * e.g., "https"
     */
    public static function getScheme($url)
    {
        if (isset(parse_url($url)['scheme'])) {
            return parse_url($url)['scheme'];
        }

        // No scheme in $url
        return '';
    }

    /*
     * Get url host
     *
     * e.g., "www.heyharmon.com"
     */
    public static function getHost($url)
    {
        if (isset(parse_url($url)['host'])) {
            return parse_url($url)['host'];
        }

        // No host in $url
        return '';
    }

    /*
     * Get url domain
     *
     * e.g., "heyharmon.com"
     */
    public static function getDomain($url)
    {
        // Extract the domain
        if (isset(parse_url($url)['host'])) {
            if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', parse_url($url)['host'], $regs)) {

                // Return the domain
                return $regs['domain'];
            }

            // No host in $url
            return '';
        }

        // No domain in $url
        return '';
    }

    /*
     * Get url path
     *
     * e.g., "/foo/bar"
     */
    public static function getPath($url)
    {
        if (isset(parse_url($url)['path'])) {
            return parse_url($url)['path'];
        }

        // No path in $url
        return '';
    }
}
