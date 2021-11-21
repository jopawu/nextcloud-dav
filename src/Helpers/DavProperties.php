<?php

namespace iit\Nextcloud\DAV\Helpers;

class DavProperties
{
    const PROP_IDENTIFIER = 'identifier';
    const PROP_RESSOUCETYPE = 'ressourcetype';
    const PROP_LASTMODIFIED = 'lastmodified';
    const PROP_CONTENTTYPE = 'contenttype';
    const PROP_CONTENTSIZE = 'contentsize';

    const PROP_USED_QUOTA = '{DAV:}quota-used-bytes';
    const PROP_AVAILABLE_QUOTA = '{DAV:}quota-available-bytes';

    /**
     * @var string[]
     */
    protected $propsNotWorking = [
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