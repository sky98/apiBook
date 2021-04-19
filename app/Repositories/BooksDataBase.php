<?php

namespace App\Repositories;

use App\Models\Book;

class BooksDataBase
{
	public function create($element){
		if(!isset($element['cover']['large'])){
			$element['cover']['large'] = "Cover not found";
		}
		$book = Book::create([
            'title'         => $element['title'],
            'authors'       => json_encode($element['authors']),
            'cover_large'   => $element['cover']['large'],
        ]);
		return $book;
	}
}