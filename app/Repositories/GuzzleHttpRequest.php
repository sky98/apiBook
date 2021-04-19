<?php

namespace App\Repositories;

use GuzzleHttp\Client;

class GuzzleHttpRequest
{

	protected $client;

	public function __construct(Client $client){
		$this->client = $client;
	}

	protected function get($book){
		$response = $this->client->request('GET', $book);
		$array = json_decode($response->getBody()->getContents(), true);		
		return array_shift($array);
	}
}