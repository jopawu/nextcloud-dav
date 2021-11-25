<?php

namespace iit\Nextcloud\DAV\Filesystem\Query;

use http\Exception\InvalidArgumentException;
use iit\Nextcloud\DAV\Exception\InvalidDavResponseException;

/**
 * @author      Björn Heyser <info@bjoernheyser.de>
 */
abstract class QueryResponse
{
    /**
     * @var array
     */
    protected $davResponse;

    /**
     * @param array $davResponse
     */
    public function __construct(array $davResponse)
    {
        $this->validateDavResponse($davResponse);
        $this->davResponse = $davResponse;
    }

    /**
     * @param array $davResponse
     * @return InvalidArgumentException
     */
    protected function invalidArgumentException(array $davResponse) : InvalidArgumentException
    {
        return new InvalidArgumentException(
            "invalid dav response given: ".print_r($davResponse, true)
        );
    }

    /**
     * @param array $davResponse
     * @return InvalidDavResponseException
     */
    protected function invalidDavResponseException(array $davResponse) : InvalidDavResponseException
    {
        return new InvalidDavResponseException(
            "invalid dav response! status code: {$davResponse['statusCode']}"
        );
    }

    /**
     * @param array $davResponse
     */
    abstract protected function validateDavResponse(array $davResponse) : void;
}
