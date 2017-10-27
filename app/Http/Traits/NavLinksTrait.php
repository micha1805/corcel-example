<?php

namespace App\Http\Traits;

trait NavLinksTrait
{
    // Get all the header navigation links
    public static function getNavLinks()
    {
        return [
            '/sample-page' => 'Sample Page'
        ];
    }
}
