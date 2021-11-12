<?php

/* Copyright (c) 1998-2019 ILIAS open source, Extended GPL, see docs/LICENSE */

namespace iit\Nextcloud\DAV;

/**
 * @author      Björn Heyser <info@bjoernheyser.de>
 */
class Service
{
    /**
     * @var Config
     */
    protected $config;

    /**
     * @var Server
     */
    protected $server;

    /**
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;

        $this->server = new Server(
            $config->getBaseUri(), $config->getUsername(), $config->getPassword()
        );
    }

    /**
     * @return Filesystem\Client
     */
    public function filesystem()
    {
        return new Filesystem\Client($this->server);
    }
}
