<?php

namespace iit\Nextcloud\DAV\Filesystem\Query;

use iit\Nextcloud\DAV\Helpers\DavProperties;

/**
 * @author      Björn Heyser <info@bjoernheyser.de>
 */
abstract class QueryRequest
{
    /**
     * @return QueryResponse
     */
    abstract public function perform() : QueryResponse;
}
