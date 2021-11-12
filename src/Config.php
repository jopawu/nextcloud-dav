<?php

namespace iit\Nextcloud\DAV;

/**
 * @author      Björn Heyser <info@bjoernheyser.de>
 */
class Config
{
    /**
     * @var string
     */
    protected $baseUri;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $password;

    /**
     * @param string $baseUri
     * @param string $username
     * @param string $password
     */
    public function __construct(string $baseUri, string $username, string $password)
    {
        $this->baseUri = $baseUri;
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getBaseUri() : string
    {
        return $this->baseUri;
    }

    /**
     * @return string
     */
    public function getUsername() : string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword() : string
    {
        return $this->password;
    }
}
