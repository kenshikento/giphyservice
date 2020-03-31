<?php

namespace App\Support;

use App\Exceptions\SalesforceFailure;
use App\Giphy;
use App\Support\GiphyDriverInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\RequestOptions;
use Faker\Generator;

class FakerGateway implements GiphyDriverInterface
{
    /**
     * @var Faker
     */
    protected $faker;

    public function __construct(Generator $faker) 
    {
        $this->faker = $faker;
    }

    public function search($query) : Giphy
    {
        return $this->seed();
    }

    public function random() : Giphy
    {
        return $this->seed();
    }

    /**
     * Fills Giphy Model and returns seeded data
     * @var Client
     */
    public function seed()
    {   
        $model = new Giphy();
        $model->setUrl($this->faker->imageUrl());
        $model->setTitle($this->faker->words(3, true));
        $model->setWidth($this->faker->numberBetween(64, 128));
        $model->setHeight($this->faker->numberBetween(64, 128));
        $model->setFrameCount($this->faker->numberBetween(12, 120));
        $model->setSize($this->faker->numberBetween(1024, 10240));
        return $model;
    }
}
