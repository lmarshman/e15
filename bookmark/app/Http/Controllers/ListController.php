<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class ListController extends Controller
{
    public function show(Request $request)
    {
        $books = $request->user()->books->sortByDesc('pivot.created_at');

        return view('list/show', ['books' => $books]);
    }

    public function add(Request $request, $slug)
    {
        $book = Book::findBySlug($slug);

        return view('list/add', ['book' => $book]);
    }

    public function save(Request $request, $slug)
    {
        $user = $request->user();
        $book = Book::findBySlug($slug);

        $user->books()->save($book, ['notes' => $request->notes]);

        return redirect('/list')->with(['flash-alert' => 'The book '.$book->title. 'was added to your list']);
    }

    public function delete($slug)
    {
        $book = Book::findBySlug($slug);

        if (!$book) {
            return redirect('/list')->with([
                'flash-alert' => 'Book not found'
            ]);
        }

        return view('/list/removeBook', ['book' => $book]);
    }

    public function destroy($slug)
    {
        $user = $request->user();
        $book = Book::findBySlug($slug);

        $book->users()->detach();

        $book->delete();

        return redirect('/list')->with([
            'flash-alert' => '“' . $book->title . '” was removed from your list.'
        ]);
    }
}
