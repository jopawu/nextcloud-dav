<?php

namespace iit\Nextcloud\DAV\Filesystem\Query;

use iit\Nextcloud\DAV\Filesystem\DTO\Quota;
use http\Exception\InvalidArgumentException;
use iit\Nextcloud\DAV\Helpers\DavProperties;

/**
 * @author      Björn Heyser <info@bjoernheyser.de>
 */
class QuotaReportResponse extends QueryResponse
{
    /**
     * @param array $davResponse
     */
    protected function validateDavResponse(array $davResponse) : void
    {
        if( count($davResponse) != 2 )
        {
            throw $this->invalidArgumentException($davResponse);
        }

        if( !isset($davResponse[DavProperties::PROP_USED_QUOTA]) )
        {
            throw $this->invalidArgumentException($davResponse);
        }

        if( !isset($davResponse[DavProperties::PROP_AVAILABLE_QUOTA]) )
        {
            throw $this->invalidArgumentException($davResponse);
        }
    }

    /**
     * @return int
     */
    protected function parseAvailableQuota() : int
    {
        return (int)$this->davResponse[DavProperties::PROP_AVAILABLE_QUOTA];
    }

    /**
     * @return int
     */
    protected function parseUsedQuota() : int
    {
        return (int)$this->davResponse[DavProperties::PROP_USED_QUOTA];
    }

    /**
     * @return Quota
     */
    public function parse() : Quota
    {
        $quota = new Quota(
            $this->parseAvailableQuota(),
            $this->parseUsedQuota()
        );

        return $quota;
    }
}
