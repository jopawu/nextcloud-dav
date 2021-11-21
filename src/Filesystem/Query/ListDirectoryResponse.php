<?php

namespace iit\Nextcloud\DAV\Filesystem\Query;

use iit\Nextcloud\DAV\Filesystem\DTO\Directory;
use iit\Nextcloud\DAV\Helpers\DavProperties;

/**
 * @author      Björn Heyser <info@bjoernheyser.de>
 */
class ListDirectoryResponse extends QueryResponse
{
    /**
     * @param array $davResponse
     */
    protected function validateDavResponse(array $davResponse) : void
    {

    }

    /**
     * @return Directory
     */
    public function parse() : Directory
    {

    }
}
