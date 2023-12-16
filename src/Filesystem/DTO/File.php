<?php

namespace iit\Nextcloud\DAV\Filesystem\DTO;

use iit\Nextcloud\DAV\Exception\ContentNotInitialisedException;

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
     * @var string
     */
    protected $content;

    /**
     * @param string $identifier
     * @param string $name
     * @param int $lastModified
     * @param string $mimeType
     * @param int $size
     */
    public function __construct(string $identifier, string $name, string $path, int $lastModified, string $mimeType, int $size)
    {
        parent::__construct($identifier, $name, $path, $lastModified);
        $this->mimeType = $mimeType;
        $this->size = $size;
        $this->content = null;
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
     * @param string $content
     * @return File
     */
    public function withContent(string $content) : File
    {
        $clone = clone $this;
        $clone->content = $content;
        return $clone;
    }

    /**
     * @return string
     */
    public function getContent() : string
    {
        if( $this->content === null )
        {
            throw new ContentNotInitialisedException("content not initialised for file: {$this->name}");
        }

        return $this->content;
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
