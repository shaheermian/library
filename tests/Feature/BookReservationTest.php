<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Book;
use Tests\TestCase;

class BookReservationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * Book can be added to the library.
     */
    public function a_book_can_be_added_to_the_library(): void
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/books', [
            'title' => 'Book Title',
            'author' => 'Some Amazing Author',
        ]);

        $response->assertOk();
        $this->assertCount(1, Book::all());

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
        $this->withoutExceptionHandling();

        $this->post('/books', [
            'title' => 'Book Title',
            'author' => 'Some Amazing Author',
        ]);

        $book = Book::first();

        $response = $this->patch('/books/' . $book->id, [
            'title' => 'New Title',
            'author' => 'New Author',
        ]);

        $this->assertEquals('New Title', Book::first()->title);
        $this->assertEquals('New Author', Book::first()->author);
        // $this->assertCount(1, Book::all());

    }

}
