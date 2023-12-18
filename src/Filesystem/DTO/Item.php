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
     * @var string
     */
    protected $path;

    /**
     * @var int
     */
    protected $lastModified;

    /**
     * @param string $identifier
     * @param string $name
     * @param int $lastModified
     */
    public function __construct(string $identifier, string $name, string $path, int $lastModified)
    {
        $this->identifier = trim($identifier, '"');
        $this->name = $name;
        $this->path = $path;
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
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return int
     */
    public function getLastModified() : int
    {
        return $this->lastModified;
    }

    /**
     * @return bool
     */
    abstract public function isDirectory() : bool;

    /**
     * @return bool
     */
    abstract public function isFile() : bool;
}
