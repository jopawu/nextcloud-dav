<?php

namespace iit\Nextcloud\DAV\Filesystem\Query;

use iit\Nextcloud\DAV\Filesystem\DTO\File;
use iit\Nextcloud\DAV\Exception\InvalidDavResponseException;

/**
 * @author      Björn Heyser <info@bjoernheyser.de>
 */
class GetFileContentResponse extends QueryResponse
{
    /**
     * @param array $davResponse
     */
    protected function validateDavResponse(array $davResponse) : void
    {
        if( !isset($davResponse['statusCode']) )
        {
            throw $this->invalidArgumentException($davResponse);
        }

        if( $davResponse['statusCode'] != 200 )
        {
            throw $this->invalidDavResponseException($davResponse);
        }
    }

    /**
     * @param string[] $headers
     * @return string
     */
    protected function fetchEtagFromHeaders(array $headers) : string
    {
        return current($headers['etag']);
    }

    /**
     * @param string[] $headers
     * @return string
     */
    protected function fetchNameFromHeaders(array $headers) : string
    {
        $contentDisposition = current($headers['content-disposition']);
        $dispoParts = explode(';', $contentDisposition);

        return 'name';
    }

    /**
     * @param string[] $headers
     * @return int
     */
    protected function fetchLastModifiedFromHeaders(array $headers) : int
    {
        $lastModified = current($headers['last-modified']);
        return strtotime($lastModified);
    }

    /**
     * @param string[] $headers
     * @return string
     */
    protected function fetchContentTypeFromHeaders(array $headers) : string
    {
        return current($headers['content-type']);
    }

    /**
     * @param string[] $headers
     * @return int
     */
    protected function fetchContentLengthFromHeaders(array $headers) : int
    {
        return current($headers['content-length']);
    }

    /**
     * @return File
     */
    public function parse() : File
    {
        $headers = $this->davResponse['headers'];
        $body = $this->davResponse['body'];

        $file = new File(
            $this->fetchEtagFromHeaders($headers),
            $this->fetchNameFromHeaders($headers),
            $this->fetchLastModifiedFromHeaders($headers),
            $this->fetchContentTypeFromHeaders($headers),
            $this->fetchContentLengthFromHeaders($headers)
        );

        return $file->withContent($body);
    }
}
