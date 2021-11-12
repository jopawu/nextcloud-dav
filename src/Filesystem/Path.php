<?php

/* Copyright (c) 1998-2019 ILIAS open source, Extended GPL, see docs/LICENSE */

namespace iit\Nextcloud\DAV\Filesystem;

use iit\Nextcloud\DAV\Server;

/**
 * @author      Björn Heyser <info@bjoernheyser.de>
 */
class Path
{
    const FILESYSTEM_BASE_PATH_FORMAT_PATTERN = '%s/files/%s';

    /**
     * @var string
     */
    protected $filesystemBasePath;

    /**
     * @var string
     */
    protected $path;

    /**
     * @param Server $server
     * @param string $path
     */
    public function __construct(Server $server, $path)
    {
        $this->path = $this->trimSlashes($path);
        $this->filesystemBasePath = $this->buildFilesystemBasePath($server);
    }

    /**
     * @param string $path
     * @return string
     */
    protected function trimSlashes($path) : string
    {
        return trim($path ,'/');
    }

    /**
     * @param Server $server
     * @return string
     */
    protected function buildFilesystemBasePath(Server $server) : string
    {
        return sprintf(
            self::FILESYSTEM_BASE_PATH_FORMAT_PATTERN, $server->getBaseUri(), $server->getUserName()
        );
    }

    /**
     * @return string
     */
    public function getFilesystemPath() : string
    {
        if( !strlen($this->path) )
        {
            return $this->filesystemBasePath;
        }

        return $this->filesystemBasePath . '/' . $this->path;
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return $this->getFilesystemPath();
    }

}
