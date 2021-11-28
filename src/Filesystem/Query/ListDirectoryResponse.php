<?php

namespace iit\Nextcloud\DAV\Filesystem\Query;

use iit\Nextcloud\DAV\Server;
use iit\Nextcloud\DAV\Filesystem\Path;
use iit\Nextcloud\DAV\Helpers\DavProperties;
use iit\Nextcloud\DAV\Helpers\DavRessources;
use iit\Nextcloud\DAV\Filesystem\DTO\Directory;
use iit\Nextcloud\DAV\Filesystem\DTO\File;

/**
 * @author      Björn Heyser <info@bjoernheyser.de>
 */
class ListDirectoryResponse extends QueryResponse
{
    const EMPTY_DIR_CACHE_INDEX_REPLACEMENT = '/';

    /**
     * @var Server
     */
    protected $server;

    /**
     * @var Path
     */
    protected $path;

    /**
     * ListDirectoryResponse constructor.
     * @param Server $server
     * @param Path   $path
     * @param array[]  $davResponse
     */
    public function __construct(Server $server, Path $path, array $davResponse)
    {
        //echo '<pre>'.print_r($davResponse, true).'</pre>';
        //echo '<pre>'.print_r(array_keys($davResponse), true).'</pre>';

        $this->server = $server;
        $this->path = $path;

        parent::__construct($davResponse);
    }

    /**
     * @param array[] $davResponse
     */
    protected function validateDavResponse(array $davResponse) : void
    {
        $davResponseKeys = array_keys($davResponse);
        $rootIndex = array_shift($davResponseKeys);
        $rootItem = array_shift($davResponse);
        $rootIndex = $this->path->fetchRelativeDavRessourcePath($rootIndex);

        // todo: validate response
    }

    /**
     * @return Directory
     */
    public function parse() : Directory
    {
        /* @var Directory[] $directories */
        $directories = [];

        foreach($this->davResponse as $davIndex => $item)
        {
            $relIndex = $this->path->fetchRelativeDavRessourcePath($davIndex);

            $name = urldecode(basename($relIndex));
            $identifier = $item[DavProperties::PROP_IDENTIFIER];
            $lastmodified = strtotime($item[DavProperties::PROP_LASTMODIFIED]);

            if( $this->isDirectory($item) )
            {
                $directory = new Directory($identifier, $name, $lastmodified);

                if( !$this->isRootDirectory($relIndex) )
                {
                    $dirCacheIndex = $this->buildDirCacheIndex($relIndex, true);
                    $directories[$dirCacheIndex]->addChild($directory);
                }

                $dirCacheIndex = $this->buildDirCacheIndex($relIndex, false);
                $directories[$dirCacheIndex] = $directory;
                continue;
            }

            $mimetype = $item[DavProperties::PROP_CONTENTTYPE];
            $filesize = $item[DavProperties::PROP_CONTENTSIZE];
            $file = new File($identifier, $name, $lastmodified, $mimetype, $filesize);

            $dirCacheIndex = $this->buildDirCacheIndex($relIndex, true);
            $directories[$dirCacheIndex]->addChild($file);
        }

        return current($directories);
    }

    /**
     * @param array $item
     * @return bool
     */
    protected function isDirectory(array $item) : bool
    {
        if( !($item[DavProperties::PROP_RESSOUCETYPE] instanceof \Sabre\DAV\Xml\Property\ResourceType) )
        {
            return false;
        }

        return $item[DavProperties::PROP_RESSOUCETYPE]->is(DavRessources::TYPE_COLLECTION);
    }

    /**
     * @param string $itemIndex
     * @return bool
     */
    protected function isRootDirectory(string $itemIndex) : bool
    {
        $itemIndex = urldecode($this->fixEmptyIndex($itemIndex));
        $rootIndex = '/'.$this->path->getPath();

        return $itemIndex == $rootIndex;
    }

    /**
     * @param string $itemIndex
     * @param bool $needParent
     * @return string
     */
    protected function buildDirCacheIndex(string $itemIndex, bool $needParent) : string
    {
        if( $needParent )
        {
            $itemIndex = dirname($itemIndex);
        }

        return $this->fixEmptyIndex($itemIndex);
    }

    /**
     * @param string $itemIndex
     * @return string
     */
    protected function fixEmptyIndex(string $itemIndex) : string
    {
        return strlen($itemIndex) ? $itemIndex : self::EMPTY_DIR_CACHE_INDEX_REPLACEMENT;
    }
}
