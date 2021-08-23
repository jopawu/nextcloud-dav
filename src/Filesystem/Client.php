<?php

/* Copyright (c) 1998-2019 ILIAS open source, Extended GPL, see docs/LICENSE */

namespace iit\Nextcloud\DAV\Filesystem;

use iit\Nextcloud\DAV\Server;

/**
 * @author      Björn Heyser <info@bjoernheyser.de>
 */
class Client
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
     * @param string $path
     * @return mixed
     */
    public function listDirectory($path = '')
    {
        return 'hello world';
    }
}
