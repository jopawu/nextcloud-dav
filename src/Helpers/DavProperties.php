<?php

namespace iit\Nextcloud\DAV\Helpers;

class DavProperties
{
    const PROP_IDENTIFIER = '{DAV:}getetag';
    const PROP_RESSOUCETYPE = '{DAV:}resourcetype';
    const PROP_LASTMODIFIED = '{DAV:}getlastmodified';
    const PROP_CONTENTTYPE = '{DAV:}getcontenttype';
    const PROP_CONTENTSIZE = '{DAV:}getcontentlength';

    const PROP_USED_QUOTA = '{DAV:}quota-used-bytes';
    const PROP_AVAILABLE_QUOTA = '{DAV:}quota-available-bytes';

    /**
     * @var string[]
     */
    protected static $propsNotWorking = [
        '{DAV:}displayname', '{DAV:}permissions', '{http://owncloud.org/ns}permissions',
    ];

    /**
     * @var string[]
     */
    protected static $quotaProperties = [
        self::PROP_USED_QUOTA, self::PROP_AVAILABLE_QUOTA
    ];

    /**
     * @var string[]
     */
    protected static $itemProperties = [
        self::PROP_IDENTIFIER, self::PROP_RESSOUCETYPE, self::PROP_LASTMODIFIED,
        self::PROP_CONTENTTYPE, self::PROP_CONTENTSIZE
    ];

    /**
     * @return string[]
     */
    public static function getQuotaProperties() : array
    {
        return self::$quotaProperties;
    }

    /**
     * @return string[]
     */
    public static function getItemProperties() : array
    {
        return self::$itemProperties;
    }
}