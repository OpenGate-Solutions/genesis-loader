<?php

namespace OpenGate\GenesisLoader;

use Composer\Autoload\ClassLoader;
use Illuminate\Support\Facades\File;

class GenesisLoader
{
    public function registerModule(string $path): void
    {
        if (empty($path)) {
            return;
        }
        $composerFile = File::get("$path/composer.json");
        $composerJson = json_decode($composerFile, true);
        if ($this->validateComposerFile($composerJson)) {
            foreach ($composerJson['autoload']['psr-4'] ?? [] as $namespace => $sourcePath) {
                $loader = new ClassLoader();
                $loader->setPsr4($namespace, "$path/$sourcePath");
                $loader->register();
            }

            foreach ($composerJson['extra']['laravel']['providers'] ?? [] as $provider) {
                app()->register($provider);
            }
        }
    }

    private function validateComposerFile($composerJson): bool
    {
        return (bool) $composerJson;
    }
}
