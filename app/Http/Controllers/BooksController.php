<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    //
    public function store()
    {
        /* Book::create([
            'title' => request('title'),
            'author' => request('author'),
        ]); */

        // $data = $this->validateRequest();

        Book::create($this->validateRequest());
    }

    public function update(Book $book)
    {
        // $data = $this->validateRequest();

        // $book = Book::find($id);
        // $book->update($data);
        $book->update($this->validateRequest());
    }

    public function validateRequest()
    {
        return request()->validate([
            'title' => 'required|string',
            'author' => 'required|string'
        ]);
    }
}
