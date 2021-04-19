<?php

namespace App\Repositories;

class BooksGuzzleHttp extends GuzzleHttpRequest
{
	public function find($url){
		return $this->get('https://openlibrary.org/api/books?bibkeys=ISBN:'.$url.'&jscmd=data&format=json');
	}
}