<?php

namespace OpenGate\GenesisLoader\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \OpenGate\GenesisLoader\GenesisLoader
 */
class GenesisLoader extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \OpenGate\GenesisLoader\GenesisLoader::class;
    }
}
