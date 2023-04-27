<?php

namespace App\Actions\Book;

use App\Models\Book;
use stdClass;

class StoreNewBook
{
    public $results;

    public function __construct($newBookData)
    {
        $book = new Book();
        $book->title = $newBookData->title;
        $book->slug = $newBookData->slug;
        $book->author_id = $newBookData->author_id;
        $book->published_year = $newBookData->published_year;
        $book->cover_url = $newBookData->cover_url;
        $book->info_url = $newBookData->info_url;
        $book->purchase_url = $newBookData->purchase_url;
        $book->description = $newBookData->description;
        $book->save();

        $this->results = new stdClass();
        $this->results->title = $book->title;

    }
}