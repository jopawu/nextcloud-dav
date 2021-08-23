<?php

/* Copyright (c) 1998-2019 ILIAS open source, Extended GPL, see docs/LICENSE */

namespace iit\Nextcloud\DAV\Filesystem;

use iit\Nextcloud\DAV\Server as NcServer;
use Sabre\DAV\Client as DavClient;

/**
 * @author      Björn Heyser <info@bjoernheyser.de>
 */
class Client
{
    /**
     * @var NcServer
     */
    protected $server;

    /**
     * @param NcServer $server
     */
    public function __construct(NcServer $server)
    {
        $this->server = $server;
    }

    /**
     * @param string $path
     * @return mixed
     */
    public function listDirectory($path = '')
    {
        $davClient = $this->server->getDavClient();

        return $davClient->options();
    }
}
