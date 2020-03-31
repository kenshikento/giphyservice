<?php

namespace App\Support;

use App\Giphy;
use function array_key_exists;
use Illuminate\Contracts\Foundation\Application;

/**
 * A service for retrieving GIF data
 *
 * @package App\Services
 */
class GiphyManager
{
    /**
     * The application instance.
     *
     * @var Application
     */
    protected $app;

    /**
     * The gif provider factory instance.
     *
     * @var GifProviderFactory
     */
    protected $factory;

    /**
     * @var int
     */
    protected $cacheTtl;

    /**
     * @var array|GifDriverInterface[]
     */
    protected $providerMap = [];

    /**
     * GifService constructor.
     *
     * @param Application $app
     * @param GifProviderFactory $factory
     */
    public function __construct(Application $app, GiphyFactory $factory)
    {
        $this->app = $app;
        $this->factory = $factory;
    }

    /**
     * Returns a single GIF for a search query
     *
     * @param string $query the search query
     * @param string|null $provider the name of the provider to use, or null for the default
     *
     * @return GifData the data for the gif
     *
     * @throws GifException if an error occurs retrieving the gif
     */
    public function search($query, $provider = null): Giphy
    {
        $provider = ($provider ?: $this->getDefaultProvider());

        $gifData = $this->getProvider($provider)->search($query);

        return $gifData;
    }

    /**
     * Returns a random GIF
     *
     * @return Giphy the data for the gif
     */
    public function random($provider = null): Giphy
    {
        return $this->getProvider($provider)->random();
    }

    /**
     * Get the default connection name.
     *
     * @return string
     */
    public function getDefaultProvider()
    { 
        return $this->app['config']['giphy.default'];
    }

    /**
     *
     * @return GifDriverInterface
     */
    protected function getProvider($provider = null)
    {
        $provider = ($provider ?: $this->getDefaultProvider());

        if (!array_key_exists($provider, $this->providerMap)) {
            $config = $this->app['config']['giphy.providers'][$provider];
            $driver = $config['driver'];
            $this->providerMap[$provider] = $this->factory->make($driver, $config);
        }

        return $this->providerMap[$provider];
    }
}