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
     * @var Path
     */
    protected $path;

    /**
     * @var int
     */
    protected $depth;

    /**
     * @param Server   $server
     * @param Path     $path
     * @param int|null $depth
     */
    public function __construct(Server $server, Path $path, int $depth = null)
    {
        parent::__construct($server);
        $this->path = $path;
        $this->depth = $depth;
    }

    public function perform() : QueryResponse
    {
        $davClient = $this->server->getDavClient();
        $davResponse = $davClient->propFind((string)$this->path, DavProperties::getItemProperties(), $this->depth);
        return new ListDirectoryResponse($this->server, $this->path, $davResponse);
    }

}
