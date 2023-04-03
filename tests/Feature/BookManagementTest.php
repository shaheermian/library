<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Book;
use Tests\TestCase;

class BookManagementTest extends TestCase
{
    use RefreshDatabase;

    public $bookDataComplete = [
        'title' => 'Book Title',
        'author' => 'Some Amazing Author',
    ];

    /**
     * @test
     * Book can be added to the library.
     */
    public function a_book_can_be_added_to_the_library(): void
    {
        // $this->withoutExceptionHandling();

        $response = $this->post('/books', $this->bookDataComplete);
        // $response->assertOk();
        $book = Book::first();
        $this->assertCount(1, Book::all());
        $response->assertRedirectToRoute('book.show', ['book' => $book->id]);//'/books/' . $book->id);
    }

    /**
     * @test
     * Validation for title being required 
     */
    public function a_title_is_required(): void
    {
        // $this->withoutExceptionHandling();

        $response = $this->post('/books', [
            'title' => '',
            'author' => 'Some Amazing Author',
        ]);

        $response->assertSessionHasErrors('title');
    }
    
    /**
     * @test
     * Validation for author being required 
     */
    public function an_author_is_required(): void
    {
        // $this->withoutExceptionHandling();

        $response = $this->post('/books', [
            'title' => 'Some Title',
            'author' => '',
        ]);

        $response->assertSessionHasErrors('author');
    }

    /**
     * @test
     * Book can be updated in the library.
     */
    public function a_book_can_be_updated_in_the_library(): void
    {
        // $this->withoutExceptionHandling();

        $this->post('/books', $this->bookDataComplete);

        $book = Book::first();

        $response = $this->patch('/books/' . $book->id, [
            'title' => 'New Title',
            'author' => 'New Author',
        ]);

        $this->assertEquals('New Title', Book::first()->title);
        $this->assertEquals('New Author', Book::first()->author);
        $this->assertCount(1, Book::all());
        $response->assertRedirectToRoute('book.show', ['book' => $book->id]);

    }

    /**
     * @test
     * Book can be deleted from the lirary
     */
     public function a_book_can_be_deleted_from_the_library(): void
     {
        // $this->withoutExceptionHandling();

        //Add the book to the database
        $this->post('/books', $this->bookDataComplete);
        $book = Book::first();
        $this->assertModelExists($book);
        $this->assertCount(1, Book::all());
        //Delete the book
        $response = $this->delete('/books/' . $book->id);
        // $response->assertOk(); //no issues were encountered while deleting the book - (this returns status code 200, redirect has status code 302)
        $this->assertCount(0, Book::all()); //no more books exist
        //Make sure that after the operation is performed, user is redirected to the correct page
        $response->assertRedirectToRoute('books.listing');
     }

}
