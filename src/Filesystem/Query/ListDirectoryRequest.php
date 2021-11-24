<?php

namespace iit\Nextcloud\DAV\Filesystem\Query;

use iit\Nextcloud\DAV\Server;
use iit\Nextcloud\DAV\Filesystem\Path;
use iit\Nextcloud\DAV\Helpers\DavProperties;

/**
 * @author      Björn Heyser <info@bjoernheyser.de>
 */
class ListDirectoryRequest extends QueryRequest
{
    /**
     * @var Server
     */
    protected $server;

    /**
     * @var Path
     */
    protected $path;

    /**
     * @param Server $server
     */
    public function __construct(Server $server, Path $path)
    {
        $this->server = $server;
        $this->path = $path;
    }

    public function perform() : QueryResponse
    {
        $davClient = $this->server->getDavClient();
        $davResponse = $davClient->propFind((string)$this->path, DavProperties::getItemProperties(), 1);
        return new ListDirectoryResponse($this->server, $this->path, $davResponse);
    }

}
