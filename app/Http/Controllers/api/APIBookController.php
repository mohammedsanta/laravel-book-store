<?php

namespace App\Http\Controllers\api;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;

class APIBookController extends Controller
{
    
    public function index()
    {

        $book = BookResource::collection(Book::all());

        $array = [
            'book' => $book,
            'status' => 200,
            'message' => 'Done'
        ];

        return response($array);

    }

    public function show($id)
    {

        $book = new BookResource(Book::find($id));


        $array = [
            'book' => $book,
            'status' => 200,
            'message' => 'Done'
        ];

        return response($array);

    }

}
