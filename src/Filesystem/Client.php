<?php

/* Copyright (c) 1998-2019 ILIAS open source, Extended GPL, see docs/LICENSE */

namespace iit\Nextcloud\DAV\Filesystem;

use iit\Nextcloud\DAV\Server as NcServer;
use iit\Nextcloud\DAV\Filesystem\Query\ListDirectoryRequest;
use iit\Nextcloud\DAV\Filesystem\Query\QuotaReportRequest;
use iit\Nextcloud\DAV\Filesystem\DTO\Directory;
use iit\Nextcloud\DAV\Filesystem\DTO\Quota;

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
     * @return mixed
     */
    public function options()
    {
        $davClient = $this->server->getDavClient();
        return $davClient->options();
    }

    /**
     * @return mixed
     */
    public function get()
    {
        $davClient = $this->server->getDavClient();
        return $davClient->request('GET');
    }

    /**
     * @return Quota
     */
    public function quotaReport() : Quota
    {
        $request = new QuotaReportRequest($this->server);
        $response = $request->perform();
        return $response->parse();
    }

    /**
     * @param string $path
     * @return Directory
     */
    public function listDirectory(string $path) : Directory
    {
        $path = new Path($this->server, $path);
        $request = new ListDirectoryRequest($this->server, $path);
        $response = $request->perform();
        return $response->parse();
    }
}
