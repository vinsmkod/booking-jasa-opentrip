<?php

namespace Config;

use CodeIgniter\Config\BaseService;

/**
 * Services Configuration file.
 *
 * Services are simply other classes/libraries that the system uses
 * to do its job. This is used by CodeIgniter to allow the core of the
 * framework to be swapped out easily without affecting the usage within
 * the rest of your application.
 *
 * This file holds any application-specific services, or service overrides
 * that you might need. An example has been included with the general
 * method format you should use for your service methods. For more examples,
 * see the core Services file at system/Config/Services.php.
 */
class Services extends BaseService
{
    /**
     * Override the default Response class with our custom one that fixes
     * the PHP 8.1+ compatibility issue (str_replace on null body).
     *
     * In CI4 + PHP 8.1/8.2, ResponseTrait::send() calls str_replace() on
     * $this->body which may be null for redirect responses, causing a
     * deprecation/TypeError. Our custom Response ensures body is always ''.
     */
    public static function response(\Config\App $config = null, bool $getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('response', $config);
        }

        $config ??= config('App');

        return new \App\HTTP\Response($config);
    }
}
