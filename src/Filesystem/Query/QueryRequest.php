<?php

namespace iit\Nextcloud\DAV\Filesystem\Query;

use iit\Nextcloud\DAV\Helpers\DavProperties;
use iit\Nextcloud\DAV\Server;

/**
 * @author      Björn Heyser <info@bjoernheyser.de>
 */
abstract class QueryRequest
{
    /**
     * @var Server
     */
    protected $server;

    /**
     * @param Server $server
     */
    public function __construct(Server $server)
    {
        $this->server = $server;
    }

    /**
     * @return QueryResponse
     */
    abstract public function perform() : QueryResponse;
}
