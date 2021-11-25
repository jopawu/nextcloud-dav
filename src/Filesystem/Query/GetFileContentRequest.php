<?php

namespace iit\Nextcloud\DAV\Filesystem\Query;

use iit\Nextcloud\DAV\Filesystem\Path;
use iit\Nextcloud\DAV\Server;
use iit\Nextcloud\DAV\Helpers\DavProperties;

/**
 * @author      Björn Heyser <info@bjoernheyser.de>
 */
class GetFileContentRequest extends QueryRequest
{
    /**
     * @var Path
     */
    protected $path;

    /**
     * @param Server $server
     * @param Path $path
     */
    public function __construct(Server $server, Path $path)
    {
        parent::__construct($server);
        $this->path = $path;
    }

    /**
     * @return QueryResponse
     */
    public function perform() : QueryResponse
    {
        $davClient = $this->server->getDavClient();
        $davResponse = $davClient->request('GET', (string)$this->path);
        return new GetFileContentResponse($davResponse);
    }
}
