<?php

namespace iit\Nextcloud\DAV\Filesystem\DTO;

/**
 * @author      Björn Heyser <info@bjoernheyser.de>
 */
class Quota
{
    /**
     * @var int
     */
    protected $available;

    /**
     * @var int
     */
    protected $used;

    /**
     * @param int $available
     * @param int $used
     */
    public function __construct(int $available, int $used)
    {
        $this->available = $available;
        $this->used = $used;
    }

    /**
     * @return int
     */
    public function available() : int
    {
        return $this->available;
    }

    /**
     * @return int
     */
    public function used() : int
    {
        return $this->used;
    }

    /**
     * @return int
     */
    public function total() : int
    {
        return $this->available() + $this->used();
    }
}
