<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Repositories\BooksDataBase;
use App\Repositories\BooksGuzzleHttp;
use App\Http\Requests\BookStoreRequest;
use App\Http\Resources\BookResource as BookResource;
use App\Http\Resources\BookCollection as BookCollection;
use App\Http\Resources\BookXMLResource as BookXMLResource;

class BookController extends Controller
{
    protected $booksDataBase;
    protected $booksGuzzleHttp;
    protected $bookXMLResource;

    public function __construct(BooksGuzzleHttp $booksGuzzleHttp, BooksDataBase $booksDataBase, BookXMLResource $bookXMLResource){

        $this->booksDataBase   = $booksDataBase;
        $this->booksGuzzleHttp = $booksGuzzleHttp;
        $this->bookXMLResource = $bookXMLResource;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return BookResource::collection(Book::paginate(2));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookStoreRequest $request)
    {
        $element =  $this->booksGuzzleHttp->find($request->ISBN);  
        if(!isset($element)){
            return response()->json([
                'status'        => 'error',
                'response code' =>  404,
                'data'          =>  null,
                'message'       => 'Item not found',
            ],404);
        }
        $book = $this->booksDataBase->create($element);        
        return BookResource::make($book);        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {   
        return $this->bookXMLResource->toXML($book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return response()->json([
                'status'        => 'success',
                'response code' =>  410,
                'data'          =>  null,
                'message'       => 'Item removed',
        ]);
    }
}
