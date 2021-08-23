<?php

/* Copyright (c) 1998-2019 ILIAS open source, Extended GPL, see docs/LICENSE */

namespace iit\Nextcloud\DAV;

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
}
