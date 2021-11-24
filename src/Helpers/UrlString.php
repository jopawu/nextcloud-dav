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
}
