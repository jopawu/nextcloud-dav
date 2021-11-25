<?php

/* Copyright (c) 1998-2019 ILIAS open source, Extended GPL, see docs/LICENSE */

namespace iit\Nextcloud\DAV\Filesystem;

use iit\Nextcloud\DAV\Server as NcServer;
use iit\Nextcloud\DAV\Filesystem\Query\ListDirectoryRequest;
use iit\Nextcloud\DAV\Filesystem\Query\QuotaReportRequest;
use iit\Nextcloud\DAV\Filesystem\DTO\Directory;
use iit\Nextcloud\DAV\Filesystem\DTO\Quota;
use iit\Nextcloud\DAV\Filesystem\DTO\File;
use iit\Nextcloud\DAV\Filesystem\Query\GetFileContentRequest;

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
    protected function options()
    {
        $davClient = $this->server->getDavClient();
        return $davClient->options();
    }

    /**
     * @return mixed
     */
    protected function get()
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
     * @param string   $path
     * @param int|null $depth
     * @return Directory
     */
    public function listDirectory(string $path, int $depth = PHP_INT_MAX) : Directory
    {
        $path = new Path($this->server, $path);
        $request = new ListDirectoryRequest($this->server, $path, $depth);
        $response = $request->perform();
        return $response->parse();
    }

    public function createDirectoryWIP() : void
    {

    }

    public function deleteDirectoryWIP() : void
    {

    }

    /**
     * @param string $path
     * @return File
     */
    public function readFile(string $path) : File
    {
        $path = new Path($this->server, $path);
        $request = new GetFileContentRequest($this->server, $path);
        $response = $request->perform();
        return $response->parse();
    }

    public function createFileWIP() : void
    {

    }

    public function deleteFileWIP() : void
    {

    }

    public function moveItemWIP() : void
    {

    }

    public function renameItemWIP() : void
    {

    }
}
