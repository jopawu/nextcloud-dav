<?php

namespace iit\Nextcloud\DAV\Helpers;

/**
 * @author      Björn Heyser <info@bjoernheyser.de>
 */
trait UrlString
{
    /**
     * @param string $fqdn
     * @return string
     */
    protected function fetchUrlsRelativeRessourcePath(string $fqdn) : string
    {
        $pos = strpos($fqdn, '//');
        $pos = strpos($fqdn, '/', $pos + 2);
        return substr($fqdn, $pos);
    }

    /**
     * @param string $fqdn
     * @return string
     */
    protected function fetchUrlsServerDomainPath(string $fqdn) : string
    {
        $pos = strpos($fqdn, '//');
        $pos = strpos($fqdn, '/', $pos + 2);
        return substr($fqdn, 0, $pos);
    }

    /**
     * @param string $ressourcePath
     * @return string
     */
    protected function encodeRessourcePath(string $ressourcePath) : string
    {
        $ressourcePath = explode('/', $ressourcePath);

        foreach($ressourcePath as $key => $name)
        {
            $ressourcePath[$key] = rawurlencode($name);
        }

        return implode('/', $ressourcePath);
    }
}
