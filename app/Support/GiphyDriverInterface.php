<?php

namespace App\Support;

use App\Giphy;
use GuzzleHttp\Client;

interface GiphyDriverInterface
{
	public function search($query) :Giphy;
	public function random() :Giphy;
}
