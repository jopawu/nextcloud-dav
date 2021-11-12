<?php

/* Copyright (c) 1998-2019 ILIAS open source, Extended GPL, see docs/LICENSE */

namespace iit\Nextcloud\DAV\Filesystem;

use iit\Nextcloud\DAV\Server as NcServer;

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
    public function listDirectory($path)
    {
        $path = new Path($this->server, $path);

        $davClient = $this->server->getDavClient();

        return $davClient->propFind((string)$path, array(
            '{DAV:}resourcetype',
            //'{DAV:}permissions',
            '{DAV:}getlastmodified',
            '{DAV:}getcontenttype',
            '{DAV:}getcontentlength',
            '{DAV:}getetag'
        ), 1);
    }

    /**
     * @return mixed
     */
    public function get()
    {
        $davClient = $this->server->getDavClient();
        return $davClient->request('GET');
    }
}
