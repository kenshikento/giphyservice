<?php

namespace App\Support;

use GuzzleHttp\Client;

class GuzzleFactory
{
    /**
     * Creates new Guzzle Client baised on data input
     * @param  array $data
     * @return Client
     */
    public function make(array $data =[]) : Client
    {
    	return new Client($data);
    }
}

