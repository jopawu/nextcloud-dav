<?php

/* Copyright (c) 1998-2019 ILIAS open source, Extended GPL, see docs/LICENSE */

namespace iit\Nextcloud\DAV;

use Sabre\DAV\Client as DavClient;

/**
 * @author      Björn Heyser <info@bjoernheyser.de>
 */
class Server
{
    /**
     * @var string
     */
    protected $baseUri = null;

    /**
     * @var string
     */
    protected $userName = null;

    /**
     * @var string
     */
    protected $userPass = null;

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
