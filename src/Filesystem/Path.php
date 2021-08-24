<?php

/* Copyright (c) 1998-2019 ILIAS open source, Extended GPL, see docs/LICENSE */

namespace iit\Nextcloud\DAV\Filesystem;

/**
 * @author      Björn Heyser <info@bjoernheyser.de>
 */
class Path
{
    /**
     * @param string $path
     * @return string
     */
    public static function trimSlashes($path)
    {
        return trim($path ,'/');
    }
}
