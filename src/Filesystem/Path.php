<?php

/* Copyright (c) 1998-2019 ILIAS open source, Extended GPL, see docs/LICENSE */

namespace iit\Nextcloud\DAV\Filesystem;

use iit\Nextcloud\DAV\Server;
use iit\Nextcloud\DAV\Helpers\PathString;
use iit\Nextcloud\DAV\Helpers\UrlString;

/**
 * @author      Björn Heyser <info@bjoernheyser.de>
 */
class Path
{
    use PathString;
    use UrlString;

    /**
     * @var Server
     */
    protected $server;

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
        $this->server = $server;
        $this->path = $this->trimSlashes($path);
    }

    /**
     * @return string
     */
    public function getPath() : string
    {
        return $this->path;
    }

    /**
     * @return string
     */
    protected function buildRelativeFilesystemBasePath() : string
    {
        return 'files/'.$this->server->getUserName();
    }

    /**
     * @return string
     */
    protected function buildAbsoluteFilesystemBaseFqdn() : string
    {
        return $this->server->getBaseUri().'/'.$this->buildRelativeFilesystemBasePath();
    }

    /**
     * @return string
     */
    public function getAbsoluteFqdn() : string
    {
        $absoluteFilesystemBaseFqdn = $this->buildAbsoluteFilesystemBaseFqdn();

        if( strlen($this->path) )
        {
            return $absoluteFilesystemBaseFqdn . '/' . $this->encodeRessourcePath($this->path);
        }

        return $absoluteFilesystemBaseFqdn;
    }

    /**
     * @param string $absoluteDavFilesystemPath
     * @return string
     */
    public function fetchRelativeDavRessourceFilePath(string $absoluteDavRessourcePath) : string
    {
        $absoluteFilesystemBaseFqdn = $this->buildAbsoluteFilesystemBaseFqdn();
        $relativeDavFilesystemBasePath = $this->fetchUrlsRelativeRessourcePath($absoluteFilesystemBaseFqdn);
        $relativeDavFilesystemPath = str_replace($relativeDavFilesystemBasePath, '', $absoluteDavRessourcePath);
        $relativeDavFilesystemPath = $this->trimTrailingSlashes($relativeDavFilesystemPath);
        return $relativeDavFilesystemPath;
    }

    /**
     * @param string $absoluteDavFilesystemPath
     * @return string
     */
    public function fetchRelativeDavRessourceDirectoryPath(string $absoluteDavRessourcePath) : string
    {
        return dirname($this->fetchRelativeDavRessourceFilePath($absoluteDavRessourcePath));
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return $this->getAbsoluteFqdn();
    }
}
