<?php

namespace App\Services;

use App\Services\PostImporter;

class ExternalPostImporter
{
    public static function getProviders(): array
    {
        return [
            'jsonplaceholder' => 'Json Placeholder',
            'fakestore' => 'Fake Store',
        ];
    }

    public static function load(string $provider): PostImporter
    {
        return match ($provider) {
            'jsonplaceholder' => new JsonPlaceholderImporter(),
            'fakestore' => new FakeStoreImporter(),
            default => throw new \InvalidArgumentException("Unsupported provider: {$provider}"),
        };
    }
}
