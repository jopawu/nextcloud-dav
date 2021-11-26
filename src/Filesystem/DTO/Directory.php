<?php

namespace iit\Nextcloud\DAV\Filesystem\DTO;

use Iterator;

/**
 * @author      Björn Heyser <info@bjoernheyser.de>
 */
class Directory extends Item implements Iterator
{
    /**
     * @var Item[]
     */
    protected $children;


    /**
     * @param string $identifier
     * @param string $name
     * @param int $lastModified
     */
    public function __construct(string $identifier, string $name, int $lastModified)
    {
        $this->children = [];
        parent::__construct($identifier, $name, $lastModified);
    }

    /**
     * @param Item $child
     */
    public function addChild(Item $child)
    {
        $this->children[] = $child;
    }

    /**
     * @return Directory[]
     */
    public function getDirectories() : array
    {
        $directories = [];

        foreach($this as $item)
        {
            if( !$item->isDirectory() )
            {
                continue;
            }

            $directories[] = $item;
        }

        return $directories;
    }

    /**
     * @return File[]
     */
    public function getFiles() : array
    {
        $files = [];

        foreach($this as $item)
        {
            if( !$item->isFile() )
            {
                continue;
            }

            $files[] = $item;
        }

        return $files;
    }

    /**
     * @return bool
     */
    public function isDirectory() : bool
    {
        return true;
    }

    /**
     * @return bool
     */
    public function isFile() : bool
    {
        return false;
    }

    /**
     * @return Item
     */
    public function current()
    {
        return current($this->children);
    }

    /**
     * @return Item
     */
    public function next()
    {
        return next($this->children);
    }

    /**
     * @return int
     */
    public function key()
    {
        return key($this->children);
    }

    /**
     * @return bool
     */
    public function valid()
    {
        return key($this->children) !== null;
    }

    /**
     * @return Item
     */
    public function rewind()
    {
        return reset($this->children);
    }
}
