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
     * @param Item $child
     */
    public function addChild(Item $child)
    {
        $this->children[] = $child;
    }

    /**
     * @return Item
     */
    public function current() : Item
    {
        return current($this->children);
    }

    /**
     * @return Item
     */
    public function next() : Item
    {
        return next($this->children);
    }

    /**
     * @return int
     */
    public function key() : int
    {
        return key($this->children);
    }

    /**
     * @return bool
     */
    public function valid() : bool
    {
        return key($this->children) !== null;
    }

    /**
     * @return Item
     */
    public function rewind() : Item
    {
        return reset($this->children);
    }
}
