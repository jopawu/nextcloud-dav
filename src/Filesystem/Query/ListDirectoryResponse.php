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
        $rootIndex = array_shift(array_keys($davResponse));
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
                    $directories[dirname($relIndex)]->addChild($directory);
                }

                $directories[$relIndex] = $directory;
                continue;
            }

            $mimetype = $item[DavProperties::PROP_CONTENTTYPE];
            $filesize = $item[DavProperties::PROP_CONTENTSIZE];
            $file = new File($identifier, $name, $lastmodified, $mimetype, $filesize);

            $directories[dirname($relIndex)]->addChild($file);
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
     * @param string $index
     * @return bool
     */
    protected function isRootDirectory(string $index) : bool
    {
        return $index == '/'.$this->path->getPath();
    }
}
