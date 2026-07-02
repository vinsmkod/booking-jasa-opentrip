<?php

namespace App\HTTP;

/**
 * Custom Response class — fixes PHP 8.1+ compatibility issue with CodeIgniter 4.
 *
 * In older CI4 versions, ResponseTrait::send() calls str_replace() on $this->body
 * which can be null for redirect responses. PHP 8.1 deprecated passing null to
 * str_replace(), and PHP 8.2+ throws a TypeError.
 *
 * This override ensures $this->body is always an empty string before send() is called.
 */
class Response extends \CodeIgniter\HTTP\Response
{
    /**
     * Ensures the response body is never null before sending,
     * preventing the PHP 8.1+ str_replace() deprecation error.
     */
    public function send(): static
    {
        if ($this->body === null) {
            $this->body = '';
        }

        return parent::send();
    }
}
