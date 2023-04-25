<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\Book;
use App\Models\Author;

class BookController extends Controller
{
    /**
    * GET /books/create
    * Display the form to add a new book
    */
    public function create(Request $request)
    {
        # Get data for authors in alphabetical order by last name
        $authors = Author::orderBy('last_name')->select(['id', 'first_name', 'last_name'])->get();

        return view('books.create', ['authors' => $authors]);

    }

    /**
    * POST /books
    * Process the form for adding a new book
    */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|max:225',
            'slug' => 'required|unique:books,slug',
            'author_id' => 'required',
            'published_year' => 'required|digits:4',
            'cover_url' => 'required|url',
            'info_url' => 'required|url',
            'purchase_url' => 'required|url',
            'description' => 'required|min:100'
        ]);

        $book = new Book();
        $book->title = $request->title;
        $book->slug = $request->slug;
        $book->author_id = $request->author_id;
        $book->published_year = $request->published_year;
        $book->cover_url = $request->info_url;
        $book->info_url = $request->info_url;
        $book->purchase_url = $request->purchase_url;
        $book->description = $request->description;
        $book->save();

        return redirect('/books/create')->with(['flash-alert' => 'Your book was added.']);

    }

    public function add(Request $request)
    {

        dump("loaded /add");

        // return view('books.addAuthor');

    }

    public function newAuthor(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'birth_year' => 'required',
            'bio_url' => 'bio_url',
        ]);

        $author = new Author();
        $author->first_name = $requesst->first_name;
        $author->last_name = $request->last_name;
        $author->birth_year = $request->birth_year;
        $author->bio_url = $request->bio_url;
        $author->save();

        return redirect('books/create')->with(['flash-alert' => 'Your author has been added.']);
    }

    /**
     * GET/search
     * Searches books based on title or author
     */
    public function search(Request $request)
    {

        $request->validate([
            'searchTerms' => 'required',
            'searchType' => 'required'
        ]);

        # If validation fails, will redirect back to form page.

        $searchTerms = $request->input('searchTerms', '');
        $searchType = $request->input('searchType', null);

        $searchResults = Book::where($searchType, 'LIKE', '%'.$searchTerms.'%')->get();

        return redirect('/')->with([
            'searchResults' => $searchResults
        ])->withInput();
    }


    public function index()
    {
        $books = Book::orderBy('title')->get();

        // $newBooks = Book::orderBy('id', 'DESC')->limit(3)->get();
        $newBooks = $books->sortByDesc('id')->take(3);

        return view('books/index', ['books' => $books, 'newBooks' =>$newBooks]);
    }

    public function show($slug)
    {

        $book = Book::where('slug', '=', $slug)->first();

        return view('books/show', [
            'book' => $book
        ]);
    }

    /**
    * GET /books/{slug}/edit
    */
    public function edit(Request $request, $slug)
    {
        $book = Book::where('slug', '=', $slug)->first();

        $authors = Author::orderBy('last_name')->select(['id', 'first_name', 'last_name'])->get();

        return view('books/edit', [
            'book' => $book,
            'authors' => $authors,
        ]);
    }

    /**
    * PUT /books
    */
    public function update(Request $request, $slug)
    {
        $book = Book::where('slug', '=', $slug)->first();

        $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:books,slug,' . $book->id . '|alpha_dash',
            'author_id' => 'required',
            'published_year' => 'required|digits:4',
            'cover_url' => 'url',
            'info_url' => 'url',
            'purchase_url' => 'required|url',
            'description' => 'required|min:255'
        ]);

        $book->title = $request->title;
        $book->slug = $request->slug;
        $book->author_id = $request->author_id;
        $book->published_year = $request->published_year;
        $book->cover_url = $request->cover_url;
        $book->info_url = $request->info_url;
        $book->purchase_url = $request->purchase_url;
        $book->description = $request->description;
        $book->save();

        return redirect('/books/'.$slug.'/edit')->with(['flash-alert' => 'Your changes were saved.']);
    }

    public function delete($slug)
    {
        $book = Book::findBySlug($slug);

        if (!$book) {
            return redirect('/books')->with([
                'flash-alert' => 'Book not found'
            ]);
        }

        return view('books/check', ['book' => $book]);
    }

    public function destroy($slug)
    {
        $book = Book::findBySlug($slug);

        $book->users()->detach();

        $book->delete();

        return redirect('/books')->with([
            'flash-alert' => '“' . $book->title . '” was removed.'
        ]);
    }

    public function filter($category, $subcategory)
    {
        return 'Show all books in these categories: ' . $category . ',' . $subcategory;
    }
}