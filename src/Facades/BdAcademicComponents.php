<?php

namespace Wovosoft\BdAcademicComponents\Facades;

use Illuminate\Support\Facades\Facade;

class BdAcademicComponents extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'bd-academic-components';
    }
}
