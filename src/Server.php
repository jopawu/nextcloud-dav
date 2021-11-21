<?php

/* Copyright (c) 1998-2019 ILIAS open source, Extended GPL, see docs/LICENSE */

namespace iit\Nextcloud\DAV;

use Sabre\DAV\Client as DavClient;
use iit\Nextcloud\DAV\Filesystem\Path;
use iit\Nextcloud\DAV\Helpers\PathString;

/**
 * @author      Björn Heyser <info@bjoernheyser.de>
 */
class Server
{
    use PathString;

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
     * @param string $baseUri
     * @param string $userName
     * @param string $userPass
     */
    public function __construct($baseUri, $userName, $userPass)
    {
        $this->baseUri = $this->trimTrailingSlashes($baseUri);
        $this->userName = $userName;
        $this->userPass = $userPass;
    }

    /**
     * @return string
     */
    public function getBaseUri()
    {
        return $this->baseUri;
    }

    /**
     * @return string
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @return string
     */
    public function getUserPass()
    {
        return $this->userPass;
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
}
