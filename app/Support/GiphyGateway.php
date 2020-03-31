<?php

namespace App\Support;

use App\Exceptions\SalesforceFailure;
use App\Giphy;
use App\Support\GiphyDriverInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\RequestOptions;
use Exception;

class GiphyGateway implements GiphyDriverInterface
{
    /**
     * @var Client
     */
    protected $httpClient;

    /**
     * @var string
     */
    protected $apiKey;

    public function __construct(Client $client, string $apiKey) 
    {
        $this->client = $client;
        $this->apiKey = $apiKey;
    }


    public function search($query) : Giphy
    {
        $params = [
            'q' => $query,
            'limit' => 1,
        ];

        $result = $this->submit('get','/v1/gifs/search', $params);
        return $this->setGiphy($result['data'][0]);
    }

    public function random() : Giphy
    {
        $response = $this->submit('get', '/v1/gifs/random');
        return $this->setGiphy($response['data']);
    }

    /**
     * Forms parameter and query url with parameter inputted in
     *
     * @return Array
     */
    public function submit(string $method, string $url, array $params =[]) : array
    {
        $params['api_key'] = $this->apiKey;

        $response = $this->client->request(
            $method,
            $url,
            [
                RequestOptions::QUERY => $params
            ]
        );

        $result = $this->wasSuccessful($response);

        if (!$result) {
            throw new Exception('Failed to Receive');
        }

        $body = $response->getBody()->getContents();
        $data = json_decode($body, true);

        return $data;
    }

    /**
     *  Response Checker.
     *
     *  @param   Response $response
     *  @return  bool
     */
    public function wasSuccessful(Response $response) : bool
    { 
        if ($response->getStatusCode() !== 200) {
            return false;
        }

        return true;
    }

    public function setGiphy(Array $data) 
    {  
        $model = new Giphy();

        $image = $data['images']['original'];

        $model->setUrl($data['url']);
        $model->setTitle($data['title']);
        $model->setWidth($image['width']);
        $model->setHeight($image['height']);
        $model->setFrameCount($image['frames']);
        $model->setSize($image['size']);

        return $model;
    }
}
