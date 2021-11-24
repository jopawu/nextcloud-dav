<?php

namespace iit\Nextcloud\DAV\Filesystem\DTO;

/**
 * @author      Björn Heyser <info@bjoernheyser.de>
 */
class File extends Item
{
    /**
     * @var string
     */
    protected $mimeType;

    /**
     * @var int
     */
    protected $size;

    /**
     * @param string $identifier
     * @param string $name
     * @param int $lastModified
     * @param string $mimeType
     * @param int $size
     */
    public function __construct(string $identifier, string $name, int $lastModified, string $mimeType, int $size)
    {
        parent::__construct($identifier, $name, $lastModified);
        $this->mimeType = $mimeType;
        $this->size = $size;
    }

    /**
     * @return string
     */
    public function getMimeType() : string
    {
        return $this->mimeType;
    }

    /**
     * @return int
     */
    public function getSize() : int
    {
        return $this->size;
    }

    /**
     * @return bool
     */
    public function isDirectory() : bool
    {
        return false;
    }

    /**
     * @return bool
     */
    public function isFile() : bool
    {
        return true;
    }
}
