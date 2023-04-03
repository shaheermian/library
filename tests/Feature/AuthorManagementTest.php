<?php

namespace Tests\Feature;

use App\Models\Author;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthorManagementTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     * An author can be added into the system
     */
    public function an_author_can_be_added_to_the_library(): void
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/author', [
            'name' => 'Mr. Author',
            'dob' => '1987-04-19',
        ]);

        $author = Author::first();
        $this->assertCount(1, Author::all());
        $this->assertInstanceOf(Carbon::class, $author->dob);
        //$this->assertEquals('1987-04-19', Carbon::parse($author->first()->dob->format('Y-m-d')));
        
        $response->assertStatus(200);
    }
}
