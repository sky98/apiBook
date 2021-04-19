<?php

namespace App\Http\Resources;

use App\Models\Book;

class BookXMLResource
{

	protected $book;

	public function __construct(Book $book){
        $this->book = $book;
    }

    /**
     * Transform the resource into an xml.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return xml
     */
    public function toXML(Book $book)
    {
        //return parent::toArray($request);
        return $this->builtXML($book);
    }

    protected function builtXML($book){
    	$xml = "<?xml version='1.0' encoding='utf-8' standalone='yes' ?>\n";
    	$xml .= "	<Libros>\n";
    	$xml .= "		<Libro>\n";
    	$xml .= "			<Titulo>".$book->title."</Titulo>\n";
    	$xml .= "			<Autores>\n";    	
    	$authors = json_decode($book->authors);
    	foreach ($authors as $author){ 
    		$xml .= "				<Autor>\n";
    		$xml .= "					<name>".$author->name."</name>\n";
    		$xml .= "					<url>".$author->url."</url>\n";
    		$xml .= "				</Autor>\n";
    	}
    	$xml .= "			</Autores>\n";
    	$xml .= "			<Caratula>".$book->cover_large."</Caratula>\n";
    	$xml .= "		</Libro>\n";
    	$xml .= "	</Libros>\n";
    	return $xml;
    }
}