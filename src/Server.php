<?php

/* Copyright (c) 1998-2019 ILIAS open source, Extended GPL, see docs/LICENSE */

namespace iit\Nextcloud\DAV;

use Sabre\DAV\Client as DavClient;
use iit\Nextcloud\DAV\Filesystem\Path;

/**
 * @author      Björn Heyser <info@bjoernheyser.de>
 */
class Server
{
    const FILESYSTEM_BASE_PATH_FORMAT_PATTERN = 'files/%s';

    /**
     * @var string
     */
    protected $baseUri;

    /**
     * @var string
     */
    protected $userName;

    /**
     * @var string
     */
    protected $userPass;

    /**
     * @var string
     */
    protected $filesystemBasePath;

    /**
     * @param string $baseUri
     * @param string $userName
     * @param string $userPass
     */
    public function __construct($baseUri, $userName, $userPass)
    {
        $this->baseUri = $baseUri;
        $this->userName = $userName;
        $this->userPass = $userPass;

        $this->filesystemBasePath = sprintf(
            self::FILESYSTEM_BASE_PATH_FORMAT_PATTERN, $this->getUserName()
        );
    }

    /**
     * @return string
     */
    protected function getBaseUri()
    {
        return $this->baseUri;
    }

    /**
     * @return string
     */
    protected function getUserName()
    {
        return $this->userName;
    }

    /**
     * @return string
     */
    protected function getUserPass()
    {
        return $this->userPass;
    }

    /**
     * @return string
     */
    protected function getFilesystemBasePath()
    {
        return $this->filesystemBasePath;
    }

    /**
     * @return DavClient
     */
    public function getDavClient()
    {
        return new DavClient([
            'baseUri' => $this->getBaseUri(),
            'userName' => $this->getUserName(),
            'password' => $this->getUserPass()
        ]);
    }

    /**
     * @param string $path
     * @return string
     */
    public function buildFilesystemPath($path)
    {
        $path = Path::trimSlashes($path);

        if( !strlen($path) )
        {
            return $this->getFilesystemBasePath();
        }

        return $this->getFilesystemBasePath() . '/' . $path;
    }
}
