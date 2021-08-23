<?php

/* Copyright (c) 1998-2019 ILIAS open source, Extended GPL, see docs/LICENSE */

namespace iit\Nextcloud\DAV;

/**
 * @author      Björn Heyser <info@bjoernheyser.de>
 */
class Service
{
    /**
     * @var Server
     */
    protected $server;

    public function __construct($BASE_URI, $USER_NAME, $USER_PASS)
    {
        $this->server = new Server($BASE_URI, $USER_NAME, $USER_PASS);
    }

    /**
     * @return FS\Client
     */
    public function filesystem()
    {
        return new FS\Client($this->server);
    }
}
