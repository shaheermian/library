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

        $book = Book::create($this->validateRequest());
        return redirect($book->path());
    }

    public function update(Book $book)
    {
        // $data = $this->validateRequest();

        // $book = Book::find($id);
        // $book->update($data);
        $book->update($this->validateRequest());
        return redirect($book->path());
    }

    public function validateRequest()
    {
        return request()->validate([
            'title' => 'required|string',
            'author' => 'required|string'
        ]);
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect(route('books.listing'));
    }
}
