<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Method to return the book path
     * (Fallback included - If model doesn't exist, then return to listing page)
     *
     * @return string
     */
    public function path(): string
    {
        return route('book.show', ['book' => ($this->id ?? '')]);//'/books/' . ($this->id ?? '');
    }
}
