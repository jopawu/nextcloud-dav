<?php

namespace iit\Nextcloud\DAV\Helpers;

trait PathString
{
    /**
     * @param string $pathString
     * @return string
     */
    protected function trimSlashes(string $pathString) : string
    {
        return trim($pathString ,'/');
    }

    /**
     * @param string $pathString
     * @return string
     */
    protected function trimTrailingSlashes(string $pathString) : string
    {
        return rtrim($pathString, '/');
    }
}