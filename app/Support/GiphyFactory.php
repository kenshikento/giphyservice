<?php

namespace App\Support;

use App\Support\FakerGateway;
use App\Support\GiphyDriverInterface;
use App\Support\GiphyGateway;
use App\Support\GuzzleFactory;
use InvalidArgumentException;

/**
 * Factory class for GIF providers
 *
 */
class GiphyFactory
{
    /**
     * Creates a GIF provider
     *
     *  @return GiphyDriverInterface
     */
    public function make(string $driver, array $config) : GiphyDriverInterface
    {
        switch ($driver) {
            case 'faker':
                return app(FakerGateway::class);
            case 'giphy':
                $guzzleFactory = app(GuzzleFactory::class);
                
                $clientConfig = [
                    'base_uri' => $config['base_url'],
                ];

                $httpClient = $guzzleFactory->make($clientConfig);

                return new GiphyGateway($httpClient, $config['api_key']);
        }

        throw new InvalidArgumentException("Unsupported driver [{$driver}]");
    }
}