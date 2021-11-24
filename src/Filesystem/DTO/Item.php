<?php

namespace iit\Nextcloud\DAV\Filesystem\DTO;

/**
 * @author      Björn Heyser <info@bjoernheyser.de>
 */
abstract class Item
{
    /**
     * @var string
     */
    protected $identifier;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var int
     */
    protected $lastModified;

    /**
     * @param string $identifier
     * @param string $name
     * @param int $lastModified
     */
    public function __construct(string $identifier, string $name, int $lastModified)
    {
        $this->identifier = $identifier;
        $this->name = $name;
        $this->lastModified = $lastModified;
    }

    /**
     * @return string
     */
    public function getIdentifier() : string
    {
        return $this->identifier;
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getLastModified() : int
    {
        return $this->lastModified;
    }
}
