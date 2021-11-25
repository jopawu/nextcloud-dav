<?php

namespace iit\Nextcloud\DAV\Filesystem\Query;

use iit\Nextcloud\DAV\Server;
use iit\Nextcloud\DAV\Filesystem\Path;
use iit\Nextcloud\DAV\Helpers\DavProperties;

/**
 * @author      Björn Heyser <info@bjoernheyser.de>
 */
class QuotaReportRequest extends QueryRequest
{
    /**
     * @return QueryResponse
     */
    public function perform() : QueryResponse
    {
        $path = new Path($this->server, '');

        $davClient = $this->server->getDavClient();
        $davResponse = $davClient->propFind((string)$path, DavProperties::getQuotaProperties(), 0);
        return new QuotaReportResponse($davResponse);
    }
}
